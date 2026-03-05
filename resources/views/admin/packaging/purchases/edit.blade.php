@extends('admin.packaging.layouts')

@section('page')

<div class="pkg-form-card">
    <!-- Header -->
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;padding-bottom:16px;border-bottom:1px solid #eef2f7;">
        <a href="{{ route('packaging.purchases.view', $purchase->id) }}" class="pkg-action" title="Back" style="flex-shrink:0;">
            <i class="fas fa-arrow-left" style="font-size:13px;"></i>
        </a>
        <div>
            <div style="font-size:18px;font-weight:800;color:#0f172a;">Edit Purchase #{{ $purchase->id }}</div>
            <div style="font-size:13px;color:#94a3b8;">Changes will automatically adjust inventory stock</div>
        </div>
    </div>

    <!-- Summary bar -->
    <div style="display:flex;gap:24px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:14px 20px;margin-bottom:24px;flex-wrap:wrap;">
        <div>
            <div style="font-size:12px;color:#94a3b8;font-weight:700;">ITEMS</div>
            <div style="font-size:22px;font-weight:800;color:#0f172a;" id="summary-items">0</div>
        </div>
        <div>
            <div style="font-size:12px;color:#94a3b8;font-weight:700;">SUBTOTAL</div>
            <div style="font-size:22px;font-weight:800;color:#0f172a;">&#8369;<span id="summary-subtotal">0.00</span></div>
        </div>
        <div>
            <div style="font-size:12px;color:#94a3b8;font-weight:700;">GRAND TOTAL</div>
            <div style="font-size:22px;font-weight:800;color:#16a34a;">&#8369;<span id="summary-total">0.00</span></div>
        </div>
    </div>

    <!-- Transaction Info -->
    <div class="tflex tflex-wrap" style="gap:16px;margin-bottom:24px;">
        <div style="flex:1;min-width:180px;">
            <label class="pkg-label">Supplier <small class="ttext-gray-400">(optional)</small></label>
            <select id="supplier_id" class="pkg-input browser-default" style="padding:8px 12px;">
                <option value="">— No Supplier —</option>
                @foreach ($suppliers as $s)
                    <option value="{{ $s->id }}" {{ $purchase->supplier_id == $s->id ? 'selected' : '' }}>
                        {{ $s->name }} {{ $s->surname }}
                    </option>
                @endforeach
            </select>
        </div>
        <div style="flex:0 0 180px;">
            <label class="pkg-label">Purchase Date <span class="ttext-red-500">*</span></label>
            <input type="date" id="purchase_date" class="pkg-input browser-default"
                   value="{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('Y-m-d') }}" required>
        </div>
        <div style="flex:0 0 140px;">
            <label class="pkg-label">Tax (&#8369;)</label>
            <input type="number" id="tax" class="pkg-input browser-default"
                   value="{{ $purchase->tax }}" min="0" step="0.01">
        </div>
        <div style="flex:0 0 140px;">
            <label class="pkg-label">Shipping Fee (&#8369;)</label>
            <input type="number" id="shipping_fee" class="pkg-input browser-default"
                   value="{{ $purchase->shipping_fee }}" min="0" step="0.01">
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
                        <option value="{{ $m->id }}" data-unit="{{ $m->unit }}" data-cost="{{ $m->cost_per_unit }}">
                            {{ $m->name }} ({{ $m->unit }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div style="flex:0 0 120px;">
                <label class="pkg-label">Quantity</label>
                <input type="number" id="add-qty" class="pkg-input browser-default" value="1" min="0.0001" step="0.01">
            </div>
            <div style="flex:0 0 140px;">
                <label class="pkg-label">Unit Cost (&#8369;)</label>
                <input type="number" id="add-unit-cost" class="pkg-input browser-default" value="0" min="0" step="0.0001">
            </div>
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
                        <th class="pkg-right">Unit Cost</th>
                        <th class="pkg-right">Total</th>
                        <th class="pkg-center" style="width:50px;"></th>
                    </tr>
                </thead>
                <tbody id="items-body">
                    <tr id="empty-row" style="display:none;">
                        <td colspan="6" class="pkg-center" style="padding:24px;color:#94a3b8;">No items added yet.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Save Button -->
    <div style="display:flex;gap:12px;">
        <button type="button" id="submit-btn" class="pkg-btn pkg-btn-primary">
            <i class="fas fa-save"></i> Save Changes
        </button>
        <a href="{{ route('packaging.purchases.view', $purchase->id) }}" class="pkg-btn pkg-btn-secondary">Cancel</a>
    </div>
</div>

<!-- Error Modal -->
<div id="err_modal" class="modal modal-fixed-footer">
    <div class="modal-content tbg-white">
        <div class="ttext-center tmb-5">
            <a class="btn-floating pulse" style="background:#ef4444;"><i class="fas fa-exclamation"></i></a>
            <h4 class="ttext-lg tmt-2">Oops!</h4>
        </div>
        <p id="err-msg" class="ttext-center ttext-red-500"></p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect btn-flat" style="color:#ef4444;">Close</a>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('js/plugins/sweatalert.js') }}"></script>
<script>
    var pkgEditItems = [];

    // Pre-load existing items from server
    var pkgExistingItems = @json($existingItems);

    $(document).ready(function () {
        $('.modal').modal();

        // Auto-fill unit cost when material selected
        $('#add-material').on('change', function () {
            var cost = $(this).find(':selected').data('cost') || 0;
            $('#add-unit-cost').val(parseFloat(cost).toFixed(4));
        });

        // Button bindings
        $('#add-item-btn').on('click', function () { pkgAddItem(); });
        $('#submit-btn').on('click', function () { pkgSubmit(); });
        $('#tax, #shipping_fee').on('input', function () { pkgRecalc(); });

        // Load existing items into the table
        for (var e = 0; e < pkgExistingItems.length; e++) {
            var ei = pkgExistingItems[e];
            pkgEditItems.push({
                material_id: ei.material_id,
                name:        ei.name,
                unit:        ei.unit,
                quantity:    parseFloat(ei.quantity),
                unit_cost:   parseFloat(ei.unit_cost),
                total_cost:  parseFloat(ei.total_cost),
            });
            pkgRenderRow(pkgEditItems.length - 1, ei.name, ei.unit, parseFloat(ei.quantity), parseFloat(ei.unit_cost), parseFloat(ei.total_cost));
        }

        pkgRecalc();
    });

    function pkgRenderRow(idx, matName, unit, qty, unitCost, total) {
        var tbody = document.getElementById('items-body');
        var row   = document.createElement('tr');
        row.id    = 'item-row-' + idx;
        row.innerHTML =
            '<td><div class="pkg-name">' + matName + '</div></td>' +
            '<td>' + unit + '</td>' +
            '<td class="pkg-right">' + qty.toLocaleString('en', {minimumFractionDigits:2}) + '</td>' +
            '<td class="pkg-right">&#8369;' + unitCost.toLocaleString('en', {minimumFractionDigits:4}) + '</td>' +
            '<td class="pkg-right"><b>&#8369;' + total.toLocaleString('en', {minimumFractionDigits:2}) + '</b></td>' +
            '<td class="pkg-center">' +
                '<button type="button" onclick="pkgRemoveItem(' + idx + ')" ' +
                    'style="background:#fee2e2;border:1px solid #fecaca;color:#ef4444;width:30px;height:30px;border-radius:8px;cursor:pointer;font-size:12px;">' +
                    '<i class="fas fa-times"></i>' +
                '</button>' +
            '</td>';
        tbody.appendChild(row);
    }

    function pkgAddItem() {
        var sel      = document.getElementById('add-material');
        var opt      = sel.options[sel.selectedIndex];
        var matId    = sel.value;
        var matName  = opt.text;
        var unit     = opt.dataset.unit || '';
        var qty      = parseFloat(document.getElementById('add-qty').value) || 0;
        var unitCost = parseFloat(document.getElementById('add-unit-cost').value) || 0;

        if (!matId) { alert('Please select a material.'); return; }
        if (qty <= 0) { alert('Quantity must be greater than 0.'); return; }

        var total = qty * unitCost;
        var idx   = pkgEditItems.length;

        pkgEditItems.push({ material_id: matId, name: matName, unit: unit, quantity: qty, unit_cost: unitCost, total_cost: total });
        pkgRenderRow(idx, matName, unit, qty, unitCost, total);

        // Reset
        sel.value = '';
        document.getElementById('add-qty').value = 1;
        document.getElementById('add-unit-cost').value = 0;

        pkgRecalc();
    }

    function pkgRemoveItem(idx) {
        pkgEditItems[idx] = null;
        var row = document.getElementById('item-row-' + idx);
        if (row) row.remove();
        pkgRecalc();
    }

    function pkgRecalc() {
        var subtotal = pkgEditItems.filter(Boolean).reduce(function(s, i) { return s + i.total_cost; }, 0);
        var tax      = parseFloat(document.getElementById('tax').value) || 0;
        var ship     = parseFloat(document.getElementById('shipping_fee').value) || 0;
        var grand    = subtotal + tax + ship;
        var count    = pkgEditItems.filter(Boolean).length;

        document.getElementById('summary-items').textContent    = count;
        document.getElementById('summary-subtotal').textContent = subtotal.toLocaleString('en', {minimumFractionDigits:2});
        document.getElementById('summary-total').textContent    = grand.toLocaleString('en', {minimumFractionDigits:2});
    }

    function pkgSubmit() {
        var validItems = pkgEditItems.filter(Boolean);

        if (validItems.length === 0) {
            alert('Please add at least one item.');
            return;
        }

        var tax      = parseFloat(document.getElementById('tax').value) || 0;
        var ship     = parseFloat(document.getElementById('shipping_fee').value) || 0;
        var subtotal = validItems.reduce(function(s, i) { return s + i.total_cost; }, 0);
        var grand    = subtotal + tax + ship;

        var payload = {
            id:            {{ $purchase->id }},
            supplier_id:   document.getElementById('supplier_id').value,
            purchase_date: document.getElementById('purchase_date').value,
            tax:           tax,
            shipping_fee:  ship,
            total_cost:    grand,
            items:         validItems,
        };

        document.getElementById('submit-btn').disabled = true;

        $.ajax({
            url:  '{{ route("packaging.purchases.patch") }}',
            type: 'POST',
            data: payload,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            success: function (res) {
                if (res.success) {
                    Swal.fire({ icon: 'success', title: 'Updated!', text: 'Purchase updated successfully.' })
                        .then(function () { location.href = '{{ route("packaging.purchases.view", $purchase->id) }}'; });
                }
            },
            error: function (xhr) {
                document.getElementById('submit-btn').disabled = false;
                document.getElementById('err-msg').textContent = (xhr.responseJSON && xhr.responseJSON.error) ? xhr.responseJSON.error : 'Something went wrong.';
                $('#err_modal').modal('open');
            }
        });
    }
</script>
@endsection
