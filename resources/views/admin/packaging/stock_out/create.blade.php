@extends('admin.packaging.layouts')

@section('page')

<div class="pkg-form-card">
    <!-- Header -->
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;padding-bottom:16px;border-bottom:1px solid #eef2f7;">
        <a href="{{ route('packaging.stock-out.index') }}" class="pkg-action" title="Back" style="flex-shrink:0;">
            <i class="fas fa-arrow-left" style="font-size:13px;"></i>
        </a>
        <div>
            <div style="font-size:18px;font-weight:800;color:#0f172a;">Record Stock Out</div>
            <div style="font-size:13px;color:#94a3b8;">Deducts selected quantities from inventory</div>
        </div>
    </div>

    <!-- Summary bar -->
    <div style="display:flex;gap:24px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:14px 20px;margin-bottom:24px;flex-wrap:wrap;">
        <div>
            <div style="font-size:12px;color:#94a3b8;font-weight:700;">ITEMS</div>
            <div style="font-size:22px;font-weight:800;color:#0f172a;" id="summary-items">0</div>
        </div>
        <div>
            <div style="font-size:12px;color:#94a3b8;font-weight:700;">TOTAL QTY</div>
            <div style="font-size:22px;font-weight:800;color:#ef4444;" id="summary-qty">0.00</div>
        </div>
    </div>

    <!-- Transaction Info -->
    <div class="tflex tflex-wrap" style="gap:16px;margin-bottom:24px;">
        <div style="flex:0 0 180px;">
            <label class="pkg-label">Date <span class="ttext-red-500">*</span></label>
            <input type="date" id="so-date" class="pkg-input browser-default"
                   value="{{ date('Y-m-d') }}" required>
        </div>
        <div style="flex:1;min-width:160px;">
            <label class="pkg-label">Reference <small class="ttext-gray-400">(optional)</small></label>
            <input type="text" id="so-reference" class="pkg-input browser-default"
                   placeholder="e.g. SO-001, Sale order #...">
        </div>
        <div style="flex:2;min-width:220px;">
            <label class="pkg-label">Notes <small class="ttext-gray-400">(optional)</small></label>
            <input type="text" id="so-notes" class="pkg-input browser-default"
                   placeholder="Reason or remarks...">
        </div>
    </div>

    <!-- Item selector -->
    <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:16px;margin-bottom:16px;">
        <div style="font-size:13px;font-weight:800;color:#475569;margin-bottom:12px;">ADD ITEM</div>
        <div class="tflex tflex-wrap" style="gap:12px;align-items:flex-end;">
            <div style="flex:2;min-width:180px;">
                <label class="pkg-label">Material</label>
                <select id="add-material" class="pkg-input browser-default" style="padding:8px 12px;">
                    <option value="">— Select Material —</option>
                    @foreach ($materials as $m)
                        <option value="{{ $m->id }}"
                                data-unit="{{ $m->unit }}"
                                data-stock="{{ $m->inventory ? $m->inventory->quantity : 0 }}">
                            {{ $m->name }} ({{ $m->unit }})
                            — In Stock: {{ number_format($m->inventory ? $m->inventory->quantity : 0, 2) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div style="flex:0 0 120px;">
                <label class="pkg-label">Quantity</label>
                <input type="number" id="add-qty" class="pkg-input browser-default" value="1" min="0.0001" step="0.01">
            </div>
            <div id="stock-hint" style="flex:0 0 auto;font-size:12px;color:#94a3b8;padding-bottom:8px;"></div>
            <div>
                <button type="button" id="add-item-btn" class="pkg-btn pkg-btn-primary" style="height:40px;">
                    <i class="fas fa-plus"></i> Add
                </button>
            </div>
        </div>
    </div>

    <!-- Items Table -->
    <div class="pkg-card" style="margin-bottom:24px;">
        <div class="toverflow-x-auto">
            <table class="pkg-table" id="items-table">
                <thead>
                    <tr>
                        <th>Material</th>
                        <th>Unit</th>
                        <th class="pkg-right">Quantity</th>
                        <th class="pkg-center" style="width:50px;"></th>
                    </tr>
                </thead>
                <tbody id="items-body">
                    <tr id="empty-row">
                        <td colspan="4" class="pkg-center" style="padding:24px;color:#94a3b8;">No items added yet.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Save Button -->
    <div style="display:flex;gap:12px;">
        <button type="button" id="submit-btn" class="pkg-btn pkg-btn-primary">
            <i class="fas fa-save"></i> Save Stock Out
        </button>
        <a href="{{ route('packaging.stock-out.index') }}" class="pkg-btn pkg-btn-secondary">Cancel</a>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('js/plugins/sweatalert.js') }}"></script>
<script>
    var pkgSoItems = [];

    $(document).ready(function () {
        // Show stock hint on material change
        $('#add-material').on('change', function () {
            var stock = parseFloat($(this).find(':selected').data('stock')) || 0;
            var unit  = $(this).find(':selected').data('unit') || '';
            if ($(this).val()) {
                $('#stock-hint').html('Current stock: <b>' + stock.toLocaleString('en', {minimumFractionDigits: 2}) + '</b> ' + unit);
            } else {
                $('#stock-hint').html('');
            }
        });

        $('#add-item-btn').on('click', function () { pkgSoAddItem(); });
        $('#submit-btn').on('click', function () { pkgSoSubmit(); });
    });

    function pkgSoAddItem() {
        var sel     = document.getElementById('add-material');
        var opt     = sel.options[sel.selectedIndex];
        var matId   = sel.value;
        var matName = opt ? opt.text.split(' —')[0] : '';
        var unit    = opt ? (opt.dataset.unit || '') : '';
        var qty     = parseFloat(document.getElementById('add-qty').value) || 0;

        if (!matId) { alert('Please select a material.'); return; }
        if (qty <= 0) { alert('Quantity must be greater than 0.'); return; }

        var idx = pkgSoItems.length;
        pkgSoItems.push({ material_id: matId, name: matName, unit: unit, quantity: qty });
        pkgSoRenderRow(idx, matName, unit, qty);

        // Reset
        sel.value = '';
        document.getElementById('add-qty').value = 1;
        document.getElementById('stock-hint').innerHTML = '';

        pkgSoRecalc();
    }

    function pkgSoRenderRow(idx, matName, unit, qty) {
        var emptyRow = document.getElementById('empty-row');
        if (emptyRow) { emptyRow.style.display = 'none'; }

        var tbody = document.getElementById('items-body');
        var row   = document.createElement('tr');
        row.id    = 'so-row-' + idx;
        row.innerHTML =
            '<td><div class="pkg-name">' + matName + '</div></td>' +
            '<td>' + unit + '</td>' +
            '<td class="pkg-right">' + qty.toLocaleString('en', {minimumFractionDigits: 2}) + '</td>' +
            '<td class="pkg-center">' +
                '<button type="button" onclick="pkgSoRemoveItem(' + idx + ')" ' +
                    'style="background:#fee2e2;border:1px solid #fecaca;color:#ef4444;width:30px;height:30px;border-radius:8px;cursor:pointer;font-size:12px;">' +
                    '<i class="fas fa-times"></i>' +
                '</button>' +
            '</td>';
        tbody.appendChild(row);
    }

    function pkgSoRemoveItem(idx) {
        pkgSoItems[idx] = null;
        var row = document.getElementById('so-row-' + idx);
        if (row) { row.remove(); }
        pkgSoRecalc();

        var active = pkgSoItems.filter(Boolean).length;
        if (active === 0) {
            var emptyRow = document.getElementById('empty-row');
            if (emptyRow) { emptyRow.style.display = ''; }
        }
    }

    function pkgSoRecalc() {
        var active   = pkgSoItems.filter(Boolean);
        var totalQty = active.reduce(function (s, i) { return s + i.quantity; }, 0);
        document.getElementById('summary-items').textContent = active.length;
        document.getElementById('summary-qty').textContent   = totalQty.toLocaleString('en', {minimumFractionDigits: 2});
    }

    function pkgSoSubmit() {
        var validItems = pkgSoItems.filter(Boolean);

        if (validItems.length === 0) {
            alert('Please add at least one item.');
            return;
        }

        var date = document.getElementById('so-date').value;
        if (!date) {
            alert('Please select a date.');
            return;
        }

        var payload = {
            date:      date,
            reference: document.getElementById('so-reference').value,
            notes:     document.getElementById('so-notes').value,
            items:     validItems,
        };

        document.getElementById('submit-btn').disabled = true;

        $.ajax({
            url:  '{{ route("packaging.stock-out.store") }}',
            type: 'POST',
            data: JSON.stringify(payload),
            contentType: 'application/json',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            success: function (res) {
                if (res.success) {
                    Swal.fire({ icon: 'success', title: 'Saved!', text: 'Stock out recorded successfully.' })
                        .then(function () { location.href = '{{ route("packaging.stock-out.index") }}'; });
                }
            },
            error: function (xhr) {
                document.getElementById('submit-btn').disabled = false;
                var msg = (xhr.responseJSON && xhr.responseJSON.error) ? xhr.responseJSON.error : 'Something went wrong.';
                alert(msg);
            }
        });
    }
</script>
@endsection
