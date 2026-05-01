<?php

namespace App\Http\Controllers\Admin;

use App\JandtPayout;
use App\JandtPayoutUpload;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Imports\RawImport;
use App\Imports\ProcessedExport;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class ExcelController extends Controller
{
    private const JT_PAYOUT_HEADER_MAP = [
        'Bill number' => 'bill_number',
        'Billing Date' => 'billing_date_raw',
        'VIP Code' => 'vip_code',
        "Client'S Name" => 'client_name',
        'Settlement Method' => 'settlement_method',
        'Service Management' => 'service_management',
        "Customer's affiliated branch" => 'affiliated_branch',
        'COD settlement category' => 'cod_settlement_category',
        'COD Flag' => 'cod_flag',
        'Opening Bank' => 'opening_bank',
        'Bank account' => 'bank_account',
        'Payee' => 'payee',
        'COD accumulated amount' => 'cod_accumulated_amount',
        'COD Total Amount' => 'cod_total_amount',
        'COD amount cwt' => 'cod_amount_cwt',
        'COD commission rate' => 'cod_commission_rate',
        'COD commission' => 'cod_commission',
        'COD commission VAT fee' => 'cod_commission_vat_fee',
        'CODCWT' => 'codcwt',
        'Total COD payable' => 'total_cod_payable',
        'Total freight receivable' => 'total_freight_receivable',
        'Settled shipping fee' => 'settled_shipping_fee',
        'ShippingFee CWT' => 'shipping_fee_cwt',
        'Return Shipping' => 'return_shipping',
        'Return CWT' => 'return_cwt',
        'Super Value-added fee' => 'super_value_added_fee',
        'Return freight policy adjustment' => 'return_freight_policy_adjustment',
        'COD Amount Adjustment' => 'cod_amount_adjustment',
        'COD commission adjustment' => 'cod_commission_adjustment',
        'COD VAT adjustment' => 'cod_vat_adjustment',
        'CODCWT adjustment' => 'codcwt_adjustment',
        'Total ShippingFee Adjustment' => 'total_shipping_fee_adjustment',
        'Total ShippingFee CWT Adjustment' => 'total_shipping_fee_cwt_adjustment',
        'RTS ShippingFee Adjustment' => 'rts_shipping_fee_adjustment',
        'RTS Total ShippingFee CWT Adjustment' => 'rts_total_shipping_fee_cwt_adjustment',
        'Other Adjustment' => 'other_adjustment',
        'Discount amount' => 'discount_amount',
        'Total Adjustment' => 'total_adjustment',
        'Payment amount' => 'payment_amount',
        'Previous Period Bill Deduction' => 'previous_period_bill_deduction',
        'Amount after deduction' => 'amount_after_deduction',
        'Current Period Bill Deduction' => 'current_period_bill_deduction',
        'Already Deducted Freight Bill' => 'already_deducted_freight_bill',
        "Already Deducted Freight Bill\n" => 'already_deducted_freight_bill',
        'Shipping Fee Difference' => 'shipping_fee_difference',
        'Creation time' => 'creation_time',
        'Confirm the status' => 'confirm_status',
        'Confirm Time' => 'confirm_time',
        'Billing status' => 'billing_status',
        'Email sending status' => 'email_sending_status',
        'Email sending time' => 'email_sending_time',
    ];

    public function jandt_reconcile()
    {
        return view('admin.fbads.jandt_reconcile');
    }

    public function jandt_reconcile_process(Request $request)
    {

        $now = Carbon::now();

        // Jan-03-2025-7h03min55secs
        $filename = sprintf(
            'jandt_reconcile_%s-%s-%s-%sh%02dmin%02dsecs.xlsx',
            $now->format('M'),        // Jan
            $now->format('d'),        // 03
            $now->format('Y'),        // 2025
            $now->format('G'),        // 7 (no leading zero)
            $now->format('i'),        // 03
            $now->format('s')         // 55
        );

        // IMPORTANT: do NOT use $request->validate() here (it redirects = 302)
        if (!$request->hasFile('file')) {
            abort(422, 'No file uploaded');
        }

        $file = $request->file('file');

        // 1) Import raw rows
        $import = new RawImport();
        Excel::import($import, $file);

        /** @var Collection $rows */
        $rows = $import->rows;

        if (!$rows || $rows->count() < 2) {
            abort(422, 'Empty or invalid file.');
        }

        // 2) Build header -> index map
        $header = $rows->first();
        $map = [];

        foreach ($header as $i => $h) {
            $map[trim((string) $h)] = $i;
        }

        $idxTotal = $map['Total Shipping Cost'] ?? null;
        $idxCod   = $map['COD commission'] ?? null;
        $idxVat   = $map['COD commission VAT fee'] ?? null;

        if ($idxTotal === null || $idxCod === null || $idxVat === null) {
            abort(422, 'Missing required columns: Total Shipping Cost, COD commission, COD commission VAT fee');
        }

        // 3) Safe number parser (handles ₱, commas, spaces)
        $toNum = function ($v): float {
            $v = (string) $v;
            $v = str_replace(['₱', ',', ' '], '', $v);
            return (float) $v;
        };

        // 4) Process rows
        $processed = $rows->map(function ($row, $i) use ($idxTotal, $idxCod, $idxVat, $toNum) {
            if ($i === 0) return $row; // header

            $total = $toNum($row[$idxTotal] ?? 0);
            $cod   = $toNum($row[$idxCod] ?? 0);
            $vat   = $toNum($row[$idxVat] ?? 0);

            // Total Shipping Cost = Total Shipping Cost + COD commission + COD commission VAT fee
            $row[$idxTotal] = $total + $cod + $vat;

            return $row;
        });

        // 5) MUST return download directly (no redirects)
        return Excel::download(
            new ProcessedExport($processed),
            $filename
        );

    }

    public function jandt_payouts(Request $request)
    {
        $uploads = JandtPayoutUpload::orderBy('created_at', 'desc')->paginate(20);

        $rawTargetAmount = (string) $request->query('target_amount', '2577808');
        $normalizedTargetAmount = str_replace([',', ' '], '', $rawTargetAmount);
        $targetAmount = (float) $normalizedTargetAmount;
        if ($targetAmount <= 0) {
            $targetAmount = 2577808.00;
        }
        $startMonth = Carbon::now()->startOfMonth()->subMonths(5);

        $monthlyRaw = JandtPayout::query()
            ->join('jandt_payout_uploads', 'jandt_payout_uploads.id', '=', 'jandt_payouts.upload_id')
            ->whereNotNull('jandt_payout_uploads.payout_date')
            ->whereDate('jandt_payout_uploads.payout_date', '>=', $startMonth->toDateString())
            ->selectRaw("
                DATE_FORMAT(jandt_payout_uploads.payout_date, '%Y-%m') as ym,
                SUM(COALESCE(jandt_payouts.cod_total_amount, 0)) as cod_total,
                SUM(COALESCE(jandt_payouts.amount_after_deduction, 0)) as net_total
            ")
            ->groupBy('ym')
            ->orderBy('ym', 'asc')
            ->get()
            ->keyBy('ym');

        $monthly = [];
        for ($i = 0; $i < 6; $i++) {
            $dt = (clone $startMonth)->addMonths($i);
            $ym = $dt->format('Y-m');
            $cod = (float) optional($monthlyRaw->get($ym))->cod_total;
            $net = (float) optional($monthlyRaw->get($ym))->net_total;
            $deductionRate = $cod > 0 ? (($cod - $net) / $cod) * 100 : 0;

            $monthly[] = [
                'ym' => $ym,
                'label' => $dt->format('M Y'),
                'month_short' => $dt->format('M'),
                'cod_total' => $cod,
                'net_total' => $net,
                'total_deduction' => $cod - $net,
                'deduction_rate' => $deductionRate,
            ];
        }

        $actualAmount = array_sum(array_column($monthly, 'net_total'));
        $progressPct = $targetAmount > 0 ? ($actualAmount / $targetAmount) * 100 : 0;
        $remainingAmount = max(0, $targetAmount - $actualAmount);
        $surplusAmount = max(0, $actualAmount - $targetAmount);

        $bestMonth = collect($monthly)->sortByDesc('net_total')->first();
        $worstMonth = collect($monthly)->sortBy('net_total')->first();

        return view('admin.fbads.jandt_payouts', compact(
            'uploads',
            'targetAmount',
            'actualAmount',
            'progressPct',
            'remainingAmount',
            'surplusAmount',
            'bestMonth',
            'worstMonth',
            'monthly'
        ));
    }

    public function jandt_payouts_show($id)
    {
        $upload = JandtPayoutUpload::findOrFail($id);
        $rows = JandtPayout::where('upload_id', $upload->id)
            ->orderBy('id', 'desc')
            ->paginate(100);

        $totals = JandtPayout::where('upload_id', $upload->id)
            ->selectRaw('
                COALESCE(SUM(cod_total_amount),0) as cod_total_amount,
                COALESCE(SUM(total_cod_payable),0) as total_cod_payable,
                COALESCE(SUM(total_freight_receivable),0) as total_freight_receivable,
                COALESCE(SUM(return_shipping),0) as return_shipping,
                COALESCE(SUM(amount_after_deduction),0) as amount_after_deduction,
                COALESCE(SUM(previous_period_bill_deduction),0) as previous_period_bill_deduction,
                COALESCE(SUM(current_period_bill_deduction),0) as current_period_bill_deduction,
                COALESCE(SUM(discount_amount),0) as discount_amount,
                COALESCE(SUM(total_adjustment),0) as total_adjustment,
                COALESCE(SUM(cod_amount_adjustment),0) as cod_amount_adjustment,
                COALESCE(SUM(cod_commission_adjustment),0) as cod_commission_adjustment,
                COALESCE(SUM(cod_vat_adjustment),0) as cod_vat_adjustment,
                COALESCE(SUM(codcwt_adjustment),0) as codcwt_adjustment,
                COALESCE(SUM(total_shipping_fee_adjustment),0) as total_shipping_fee_adjustment,
                COALESCE(SUM(total_shipping_fee_cwt_adjustment),0) as total_shipping_fee_cwt_adjustment,
                COALESCE(SUM(rts_shipping_fee_adjustment),0) as rts_shipping_fee_adjustment,
                COALESCE(SUM(rts_total_shipping_fee_cwt_adjustment),0) as rts_total_shipping_fee_cwt_adjustment,
                COALESCE(SUM(other_adjustment),0) as other_adjustment,
                COALESCE(SUM(payment_amount),0) as payment_amount
            ')
            ->first();

        $totalDeduction = (float) $totals->previous_period_bill_deduction;

        return view('admin.fbads.jandt_payouts_show', compact('upload', 'rows', 'totals', 'totalDeduction'));
    }

    public function jandt_payouts_upload(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file',
            'payout_date' => 'required|date',
        ]);

        $file = $request->file('excel_file');
        $extension = strtolower((string) $file->getClientOriginalExtension());
        if (!in_array($extension, ['xlsx', 'xls'], true)) {
            return redirect()->back()->withErrors([
                'excel_file' => 'The excel file must be a file of type: xlsx, xls.',
            ])->withInput();
        }

        $tempPath = $file->getRealPath();
        if (!$tempPath || !file_exists($tempPath)) {
            return redirect()->back()->with('error', 'Uploaded temporary file is missing.');
        }

        $storedFileName = uniqid('jandt_payouts_', true) . '.' . $file->getClientOriginalExtension();
        $storedPath = $file->storeAs('jandt_payouts', $storedFileName, 'public');
        if (!$storedPath) {
            return redirect()->back()->with('error', 'Failed to store uploaded file.');
        }

        $upload = JandtPayoutUpload::create([
            'original_file_name' => $file->getClientOriginalName(),
            'stored_file_name' => $storedFileName,
            'file_path' => $storedPath,
            'payout_date' => $request->input('payout_date'),
            'uploaded_by' => optional(auth()->user())->id,
            'rows_imported' => 0,
        ]);

        try {
            $spreadsheet = IOFactory::load($tempPath);
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Invalid Excel file: ' . $e->getMessage());
        }

        $sheet = $spreadsheet->getSheet(0);
        $rows = $sheet->toArray(null, true, true, false);
        if (count($rows) < 2) {
            return redirect()->back()->with('error', 'Uploaded file is empty.');
        }

        $headerRow = array_map(function ($value) {
            return trim((string) $value);
        }, $rows[0]);

        $headerIndexMap = [];
        foreach ($headerRow as $idx => $headerText) {
            $headerIndexMap[$headerText] = $idx;
        }

        DB::beginTransaction();
        try {
            $insertRows = [];

            foreach (array_slice($rows, 1) as $row) {
                if ($this->rowIsEmpty($row)) {
                    continue;
                }

                $payload = [
                    'upload_id' => $upload->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                foreach (self::JT_PAYOUT_HEADER_MAP as $sourceHeader => $targetColumn) {
                    $value = null;
                    if (array_key_exists($sourceHeader, $headerIndexMap)) {
                        $value = $row[$headerIndexMap[$sourceHeader]];
                    }
                    $payload[$targetColumn] = $this->transformJandtPayoutValue($targetColumn, $value);
                }

                list($from, $to) = $this->parseBillingDateRange($payload['billing_date_raw'] ?? null);
                $payload['billing_date_from'] = $from;
                $payload['billing_date_to'] = $to;
                $payload['raw_payload'] = json_encode($row);
                $payload['row_hash'] = $this->buildJandtRowHash($payload);

                $insertRows[] = $payload;
            }

            $insertRows = collect($insertRows)
                ->unique('row_hash')
                ->values()
                ->all();

            $insertedCount = 0;
            if (!empty($insertRows)) {
                foreach (array_chunk($insertRows, 300) as $chunk) {
                    $insertedCount += DB::table('jandt_payouts')->insertOrIgnore($chunk);
                }
            }

            $upload->rows_imported = $insertedCount;
            $upload->save();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Import failed: ' . $e->getMessage());
        }

        return redirect()->route('fbads.jandt_payouts')->with('success', 'J&T payouts uploaded successfully.');
    }

    public function jandt_payouts_destroy($id)
    {
        $upload = JandtPayoutUpload::findOrFail($id);

        DB::beginTransaction();
        try {
            JandtPayout::where('upload_id', $upload->id)->delete();
            $upload->delete();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Delete failed: ' . $e->getMessage());
        }

        return redirect()->route('fbads.jandt_payouts')->with('success', 'Upload entry deleted.');
    }

    private function rowIsEmpty(array $row)
    {
        foreach ($row as $value) {
            if ($value !== null && trim((string) $value) !== '') {
                return false;
            }
        }
        return true;
    }

    private function parseBillingDateRange($value)
    {
        $value = trim((string) $value);
        if ($value === '') {
            return [null, null];
        }

        $parts = explode('+', $value);
        if (count($parts) !== 2) {
            return [$this->toDate($value), null];
        }

        return [$this->toDate($parts[0]), $this->toDate($parts[1])];
    }

    private function transformJandtPayoutValue($column, $value)
    {
        if ($value === null || trim((string) $value) === '') {
            return null;
        }

        if (in_array($column, ['creation_time', 'confirm_time', 'email_sending_time'], true)) {
            return $this->toDateTime($value);
        }

        $numericColumns = [
            'cod_accumulated_amount', 'cod_total_amount', 'cod_amount_cwt', 'cod_commission_rate',
            'cod_commission', 'cod_commission_vat_fee', 'codcwt', 'total_cod_payable',
            'total_freight_receivable', 'settled_shipping_fee', 'shipping_fee_cwt', 'return_shipping',
            'return_cwt', 'super_value_added_fee', 'return_freight_policy_adjustment',
            'cod_amount_adjustment', 'cod_commission_adjustment', 'cod_vat_adjustment',
            'codcwt_adjustment', 'total_shipping_fee_adjustment', 'total_shipping_fee_cwt_adjustment',
            'rts_shipping_fee_adjustment', 'rts_total_shipping_fee_cwt_adjustment', 'other_adjustment',
            'discount_amount', 'total_adjustment', 'payment_amount', 'previous_period_bill_deduction',
            'amount_after_deduction', 'current_period_bill_deduction', 'already_deducted_freight_bill',
            'shipping_fee_difference',
        ];

        if (in_array($column, $numericColumns, true)) {
            return $this->toNumber($value);
        }

        return trim((string) $value);
    }

    private function buildJandtRowHash(array $payload)
    {
        $hashPayload = $payload;
        unset(
            $hashPayload['id'],
            $hashPayload['upload_id'],
            $hashPayload['created_at'],
            $hashPayload['updated_at'],
            $hashPayload['raw_payload'],
            $hashPayload['row_hash']
        );

        ksort($hashPayload);
        foreach ($hashPayload as $key => $value) {
            if (is_string($value)) {
                $hashPayload[$key] = trim($value);
            }
        }

        return hash('sha256', json_encode($hashPayload));
    }

    private function toDate($value)
    {
        if (is_numeric($value)) {
            try {
                return ExcelDate::excelToDateTimeObject($value)->format('Y-m-d');
            } catch (\Throwable $e) {
                return null;
            }
        }

        try {
            return date('Y-m-d', strtotime((string) $value));
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function toDateTime($value)
    {
        if (is_numeric($value)) {
            try {
                return ExcelDate::excelToDateTimeObject($value)->format('Y-m-d H:i:s');
            } catch (\Throwable $e) {
                return null;
            }
        }

        try {
            return date('Y-m-d H:i:s', strtotime((string) $value));
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function toNumber($value)
    {
        if (is_numeric($value)) {
            return $value + 0;
        }

        $cleaned = str_replace([',', '₱', '%', 'x', '×', ' '], '', (string) $value);
        if ($cleaned === '' || !is_numeric($cleaned)) {
            return null;
        }
        return $cleaned + 0;
    }
}
