@extends('admin.packaging.layouts')

@section('page')

<div class="pkg-card">
    <!-- Header -->
    <div class="pkg-header">
        <span class="pkg-title">
            <i class="fas fa-clipboard-list" style="color:#0284c7;"></i>
            Packaging Inventory
        </span>

        <span style="font-size:14px;font-weight:700;color:#475569;">
            Total Stock Value: <b style="color:#16a34a;">{{ currency() }}{{ number_format($totalValue, 2) }}</b>
        </span>

        <div class="pkg-tools">
            <form class="pkg-search">
                <input type="text" id="search-input" placeholder="Search materials...">
                <button type="button"><i class="fas fa-search fa-flip-horizontal"></i></button>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div style="padding: 8px 8px 16px;">
        <div class="toverflow-x-auto">
            <table class="pkg-table" id="inv-table">
                <thead>
                    <tr>
                        <th>Material</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th>Cost / Unit</th>
                        <th style="width:140px;">Quantity</th>
                        <th class="pkg-right">Stock Value</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($materials as $material)
                        @php
                            $qty   = $material->inventory->quantity ?? 0;
                            $cost  = $material->cost_per_unit ?? 0;
                            $value = $qty * $cost;
                        @endphp
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    @if ($material->image)
                                        <img src="{{ asset($material->image) }}" alt=""
                                             style="width:38px;height:38px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;flex-shrink:0;">
                                    @else
                                        <div style="width:38px;height:38px;border-radius:8px;background:#f1f5f9;border:1px solid #e2e8f0;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                            <i class="fas fa-box" style="color:#cbd5e1;font-size:16px;"></i>
                                        </div>
                                    @endif
                                    <div class="pkg-name">{{ $material->name }}</div>
                                </div>
                            </td>
                            <td>
                                @if ($material->category)
                                    <span class="pkg-badge">{{ $material->category }}</span>
                                @else
                                    <span class="ttext-gray-400">—</span>
                                @endif
                            </td>
                            <td>{{ $material->unit ?? '—' }}</td>
                            <td>{{ currency() }}{{ number_format($cost, 4) }}</td>
                            <td>
                                @if(auth()->user()->role == 'master')
                                <div style="display:flex;align-items:center;gap:6px;">
                                    <input
                                        type="number"
                                        class="qty-input browser-default"
                                        style="width:90px;padding:6px 10px;border:2px solid #d97706;border-radius:8px;text-align:right;font-size:14px;background:#fffbeb;font-weight:600;outline:none;"
                                        data-material-id="{{ $material->id }}"
                                        data-cost="{{ $cost }}"
                                        value="{{ number_format($qty, 2, '.', '') }}"
                                        min="0"
                                        step="0.01"
                                        title="Click to edit quantity"
                                    >
                                    <span class="qty-saved-badge" style="display:none;color:#16a34a;font-size:12px;font-weight:700;"><i class="fas fa-check"></i></span>
                                </div>
                                @else
                                <input
                                    type="number"
                                    class="browser-default"
                                    style="width:90px;padding:6px 10px;border:1px solid #e2e8f0;border-radius:8px;text-align:right;font-size:14px;background:#f8fafc;color:#94a3b8;"
                                    value="{{ number_format($qty, 2, '.', '') }}"
                                    disabled
                                >
                                @endif
                            </td>
                            <td class="pkg-right">
                                <span class="stock-value-cell tfont-bold" style="color:#16a34a;">
                                    {{ currency() }}{{ number_format($value, 2) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="pkg-center" style="padding:40px;color:#94a3b8;">
                                No materials found. <a href="{{ route('packaging.materials.create') }}" style="color:#d97706;">Add a material</a> first.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $(document).on('change', '.qty-input', function () {
        var $input     = $(this);
        var materialId = $input.data('material-id');
        var newQty     = parseFloat($input.val()) || 0;
        var cost       = parseFloat($input.data('cost')) || 0;
        var $row       = $input.closest('tr');
        var $cell      = $row.find('.stock-value-cell');
        var $badge     = $input.siblings('.qty-saved-badge');

        $input.css('border-color', '#d97706');

        $.ajax({
            url: '{{ route("packaging.inventory.manual-change") }}',
            type: 'POST',
            data: { material_id: materialId, quantity: newQty },
            success: function (res) {
                if (res.success) {
                    var newValue = (res.new_quantity * cost).toFixed(2);
                    $cell.text('₱' + Number(newValue).toLocaleString('en', { minimumFractionDigits: 2 }));
                    $input.css('border-color', '#16a34a');
                    $badge.fadeIn(150);
                    setTimeout(function () {
                        $badge.fadeOut(400);
                        $input.css('border-color', '#d97706');
                    }, 2000);
                }
            },
            error: function () {
                $input.css('border-color', '#ef4444');
                alert('Failed to update stock. Please try again.');
                $input.css('border-color', '#d97706');
            }
        });
    });

    document.getElementById('search-input').addEventListener('keyup', function () {
        const filter = this.value.toUpperCase();
        const rows   = document.querySelectorAll('#inv-table tbody tr');
        rows.forEach(row => {
            row.style.display = (row.textContent || row.innerText).toUpperCase().includes(filter) ? '' : 'none';
        });
    });
</script>
@endsection
