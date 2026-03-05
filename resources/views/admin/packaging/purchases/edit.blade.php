@extends('admin.packaging.layouts')

@section('page')

<style>
.pkg-mat-card {
    width: 120px;
    cursor: pointer;
    border: 2px solid #e2e8f0;
    border-radius: 14px;
    padding: 12px 8px 10px;
    text-align: center;
    background: #fff;
    transition: all .15s ease;
    position: relative;
    user-select: none;
}
.pkg-mat-card:hover {
    border-color: #d97706;
    box-shadow: 0 4px 14px rgba(217,119,6,.18);
    transform: translateY(-2px);
}
.pkg-mat-card.selected {
    border-color: #d97706;
    background: #fff7ed;
    box-shadow: 0 4px 14px rgba(217,119,6,.22);
}
.pkg-mat-card.added {
    border-color: #16a34a;
    background: #f0fdf4;
}
.pkg-mat-thumb {
    width: 80px;
    height: 80px;
    margin: 0 auto 8px;
    border-radius: 10px;
    overflow: hidden;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
}
.pkg-mat-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.pkg-added-badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background: #16a34a;
    color: #fff;
    border-radius: 99px;
    width: 22px;
    height: 22px;
    font-size: 11px;
    display: none;
    align-items: center;
    justify-content: center;
    border: 2px solid #fff;
    font-weight: 800;
}
.pkg-sel-panel {
    background: #fff7ed;
    border: 2px solid #d97706;
    border-radius: 14px;
    padding: 18px 20px;
    margin-top: 14px;
}
.pkg-input-lg {
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 16px;
    color: #0f172a;
    width: 100%;
    outline: none;
    background: #fff;
    transition: border-color .12s ease;
}
.pkg-input-lg:focus { border-color: #d97706; }
.pkg-label-lg {
    display: block;
    font-size: 14px;
    font-weight: 700;
    color: #475569;
    margin-bottom: 6px;
}
</style>

<div class="pkg-form-card">

    <!-- Header -->
    <div style="display:flex;align-items:center;gap:14px;margin-bottom:24px;padding-bottom:16px;border-bottom:2px solid #eef2f7;">
        <a href="{{ route('packaging.purchases.view', $purchase->id) }}" class="pkg-action" title="Back" style="flex-shrink:0;width:42px;height:42px;">
            <i class="fas fa-arrow-left" style="font-size:15px;"></i>
        </a>
        <div>
            <div style="font-size:20px;font-weight:800;color:#0f172a;">Edit Purchase #{{ $purchase->id }}</div>
            <div style="font-size:14px;color:#94a3b8;margin-top:2px;">Changes will automatically adjust inventory stock</div>
        </div>
    </div>





    <!-- Material Picker -->
    <div style="margin-bottom:28px;">
        <div style="font-size:15px;font-weight:800;color:#0f172a;margin-bottom:6px;">
            <i class="fas fa-box" style="color:#d97706;margin-right:6px;"></i> Select Material to Add
        </div>
        <div style="font-size:13px;color:#94a3b8;margin-bottom:14px;">Tap a material card, then enter quantity and cost below.</div>

        <!-- Search filter -->
        <div style="margin-bottom:12px;">
            <div class="pkg-search" style="width:260px;">
                <input type="text" id="mat-search" placeholder="Search materials..." oninput="pkgFilterCards()">
                <button type="button" style="pointer-events:none;"><i class="fas fa-search"></i></button>
            </div>
        </div>

        <!-- Cards grid -->
        <div style="display:flex;flex-wrap:wrap;gap:12px;max-height:340px;overflow-y:auto;padding:4px 2px;" id="material-grid">
            @foreach($materials as $m)
            <div class="pkg-mat-card"
                 id="mat-card-{{ $m->id }}"
                 onclick="pkgSelectMaterial({{ $m->id }}, '{{ addslashes($m->name) }}', '{{ $m->unit }}', '{{ $m->cost_per_unit }}', '{{ $m->image ? asset($m->image) : '' }}')"
                 data-name="{{ strtolower($m->name) }}">
                <div class="pkg-mat-thumb">
                    @if($m->image)
                        <img src="{{ asset($m->image) }}" alt="{{ $m->name }}">
                    @else
                        <i class="fas fa-box" style="font-size:30px;color:#cbd5e1;"></i>
                    @endif
                </div>
                <div style="font-size:13px;font-weight:700;color:#0f172a;line-height:1.3;word-break:break-word;">{{ $m->name }}</div>
                <div style="font-size:12px;color:#94a3b8;margin-top:2px;">{{ $m->unit }}</div>
                <div class="pkg-added-badge" id="added-badge-{{ $m->id }}"><i class="fas fa-check"></i></div>
            </div>
            @endforeach
        </div>

        <!-- Selection input panel -->
        <div class="pkg-sel-panel" id="sel-panel" style="display:none;">
            <div style="display:flex;align-items:center;gap:14px;margin-bottom:16px;">
                <div style="width:60px;height:60px;border-radius:10px;overflow:hidden;background:#fff;border:1px solid #fed7aa;flex-shrink:0;display:flex;align-items:center;justify-content:center;">
                    <img id="sel-img" src="" alt="" style="width:100%;height:100%;object-fit:cover;display:none;">
                    <i id="sel-img-icon" class="fas fa-box" style="font-size:24px;color:#d97706;"></i>
                </div>
                <div>
                    <div id="sel-name" style="font-size:18px;font-weight:800;color:#0f172a;"></div>
                    <div id="sel-unit" style="font-size:14px;color:#94a3b8;margin-top:2px;"></div>
                </div>
                <button type="button" onclick="pkgClearSelection()" style="margin-left:auto;background:none;border:none;color:#94a3b8;cursor:pointer;font-size:20px;padding:4px 8px;" title="Cancel">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:14px;align-items:flex-end;">
                <div>
                    <label class="pkg-label-lg">Quantity</label>
                    <input type="number" id="add-qty" class="pkg-input-lg" value="1" min="0.0001" step="0.01" style="width:140px;">
                </div>
                <div>
                    <label class="pkg-label-lg">Unit Cost (&#8369;)</label>
                    <input type="number" id="add-unit-cost" class="pkg-input-lg" value="0" min="0" step="0.0001" style="width:160px;">
                </div>
                <button type="button" onclick="pkgAddItem()" class="pkg-btn pkg-btn-primary" style="height:46px;font-size:16px;padding:0 28px;">
                    <i class="fas fa-plus-circle"></i> Add to List
                </button>
            </div>
        </div>
    </div>

    <!-- Items Added -->
    <div style="margin-bottom:28px;">
        <div style="font-size:15px;font-weight:800;color:#0f172a;margin-bottom:12px;">
            <i class="fas fa-list-ul" style="color:#16a34a;margin-right:6px;"></i> Items in This Purchase
        </div>
        <div class="pkg-card">
            <div class="toverflow-x-auto">
                <table class="pkg-table" id="items-table">
                    <thead>
                        <tr>
                            <th style="width:60px;"></th>
                            <th>Material</th>
                            <th>Unit</th>
                            <th class="pkg-right">Quantity</th>
                            <th class="pkg-right">Unit Cost</th>
                            <th class="pkg-right">Total</th>
                            <th style="width:54px;"></th>
                        </tr>
                    </thead>
                    <tbody id="items-body">
                        <tr id="empty-row" style="display:none;">
                            <td colspan="7" class="pkg-center" style="padding:32px;color:#94a3b8;font-size:15px;">
                                <i class="fas fa-box-open" style="font-size:28px;display:block;margin-bottom:8px;color:#e2e8f0;"></i>
                                No items added yet.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Purchase Details -->
    <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:14px;padding:18px 20px;margin-bottom:28px;">
        <div style="font-size:13px;font-weight:800;color:#475569;letter-spacing:.5px;margin-bottom:14px;">PURCHASE DETAILS</div>
        <div class="tflex tflex-wrap" style="gap:16px;">
            <div style="flex:1;min-width:180px;">
                <label class="pkg-label-lg">Supplier <small style="color:#94a3b8;font-weight:400;">(optional)</small></label>
                <select id="supplier_id" class="pkg-input-lg browser-default">
                    <option value="">— No Supplier —</option>
                    @foreach ($suppliers as $s)
                        <option value="{{ $s->id }}" {{ $purchase->supplier_id == $s->id ? 'selected' : '' }}>
                            {{ $s->name }} {{ $s->surname }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div style="flex:0 0 190px;">
                <label class="pkg-label-lg">Purchase Date <span style="color:#ef4444;">*</span></label>
                <input type="date" id="purchase_date" class="pkg-input-lg browser-default"
                       value="{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('Y-m-d') }}" required>
            </div>
            <div style="flex:0 0 150px;">
                <label class="pkg-label-lg">Tax (&#8369;)</label>
                <input type="number" id="tax" class="pkg-input-lg browser-default"
                       value="{{ $purchase->tax }}" min="0" step="0.01">
            </div>
            <div style="flex:0 0 150px;">
                <label class="pkg-label-lg">Shipping Fee (&#8369;)</label>
                <input type="number" id="shipping_fee" class="pkg-input-lg browser-default"
                       value="{{ $purchase->shipping_fee }}" min="0" step="0.01">
            </div>
        </div>
    </div>

    <!-- Summary bar -->
    <div style="display:flex;gap:24px;background:#f8fafc;border:2px solid #e2e8f0;border-radius:14px;padding:16px 24px;margin-bottom:28px;flex-wrap:wrap;">
        <div>
            <div style="font-size:13px;color:#94a3b8;font-weight:700;letter-spacing:.5px;">ITEMS ADDED</div>
            <div style="font-size:28px;font-weight:800;color:#0f172a;line-height:1.1;" id="summary-items">0</div>
        </div>
        <div style="border-left:1px solid #e2e8f0;padding-left:24px;">
            <div style="font-size:13px;color:#94a3b8;font-weight:700;letter-spacing:.5px;">SUBTOTAL</div>
            <div style="font-size:28px;font-weight:800;color:#0f172a;line-height:1.1;">&#8369;<span id="summary-subtotal">0.00</span></div>
        </div>
        <div style="border-left:1px solid #e2e8f0;padding-left:24px;">
            <div style="font-size:13px;color:#94a3b8;font-weight:700;letter-spacing:.5px;">GRAND TOTAL</div>
            <div style="font-size:28px;font-weight:800;color:#16a34a;line-height:1.1;">&#8369;<span id="summary-total">0.00</span></div>
        </div>
    </div>

    <!-- Save Button -->
    <div style="display:flex;gap:14px;align-items:center;">
        <button type="button" id="submit-btn" class="pkg-btn pkg-btn-primary" style="font-size:16px;padding:12px 32px;">
            <i class="fas fa-save"></i> Save Changes
        </button>
        <a href="{{ route('packaging.purchases.view', $purchase->id) }}" class="pkg-btn pkg-btn-secondary" style="font-size:16px;padding:12px 24px;">Cancel</a>
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
    var pkgEditItems      = [];
    var pkgSelectedMatId  = null;
    var pkgSelectedName   = '';
    var pkgSelectedUnit   = '';
    var pkgSelectedImage  = '';

    var pkgExistingItems = @json($existingItems);

    $(document).ready(function () {
        $('.modal').modal();
        $('#tax, #shipping_fee').on('input', function () { pkgRecalc(); });
        $('#submit-btn').on('click', function () { pkgSubmit(); });

        // Pre-load existing items
        for (var e = 0; e < pkgExistingItems.length; e++) {
            var ei = pkgExistingItems[e];
            var idx = pkgEditItems.length;
            pkgEditItems.push({
                material_id: ei.material_id,
                name:        ei.name,
                unit:        ei.unit,
                image:       ei.image || '',
                quantity:    parseFloat(ei.quantity),
                unit_cost:   parseFloat(ei.unit_cost),
                total_cost:  parseFloat(ei.total_cost),
            });
            pkgRenderRow(idx, ei.material_id, ei.name, ei.unit, ei.image || '', parseFloat(ei.quantity), parseFloat(ei.unit_cost), parseFloat(ei.total_cost));

            // Mark card as added
            var badge = document.getElementById('added-badge-' + ei.material_id);
            if (badge) badge.style.display = 'flex';
            var card = document.getElementById('mat-card-' + ei.material_id);
            if (card) card.classList.add('added');
        }

        pkgRecalc();
    });

    function pkgFilterCards() {
        var q = document.getElementById('mat-search').value.toLowerCase();
        var cards = document.querySelectorAll('.pkg-mat-card');
        for (var i = 0; i < cards.length; i++) {
            var name = cards[i].getAttribute('data-name') || '';
            cards[i].style.display = name.indexOf(q) !== -1 ? '' : 'none';
        }
    }

    function pkgSelectMaterial(id, name, unit, cost, image) {
        if (pkgSelectedMatId) {
            var prev = document.getElementById('mat-card-' + pkgSelectedMatId);
            if (prev) prev.classList.remove('selected');
        }

        if (pkgSelectedMatId === id) {
            pkgSelectedMatId = null;
            document.getElementById('sel-panel').style.display = 'none';
            return;
        }

        pkgSelectedMatId  = id;
        pkgSelectedName   = name;
        pkgSelectedUnit   = unit;
        pkgSelectedImage  = image;

        var card = document.getElementById('mat-card-' + id);
        if (card) card.classList.add('selected');

        document.getElementById('sel-name').textContent = name;
        document.getElementById('sel-unit').textContent = unit ? '(' + unit + ')' : '';

        var img  = document.getElementById('sel-img');
        var icon = document.getElementById('sel-img-icon');
        if (image) {
            img.src = image;
            img.style.display = '';
            icon.style.display = 'none';
        } else {
            img.style.display = 'none';
            icon.style.display = '';
        }

        document.getElementById('add-unit-cost').value = cost ? parseFloat(cost).toFixed(4) : '0.0000';
        document.getElementById('add-qty').value = 1;

        document.getElementById('sel-panel').style.display = '';
        document.getElementById('add-qty').focus();
    }

    function pkgClearSelection() {
        if (pkgSelectedMatId) {
            var card = document.getElementById('mat-card-' + pkgSelectedMatId);
            if (card) card.classList.remove('selected');
        }
        pkgSelectedMatId = null;
        document.getElementById('sel-panel').style.display = 'none';
    }

    function pkgIsAdded(matId) {
        return pkgEditItems.some(function(i) { return i && String(i.material_id) === String(matId); });
    }

    function pkgRenderRow(idx, matId, matName, unit, image, qty, unitCost, total) {
        var emptyRow = document.getElementById('empty-row');
        if (emptyRow) emptyRow.style.display = 'none';

        var imgHtml = image
            ? '<img src="' + image + '" style="width:44px;height:44px;border-radius:8px;object-fit:cover;">'
            : '<div style="width:44px;height:44px;border-radius:8px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;"><i class="fas fa-box" style="color:#cbd5e1;font-size:16px;"></i></div>';

        var tbody = document.getElementById('items-body');
        var row   = document.createElement('tr');
        row.id    = 'item-row-' + idx;
        row.innerHTML =
            '<td style="padding:10px 14px;">' + imgHtml + '</td>' +
            '<td><div class="pkg-name" style="font-size:15px;">' + matName + '</div></td>' +
            '<td style="font-size:14px;">' + unit + '</td>' +
            '<td class="pkg-right" style="font-size:15px;">' + qty.toLocaleString('en', {minimumFractionDigits:2}) + '</td>' +
            '<td class="pkg-right" style="font-size:15px;">&#8369;' + unitCost.toLocaleString('en', {minimumFractionDigits:4}) + '</td>' +
            '<td class="pkg-right" style="font-size:15px;"><b style="color:#16a34a;">&#8369;' + total.toLocaleString('en', {minimumFractionDigits:2}) + '</b></td>' +
            '<td class="pkg-center">' +
                '<button type="button" onclick="pkgRemoveItem(' + idx + ', ' + matId + ')" ' +
                    'style="background:#fee2e2;border:1px solid #fecaca;color:#ef4444;width:36px;height:36px;border-radius:8px;cursor:pointer;font-size:14px;">' +
                    '<i class="fas fa-times"></i>' +
                '</button>' +
            '</td>';
        tbody.appendChild(row);
    }

    function pkgAddItem() {
        if (!pkgSelectedMatId) { return; }

        var qty      = parseFloat(document.getElementById('add-qty').value) || 0;
        var unitCost = parseFloat(document.getElementById('add-unit-cost').value) || 0;

        if (qty <= 0) { alert('Quantity must be greater than 0.'); return; }

        // Update existing entry if already in list
        for (var x = 0; x < pkgEditItems.length; x++) {
            if (pkgEditItems[x] && String(pkgEditItems[x].material_id) === String(pkgSelectedMatId)) {
                var oldRow = document.getElementById('item-row-' + x);
                if (oldRow) oldRow.remove();
                pkgEditItems[x] = null;
                break;
            }
        }

        var total = qty * unitCost;
        var idx   = pkgEditItems.length;

        pkgEditItems.push({
            material_id: pkgSelectedMatId,
            name:        pkgSelectedName,
            unit:        pkgSelectedUnit,
            image:       pkgSelectedImage,
            quantity:    qty,
            unit_cost:   unitCost,
            total_cost:  total,
        });

        pkgRenderRow(idx, pkgSelectedMatId, pkgSelectedName, pkgSelectedUnit, pkgSelectedImage, qty, unitCost, total);

        var badge = document.getElementById('added-badge-' + pkgSelectedMatId);
        if (badge) badge.style.display = 'flex';
        var card = document.getElementById('mat-card-' + pkgSelectedMatId);
        if (card) { card.classList.remove('selected'); card.classList.add('added'); }

        pkgSelectedMatId = null;
        document.getElementById('sel-panel').style.display = 'none';

        pkgRecalc();
    }

    function pkgRemoveItem(idx, matId) {
        pkgEditItems[idx] = null;
        var row = document.getElementById('item-row-' + idx);
        if (row) row.remove();

        if (!pkgIsAdded(matId)) {
            var badge = document.getElementById('added-badge-' + matId);
            if (badge) badge.style.display = 'none';
            var card = document.getElementById('mat-card-' + matId);
            if (card) card.classList.remove('added');
        }

        var remaining = pkgEditItems.filter(Boolean).length;
        if (remaining === 0) {
            var emptyRow = document.getElementById('empty-row');
            if (emptyRow) emptyRow.style.display = '';
        }

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
