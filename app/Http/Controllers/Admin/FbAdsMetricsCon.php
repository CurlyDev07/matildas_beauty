<?php

namespace App\Http\Controllers\Admin;

use App\FbAdsMetric;
use App\FbAdsMetricUpload;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class FbAdsMetricsCon extends Controller
{
    private const HEADER_MAP = [
        'Reporting starts' => 'reporting_starts',
        'Reporting ends' => 'reporting_ends',
        'Campaign name' => 'campaign_name',
        'Amount spent (PHP)' => 'amount_spent_php',
        'Profit' => 'profit',
        'Purchases' => 'purchases',
        'Purchase ROAS (return on ad spend)' => 'purchase_roas_return_on_ad_spend',
        'Cost per purchase (PHP)' => 'cost_per_purchase_php',
        'AOV (Average order value)' => 'aov_average_order_value',
        'Conversion Rate %' => 'conversion_rate_percent',
        'Purchases conversion value' => 'purchases_conversion_value',
        'VAT' => 'vat',
    ];

    public function index(Request $request)
    {
        $tab = $request->query('tab', 'uploads');
        $uploads = FbAdsMetricUpload::orderBy('created_at', 'desc')->paginate(20);
        $latestExportedDate = FbAdsMetricUpload::orderBy('created_at', 'desc')
            ->value('exported_date');
        $nextExportedDate = $latestExportedDate
            ? date('Y-m-d', strtotime($latestExportedDate . ' +1 day'))
            : date('Y-m-d');
        $adSpendByFile = DB::table('fb_ads_metric_uploads')
            ->leftJoin('fb_ads_metrics', 'fb_ads_metrics.upload_id', '=', 'fb_ads_metric_uploads.id')
            ->selectRaw('
                fb_ads_metric_uploads.id,
                fb_ads_metric_uploads.exported_date,
                fb_ads_metric_uploads.original_file_name,
                COALESCE(SUM(fb_ads_metrics.amount_spent_php), 0) as total_ad_spend
            ')
            ->groupBy(
                'fb_ads_metric_uploads.id',
                'fb_ads_metric_uploads.exported_date',
                'fb_ads_metric_uploads.original_file_name'
            )
            ->orderBy('fb_ads_metric_uploads.exported_date', 'desc')
            ->orderBy('fb_ads_metric_uploads.id', 'desc')
            ->get();

        $totalAdSpend = (float) $adSpendByFile->sum('total_ad_spend');

        // Monthly analytics (12 months) for quick monitoring
        $monthlyLabels = [];
        $monthlyAdSpend = [];
        $monthlyPurchases = [];
        $monthlyPurchaseValue = [];
        $monthlyAvgRoas = [];
        $monthlyAvgCpp = [];
        $monthlyAvgAov = [];
        $monthlyAvgCr = [];
        $kpiMonth = [
            'ad_spend' => 0.0,
            'purchase_value' => 0.0,
            'purchases' => 0.0,
            'avg_roas' => 0.0,
            'avg_cpp' => 0.0,
            'avg_aov' => 0.0,
            'avg_cr' => 0.0,
        ];
        $kpiPrevMonth = $kpiMonth;
        $kpiChange = [
            'ad_spend' => 0.0,
            'purchase_value' => 0.0,
            'purchases' => 0.0,
            'avg_roas' => 0.0,
            'avg_cpp' => 0.0,
            'avg_aov' => 0.0,
            'avg_cr' => 0.0,
        ];

        $startMonth = date('Y-m-01', strtotime('-11 months'));
        $rawMonthly = FbAdsMetric::query()
            ->selectRaw("
                DATE_FORMAT(reporting_starts, '%Y-%m') as ym,
                COALESCE(SUM(amount_spent_php), 0) as ad_spend,
                COALESCE(SUM(purchases), 0) as purchases,
                COALESCE(SUM(purchases_conversion_value), 0) as purchase_value,
                COALESCE(AVG(purchase_roas_return_on_ad_spend), 0) as avg_roas,
                COALESCE(AVG(cost_per_purchase_php), 0) as avg_cpp,
                COALESCE(AVG(aov_average_order_value), 0) as avg_aov,
                COALESCE(AVG(conversion_rate_percent), 0) as avg_cr
            ")
            ->whereDate('reporting_starts', '>=', $startMonth)
            ->groupBy('ym')
            ->orderBy('ym', 'asc')
            ->get()
            ->keyBy('ym');

        for ($i = 0; $i < 12; $i++) {
            $monthDate = date('Y-m-01', strtotime($startMonth . " +{$i} months"));
            $ym = date('Y-m', strtotime($monthDate));
            $row = $rawMonthly->get($ym);
            $monthlyLabels[] = date('M Y', strtotime($monthDate));
            $monthlyAdSpend[] = (float) optional($row)->ad_spend;
            $monthlyPurchases[] = (float) optional($row)->purchases;
            $monthlyPurchaseValue[] = (float) optional($row)->purchase_value;
            $monthlyAvgRoas[] = (float) optional($row)->avg_roas;
            $monthlyAvgCpp[] = (float) optional($row)->avg_cpp;
            $monthlyAvgAov[] = (float) optional($row)->avg_aov;
            $monthlyAvgCr[] = (float) optional($row)->avg_cr;
        }

        $thisMonthStart = date('Y-m-01');
        $thisMonthEnd = date('Y-m-t');
        $prevMonthStart = date('Y-m-01', strtotime('first day of last month'));
        $prevMonthEnd = date('Y-m-t', strtotime('last day of last month'));
        $thisMonthLabel = date('M Y');
        $prevMonthLabel = date('M Y', strtotime('first day of last month'));

        $kpiMonth = $this->monthlyMetricSnapshot($thisMonthStart, $thisMonthEnd);
        $kpiPrevMonth = $this->monthlyMetricSnapshot($prevMonthStart, $prevMonthEnd);
        foreach ($kpiChange as $key => $value) {
            $kpiChange[$key] = $this->computePercentChange((float) $kpiMonth[$key], (float) $kpiPrevMonth[$key]);
        }

        $availableColumns = array_flip(self::HEADER_MAP); // db_column => label
        $selectedColumns = array_keys($availableColumns);

        $reportStartDate = $request->query('report_start_date', date('Y-m-01'));
        $reportEndDate = $request->query('report_end_date', date('Y-m-d'));
        $quickRange = (string) $request->query('quick_range', '');

        switch ($quickRange) {
            case 'today':
                $reportStartDate = date('Y-m-d');
                $reportEndDate = date('Y-m-d');
                break;
            case 'yesterday':
                $reportStartDate = date('Y-m-d', strtotime('-1 day'));
                $reportEndDate = date('Y-m-d', strtotime('-1 day'));
                break;
            case '7d':
                $reportStartDate = date('Y-m-d', strtotime('-6 days'));
                $reportEndDate = date('Y-m-d');
                break;
            case '14d':
                $reportStartDate = date('Y-m-d', strtotime('-13 days'));
                $reportEndDate = date('Y-m-d');
                break;
            case '30d':
                $reportStartDate = date('Y-m-d', strtotime('-29 days'));
                $reportEndDate = date('Y-m-d');
                break;
            case 'this_month':
                $reportStartDate = date('Y-m-01');
                $reportEndDate = date('Y-m-d');
                break;
            case 'last_month':
                $reportStartDate = date('Y-m-01', strtotime('first day of last month'));
                $reportEndDate = date('Y-m-t', strtotime('last day of last month'));
                break;
        }
        try {
            $reportStartDate = date('Y-m-d', strtotime($reportStartDate));
            $reportEndDate = date('Y-m-d', strtotime($reportEndDate));
        } catch (\Throwable $e) {
            $reportStartDate = date('Y-m-01');
            $reportEndDate = date('Y-m-d');
        }
        if ($reportStartDate > $reportEndDate) {
            $tmp = $reportStartDate;
            $reportStartDate = $reportEndDate;
            $reportEndDate = $tmp;
        }

        $sortBy = (string) $request->query('sort_by', 'reporting_starts');
        $sortDir = strtolower((string) $request->query('sort_dir', 'desc')) === 'asc' ? 'asc' : 'desc';
        $sortableColumns = array_merge(['export_date'], $selectedColumns);
        if (!in_array($sortBy, $sortableColumns, true)) {
            $sortBy = 'reporting_starts';
        }

        $allowedPerPage = [50, 100, 200];
        $perPage = (int) $request->query('per_page', 50);
        if (!in_array($perPage, $allowedPerPage, true)) {
            $perPage = 50;
        }

        if ($request->query('export') === '1') {
            return $this->exportSelectedColumnsCsv(
                $selectedColumns,
                $availableColumns,
                $reportStartDate,
                $reportEndDate
            );
        }

        $reportRowsQuery = FbAdsMetric::query()
            ->join('fb_ads_metric_uploads', 'fb_ads_metric_uploads.id', '=', 'fb_ads_metrics.upload_id')
            ->select(array_merge(
                ['fb_ads_metrics.id', 'fb_ads_metric_uploads.exported_date as export_date'],
                array_map(function ($c) {
                    return 'fb_ads_metrics.' . $c;
                }, $selectedColumns)
            ))
            ->whereBetween('reporting_starts', [$reportStartDate, $reportEndDate]);

        if ($sortBy === 'export_date') {
            $reportRowsQuery->orderBy('fb_ads_metric_uploads.exported_date', $sortDir);
        } else {
            $reportRowsQuery->orderBy('fb_ads_metrics.' . $sortBy, $sortDir);
        }

        $reportRows = $reportRowsQuery
            ->orderBy('fb_ads_metrics.id', 'desc')
            ->paginate($perPage)
            ->appends($request->query());

        return view('admin.fbads.metrics', compact(
            'tab',
            'uploads',
            'nextExportedDate',
            'adSpendByFile',
            'totalAdSpend',
            'availableColumns',
            'selectedColumns',
            'reportStartDate',
            'reportEndDate',
            'reportRows',
            'sortBy',
            'sortDir',
            'perPage',
            'quickRange',
            'monthlyLabels',
            'monthlyAdSpend',
            'monthlyPurchases',
            'monthlyPurchaseValue',
            'monthlyAvgRoas',
            'monthlyAvgCpp',
            'monthlyAvgAov',
            'monthlyAvgCr',
            'kpiMonth',
            'kpiPrevMonth',
            'kpiChange',
            'thisMonthLabel',
            'prevMonthLabel'
        ));
    }

    private function monthlyMetricSnapshot($start, $end)
    {
        $row = FbAdsMetric::query()
            ->selectRaw("
                COALESCE(SUM(amount_spent_php), 0) as ad_spend,
                COALESCE(SUM(purchases_conversion_value), 0) as purchase_value,
                COALESCE(SUM(purchases), 0) as purchases,
                COALESCE(AVG(purchase_roas_return_on_ad_spend), 0) as avg_roas,
                COALESCE(AVG(cost_per_purchase_php), 0) as avg_cpp,
                COALESCE(AVG(aov_average_order_value), 0) as avg_aov,
                COALESCE(AVG(conversion_rate_percent), 0) as avg_cr
            ")
            ->whereBetween('reporting_starts', [$start, $end])
            ->first();

        return [
            'ad_spend' => (float) optional($row)->ad_spend,
            'purchase_value' => (float) optional($row)->purchase_value,
            'purchases' => (float) optional($row)->purchases,
            'avg_roas' => (float) optional($row)->avg_roas,
            'avg_cpp' => (float) optional($row)->avg_cpp,
            'avg_aov' => (float) optional($row)->avg_aov,
            'avg_cr' => (float) optional($row)->avg_cr,
        ];
    }

    private function computePercentChange($current, $previous)
    {
        if ((float) $previous === 0.0) {
            return (float) $current === 0.0 ? 0.0 : 100.0;
        }
        return (($current - $previous) / $previous) * 100;
    }

    private function exportSelectedColumnsCsv(array $selectedColumns, array $availableColumns, $reportStartDate, $reportEndDate)
    {
        $rows = FbAdsMetric::query()
            ->select($selectedColumns)
            ->whereBetween('reporting_starts', [$reportStartDate, $reportEndDate])
            ->orderBy('reporting_starts', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $filename = 'meta_ads_report_' . $reportStartDate . '_to_' . $reportEndDate . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response()->stream(function () use ($rows, $selectedColumns, $availableColumns) {
            $out = fopen('php://output', 'w');
            fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));

            $headerLabels = array_map(function ($col) use ($availableColumns) {
                return $availableColumns[$col] ?? $col;
            }, $selectedColumns);
            fputcsv($out, $headerLabels);

            foreach ($rows as $row) {
                $line = [];
                foreach ($selectedColumns as $col) {
                    $val = $row->{$col};
                    if (in_array($col, ['reporting_starts', 'reporting_ends', 'date_created', 'date_last_edited'], true)) {
                        $line[] = $val ? date('M d, Y', strtotime($val)) : '';
                    } else {
                        $line[] = $val;
                    }
                }
                fputcsv($out, $line);
            }
            fclose($out);
        }, 200, $headers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
            'exported_date' => 'required|date',
        ]);

        $file = $request->file('excel_file');
        $tempPath = $file->getRealPath();
        if (!$tempPath || !file_exists($tempPath)) {
            return redirect()->back()->with('error', 'Uploaded temporary file is missing.');
        }

        $storedFileName = uniqid('fb_metrics_', true) . '.' . $file->getClientOriginalExtension();
        $storedPath = $file->storeAs('fb_ads_metrics', $storedFileName, 'public');
        if (!$storedPath) {
            return redirect()->back()->with('error', 'Failed to store uploaded file.');
        }

        $upload = FbAdsMetricUpload::create([
            'original_file_name' => $file->getClientOriginalName(),
            'stored_file_name' => $storedFileName,
            'file_path' => $storedPath,
            'exported_date' => $request->exported_date,
            'uploaded_by' => optional(auth()->user())->id,
            'rows_imported' => 0,
        ]);

        DB::beginTransaction();
        try {
            $upload->rows_imported = $this->importRowsFromSpreadsheet($tempPath, $upload->id);
            $upload->summary_ad_spend = (float) FbAdsMetric::where('upload_id', $upload->id)->sum('amount_spent_php');
            $upload->summary_roas = (float) FbAdsMetric::where('upload_id', $upload->id)->avg('purchase_roas_return_on_ad_spend');
            $upload->save();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Upload failed: ' . $e->getMessage());
        }

        return redirect()->route('fbads.metrics.index')->with('success', 'File uploaded and imported successfully.');
    }

    public function reupload(Request $request, $id)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
            'exported_date' => 'nullable|date',
        ]);

        $upload = FbAdsMetricUpload::findOrFail($id);
        $file = $request->file('excel_file');
        $tempPath = $file->getRealPath();
        if (!$tempPath || !file_exists($tempPath)) {
            return redirect()->back()->with('error', 'Uploaded temporary file is missing.');
        }

        $storedFileName = uniqid('fb_metrics_', true) . '.' . $file->getClientOriginalExtension();
        $storedPath = $file->storeAs('fb_ads_metrics', $storedFileName, 'public');
        if (!$storedPath) {
            return redirect()->back()->with('error', 'Failed to store uploaded file.');
        }

        DB::beginTransaction();
        try {
            FbAdsMetric::where('upload_id', $upload->id)->delete();

            $upload->original_file_name = $file->getClientOriginalName();
            $upload->stored_file_name = $storedFileName;
            $upload->file_path = $storedPath;
            if ($request->filled('exported_date')) {
                $upload->exported_date = $request->input('exported_date');
            }
            $upload->rows_imported = $this->importRowsFromSpreadsheet($tempPath, $upload->id);
            $upload->summary_ad_spend = (float) FbAdsMetric::where('upload_id', $upload->id)->sum('amount_spent_php');
            $upload->summary_roas = (float) FbAdsMetric::where('upload_id', $upload->id)->avg('purchase_roas_return_on_ad_spend');
            $upload->save();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Reupload failed: ' . $e->getMessage());
        }

        return redirect()->route('fbads.metrics.index')->with('success', 'Upload entry replaced and re-imported.');
    }

    public function destroy($id)
    {
        $upload = FbAdsMetricUpload::findOrFail($id);

        DB::beginTransaction();
        try {
            FbAdsMetric::where('upload_id', $upload->id)->delete();
            $upload->delete();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Delete failed: ' . $e->getMessage());
        }

        return redirect()->route('fbads.metrics.index')->with('success', 'Upload entry deleted.');
    }

    public function updateExportedDate(Request $request, $id)
    {
        $request->validate([
            'exported_date' => 'required|date',
        ]);

        $upload = FbAdsMetricUpload::findOrFail($id);
        $upload->exported_date = $request->input('exported_date');
        $upload->save();

        return redirect()->route('fbads.metrics.index')->with('success', 'Exported date updated.');
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

    private function transformValue($column, $value)
    {
        if ($value === null || trim((string) $value) === '') {
            return null;
        }

        if (in_array($column, ['reporting_starts', 'reporting_ends', 'date_created', 'date_last_edited'], true)) {
            return $this->toDate($value);
        }

        $numericColumns = [
            'amount_spent_php',
            'profit',
            'purchases',
            'purchase_roas_return_on_ad_spend',
            'cost_per_purchase_php',
            'aov_average_order_value',
            'conversion_rate_percent',
            'purchases_conversion_value',
            'vat',
        ];

        if (in_array($column, $numericColumns, true)) {
            return $this->toNumber($value);
        }

        return trim((string) $value);
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

    private function shouldSkipZeroCampaignRow(array $payload)
    {
        $campaignName = trim((string) ($payload['campaign_name'] ?? ''));
        if ($campaignName === '') {
            return false;
        }

        $keys = [
            'purchases',
            'cost_per_purchase_php',
            'purchase_roas_return_on_ad_spend',
            'amount_spent_php',
            'purchases_conversion_value',
        ];

        foreach ($keys as $key) {
            $val = isset($payload[$key]) ? (float) $payload[$key] : 0.0;
            if ($val != 0.0) {
                return false;
            }
        }

        return true;
    }

    private function importRowsFromSpreadsheet($tempPath, $uploadId)
    {
        $spreadsheet = IOFactory::load($tempPath);
        $sheet = $spreadsheet->getSheet(0);
        $rows = $sheet->toArray(null, true, true, false);

        if (count($rows) < 2) {
            throw new \RuntimeException('Uploaded file is empty.');
        }

        $headerRow = array_map('trim', $rows[0]);
        $headerIndexMap = [];
        foreach ($headerRow as $idx => $headerText) {
            $headerIndexMap[$headerText] = $idx;
        }

        $insertRows = [];
        foreach (array_slice($rows, 1) as $row) {
            if ($this->rowIsEmpty($row)) {
                continue;
            }

            $payload = [
                'upload_id' => $uploadId,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            foreach (self::HEADER_MAP as $sourceHeader => $targetColumn) {
                $value = null;
                if (array_key_exists($sourceHeader, $headerIndexMap)) {
                    $value = $row[$headerIndexMap[$sourceHeader]];
                }
                $payload[$targetColumn] = $this->transformValue($targetColumn, $value);
            }

            if ($this->shouldSkipZeroCampaignRow($payload)) {
                continue;
            }

            $insertRows[] = $payload;
        }

        if (!empty($insertRows)) {
            foreach (array_chunk($insertRows, 500) as $chunk) {
                FbAdsMetric::insert($chunk);
            }
        }

        return count($insertRows);
    }
}
