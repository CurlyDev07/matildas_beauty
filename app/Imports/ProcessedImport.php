<?php

// app/Imports/ProcessedImport.php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class ProcessedImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $header = $rows->first();

        return $rows->map(function ($row, $index) use ($header) {
            if ($index === 0) return $row;

            $totalShipping = (float) $row[3];
            $codCommission = (float) $row[4];
            $codVat        = (float) $row[5];

            $row[3] = $totalShipping + $codCommission + $codVat;

            return $row;
        });
    }
}



?>