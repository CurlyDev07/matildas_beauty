@php
    $badgeLabel = $label ?: '-';
    $badgeEffect = $effect ?: 'none';
    $badgeKey = strtolower(trim(($key ?: $badgeLabel)));
    $badgeKey = str_replace([' ', '_'], '-', $badgeKey);

    $badgeStyles = [
        'purchase-in' => ['icon' => 'fas fa-cart-plus', 'bg' => '#dcfce7', 'color' => '#166534', 'border' => '#bbf7d0'],
        'production-in' => ['icon' => 'fas fa-industry', 'bg' => '#ccfbf1', 'color' => '#0f766e', 'border' => '#99f6e4'],
        'return-in' => ['icon' => 'fas fa-undo-alt', 'bg' => '#d1fae5', 'color' => '#047857', 'border' => '#a7f3d0'],
        'adjustment-in' => ['icon' => 'fas fa-plus-circle', 'bg' => '#ecfccb', 'color' => '#3f6212', 'border' => '#d9f99d'],
        'sales-out' => ['icon' => 'fas fa-shopping-bag', 'bg' => '#ffe4e6', 'color' => '#be123c', 'border' => '#fecdd3'],
        'damage-out' => ['icon' => 'fas fa-exclamation-triangle', 'bg' => '#ffedd5', 'color' => '#c2410c', 'border' => '#fed7aa'],
        'expired-out' => ['icon' => 'fas fa-calendar-times', 'bg' => '#fef3c7', 'color' => '#92400e', 'border' => '#fde68a'],
        'adjustment-out' => ['icon' => 'fas fa-minus-circle', 'bg' => '#fee2e2', 'color' => '#991b1b', 'border' => '#fecaca'],
        'reservation' => ['icon' => 'fas fa-lock', 'bg' => '#f3e8ff', 'color' => '#7e22ce', 'border' => '#e9d5ff'],
        'release-reservation' => ['icon' => 'fas fa-unlock', 'bg' => '#e0e7ff', 'color' => '#4338ca', 'border' => '#c7d2fe'],
        'status-transfer' => ['icon' => 'fas fa-exchange-alt', 'bg' => '#dbeafe', 'color' => '#1d4ed8', 'border' => '#bfdbfe'],
    ];

    $effectStyles = [
        'add' => ['icon' => 'fas fa-arrow-up', 'bg' => '#dcfce7', 'color' => '#166534', 'border' => '#bbf7d0'],
        'subtract' => ['icon' => 'fas fa-arrow-down', 'bg' => '#fee2e2', 'color' => '#991b1b', 'border' => '#fecaca'],
        'transfer' => ['icon' => 'fas fa-exchange-alt', 'bg' => '#dbeafe', 'color' => '#1d4ed8', 'border' => '#bfdbfe'],
        'none' => ['icon' => 'fas fa-circle', 'bg' => '#f1f5f9', 'color' => '#475569', 'border' => '#e2e8f0'],
    ];

    $badgeStyle = $badgeStyles[$badgeKey] ?? ($effectStyles[$badgeEffect] ?? $effectStyles['none']);
@endphp
<span class="wi-type-pill"
    style="background:{{ $badgeStyle['bg'] }};color:{{ $badgeStyle['color'] }};border-color:{{ $badgeStyle['border'] }};">
    <i class="{{ $badgeStyle['icon'] }}"></i>
    {{ $badgeLabel }}
</span>
