@extends('admin.packaging.layouts')

@section('page')

<div class="pkg-form-card">
    <!-- Header -->
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;padding-bottom:16px;border-bottom:1px solid #eef2f7;flex-wrap:wrap;gap:12px;">
        <div style="display:flex;align-items:center;gap:12px;">
            <a href="{{ route('packaging.stock-out.index') }}" class="pkg-action" title="Back" style="flex-shrink:0;">
                <i class="fas fa-arrow-left" style="font-size:13px;"></i>
            </a>
            <div>
                <div style="font-size:18px;font-weight:800;color:#0f172a;">Stock Out #{{ $stockOut->id }}</div>
                <div style="font-size:13px;color:#94a3b8;">
                    {{ \Carbon\Carbon::parse($stockOut->date)->format('F d, Y') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="tflex tflex-wrap" style="gap:16px;margin-bottom:28px;">
        <div style="flex:1;min-width:160px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:16px;">
            <div style="font-size:11px;font-weight:800;color:#94a3b8;margin-bottom:4px;">REFERENCE</div>
            <div style="font-size:16px;font-weight:800;color:#0f172a;">
                {{ $stockOut->reference ?: '—' }}
            </div>
        </div>
        <div style="flex:2;min-width:200px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:16px;">
            <div style="font-size:11px;font-weight:800;color:#94a3b8;margin-bottom:4px;">NOTES</div>
            <div style="font-size:14px;color:#0f172a;">
                {{ $stockOut->notes ?: '—' }}
            </div>
        </div>
        <div style="flex:0 0 140px;background:#fff1f2;border:1px solid #fecdd3;border-radius:12px;padding:16px;">
            <div style="font-size:11px;font-weight:800;color:#9f1239;margin-bottom:4px;">ITEMS</div>
            <div style="font-size:22px;font-weight:800;color:#be123c;">{{ $stockOut->items->count() }}</div>
        </div>
    </div>

    <!-- Items Table -->
    <div style="font-size:13px;font-weight:800;color:#475569;margin-bottom:10px;">ITEMS STOCKED OUT</div>
    <div class="pkg-card">
        <div class="toverflow-x-auto">
            <table class="pkg-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Material</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th class="pkg-right">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stockOut->items as $i => $item)
                        <tr>
                            <td style="color:#94a3b8;font-size:13px;">{{ $i + 1 }}</td>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    @if ($item->material && $item->material->image)
                                        <img src="{{ asset($item->material->image) }}" alt=""
                                             style="width:34px;height:34px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;flex-shrink:0;">
                                    @else
                                        <div style="width:34px;height:34px;border-radius:8px;background:#f1f5f9;border:1px solid #e2e8f0;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                            <i class="fas fa-box" style="color:#cbd5e1;font-size:14px;"></i>
                                        </div>
                                    @endif
                                    <div class="pkg-name">{{ $item->material->name ?? '—' }}</div>
                                </div>
                            </td>
                            <td>
                                @if ($item->material && $item->material->category)
                                    <span class="pkg-badge">{{ $item->material->category }}</span>
                                @else
                                    <span style="color:#cbd5e1;">—</span>
                                @endif
                            </td>
                            <td>{{ $item->material->unit ?? '—' }}</td>
                            <td class="pkg-right">
                                <span style="font-weight:800;color:#be123c;">
                                    {{ number_format($item->quantity, 2) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="background:#f8fafc;">
                        <td colspan="4" style="padding:14px 18px;font-weight:800;color:#475569;text-align:right;">
                            Total Quantity:
                        </td>
                        <td class="pkg-right" style="padding:14px 18px;font-weight:800;color:#be123c;">
                            {{ number_format($stockOut->items->sum('quantity'), 2) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection
