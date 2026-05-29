@php
    $unitCode = strtolower((string) ($unit ?? ''));
    $rawQuantity = (float) ($quantity ?? 0);
    $decimalUnits = ['kg', 'g', 'gram', 'grams', 'l', 'liter', 'liters', 'ml', 'milliliter', 'milliliters'];
    $wholeUnits = ['pcs', 'pc', 'piece', 'pieces', 'box', 'set', 'pack', 'bottle', 'sachet', 'roll'];

    if (in_array($unitCode, $wholeUnits, true)) {
        $formattedQuantity = number_format($rawQuantity, 0);
    } elseif (in_array($unitCode, $decimalUnits, true)) {
        $formattedQuantity = rtrim(rtrim(number_format($rawQuantity, 3), '0'), '.');
    } elseif (floor($rawQuantity) == $rawQuantity) {
        $formattedQuantity = number_format($rawQuantity, 0);
    } else {
        $formattedQuantity = rtrim(rtrim(number_format($rawQuantity, 3), '0'), '.');
    }
@endphp
{{ $formattedQuantity }}
