@php
    $items = collect(isset($snapshot['items']) ? $snapshot['items'] : []);
    $compareItems = collect(isset($compareSnapshot['items']) ? $compareSnapshot['items'] : [])->keyBy('inventory_item_id');
    $side = isset($side) ? $side : 'after';
    $typeChanged = !empty($snapshot['movement_type']) && !empty($compareSnapshot['movement_type']) && $snapshot['movement_type'] !== $compareSnapshot['movement_type'];
    $batchChanged = !empty($snapshot['batch_code']) && !empty($compareSnapshot['batch_code']) && $snapshot['batch_code'] !== $compareSnapshot['batch_code'];
    $headerChangeStyle = 'background:#fef3c7;color:#92400e;border-color:#fde68a;';
@endphp
<div class="tborder tborder-gray-200 trounded tp-3" style="background:#f8fafc;">
    <div class="tflex titems-center tjustify-between tmb-2" style="gap:8px;">
        <div class="tfont-bold wi-section-title">{{ $title }}</div>
        @if(!empty($snapshot['movement_type']))
            <span class="wi-pill" style="{{ $typeChanged ? $headerChangeStyle : '' }}">
                {{ $snapshot['movement_type'] }}
                @if($typeChanged)
                    <span class="tml-1">changed</span>
                @endif
            </span>
        @endif
    </div>
    @if(!empty($snapshot['batch_code']))
        <div class="ttext-xs wi-muted tmb-2">
            Movement ID:
            <span class="wi-code" style="{{ $batchChanged ? $headerChangeStyle : '' }}">
                {{ $snapshot['batch_code'] }}
                @if($batchChanged)
                    <span class="tml-1">changed</span>
                @endif
            </span>
        </div>
    @endif
    @if(!empty($snapshot['notes']))
        <div class="ttext-xs wi-muted tmb-2">Notes: {{ $snapshot['notes'] }}</div>
    @endif

    @if($items->count())
        <div class="wi-overflow">
            <table class="wi-table tw-full ttext-xs">
                <thead>
                    <tr class="tuppercase">
                        <th class="ttext-left tpx-2 tpy-2">Item</th>
                        <th class="ttext-left tpx-2 tpy-2">SKU</th>
                        <th class="ttext-right tpx-2 tpy-2">Qty</th>
                        <th class="ttext-right tpx-2 tpy-2">Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        @php
                            $compareItem = $compareItems->get($item['inventory_item_id']);
                            $isAdded = $side === 'after' && !$compareItem;
                            $isRemoved = $side === 'before' && !$compareItem;
                            $qtyChanged = $compareItem && array_key_exists('quantity', $item) && array_key_exists('quantity', $compareItem) && (float) $item['quantity'] !== (float) $compareItem['quantity'];
                            $costChanged = $compareItem && array_key_exists('unit_cost', $item) && array_key_exists('unit_cost', $compareItem) && (float) $item['unit_cost'] !== (float) $compareItem['unit_cost'];
                            $rowStyle = $isAdded
                                ? 'background:#ecfdf5;border-left:4px solid #22c55e;'
                                : ($isRemoved ? 'background:#fff1f2;border-left:4px solid #e11d48;' : '');
                            $changeStyle = 'background:#fef3c7;color:#92400e;border-radius:6px;';
                        @endphp
                        <tr class="tborder-t tborder-gray-200" style="{{ $rowStyle }}">
                            <td class="tpx-2 tpy-2 tfont-bold wi-section-title">
                                {{ $item['name'] ?: 'Unknown item' }}
                                @if($isAdded)
                                    <span class="tml-1 ttext-xs tfont-bold" style="color:#15803d;">Added</span>
                                @endif
                                @if($isRemoved)
                                    <span class="tml-1 ttext-xs tfont-bold" style="color:#be123c;">Removed</span>
                                @endif
                            </td>
                            <td class="tpx-2 tpy-2 wi-muted">{{ $item['sku'] ?: '-' }}</td>
                            <td class="tpx-2 tpy-2 ttext-right tfont-bold" style="{{ $qtyChanged ? $changeStyle : '' }}">
                                {{ isset($item['quantity']) ? number_format((float) $item['quantity'], fmod((float) $item['quantity'], 1.0) === 0.0 ? 0 : 3) : '-' }}
                            </td>
                            <td class="tpx-2 tpy-2 ttext-right" style="{{ $costChanged ? $changeStyle : '' }}">
                                {{ isset($item['unit_cost']) ? '₱' . number_format((float) $item['unit_cost'], 2) : '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="tpy-4 ttext-center wi-muted">No snapshot.</div>
    @endif
</div>
