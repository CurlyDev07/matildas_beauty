@extends('admin.packaging.layouts')

@section('page')

<div class="pkg-card">
    <!-- Header -->
    <div class="pkg-header">
        <span class="pkg-title">
            <i class="fas fa-shopping-cart" style="color:#16a34a;"></i>
            Packaging Purchases
        </span>

        <div class="pkg-tools">
            <a href="{{ route('packaging.purchases.create') }}" class="pkg-icon-btn" title="New Purchase" style="position:relative;">
                <i class="fas fa-shopping-cart" style="font-size:18px;"></i>
                <i class="fas fa-plus" style="position:absolute;top:8px;right:8px;font-size:9px;background:#c2410c;color:#fff;width:14px;height:14px;border-radius:50%;display:flex;align-items:center;justify-content:center;"></i>
            </a>

            <form class="pkg-search">
                <input type="text" id="search-input" placeholder="Search supplier or date...">
                <button type="button"><i class="fas fa-search fa-flip-horizontal"></i></button>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div style="padding: 8px 8px 16px;">
        <div class="toverflow-x-auto">
            <table class="pkg-table" id="purchases-table">
                <thead>
                    <tr>
                        <th>Supplier</th>
                        <th>Purchase Date</th>
                        <th class="pkg-center">Items</th>
                        <th>Tax</th>
                        <th>Shipping</th>
                        <th>Total Cost</th>
                        <th class="pkg-center" style="width:80px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($purchases as $purchase)
                        <tr>
                            <td>
                                <div class="pkg-name">
                                    {{ $purchase->supplier ? $purchase->supplier->name . ' ' . $purchase->supplier->surname : '—' }}
                                </div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('M d, Y') }}</td>
                            <td class="pkg-center">
                                <span style="font-weight:700;color:#0284c7;">{{ $purchase->items->count() }}</span>
                            </td>
                            <td>{{ currency() }}{{ number_format($purchase->tax, 2) }}</td>
                            <td>{{ currency() }}{{ number_format($purchase->shipping_fee, 2) }}</td>
                            <td>
                                <span style="font-weight:800;color:#0f172a;">{{ currency() }}{{ number_format($purchase->total_cost, 2) }}</span>
                            </td>
                            <td class="pkg-center">
                                <a href="{{ route('packaging.purchases.view', $purchase->id) }}"
                                   class="pkg-action" title="View Details" style="margin-right:6px;">
                                    <i class="fas fa-eye" style="font-size:12px;"></i>
                                </a>
                                <a href="{{ route('packaging.purchases.edit', $purchase->id) }}"
                                   class="pkg-action" title="Edit Purchase"
                                   style="background:#eff6ff;border-color:#bfdbfe;color:#2563eb;">
                                    <i class="fas fa-pen" style="font-size:12px;"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="pkg-center" style="padding:40px;color:#94a3b8;">
                                <i class="fas fa-shopping-cart" style="font-size:32px;margin-bottom:10px;display:block;"></i>
                                No purchases yet. <a href="{{ route('packaging.purchases.create') }}" style="color:#d97706;">Record one</a>
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
    document.getElementById('search-input').addEventListener('keyup', function () {
        const filter = this.value.toUpperCase();
        const rows   = document.querySelectorAll('#purchases-table tbody tr');
        rows.forEach(row => {
            row.style.display = (row.textContent || row.innerText).toUpperCase().includes(filter) ? '' : 'none';
        });
    });
</script>
@endsection
