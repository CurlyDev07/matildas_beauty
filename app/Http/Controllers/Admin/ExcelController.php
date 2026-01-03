<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Imports\RawImport;
use App\Imports\ProcessedExport;

class ExcelController extends Controller
{
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
}
