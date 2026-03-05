@extends('admin.packaging.layouts')

@section('page')

<div class="pkg-header">
    <div class="pkg-title">
        <i class="fas fa-minus-circle" style="color:#ef4444;font-size:20px;"></i>
        Stock Out
    </div>
    <div class="pkg-tools">
        <a href="{{ route('packaging.stock-out.create') }}" class="pkg-btn pkg-btn-primary">
            <i class="fas fa-plus"></i> Record Stock Out
        </a>
    </div>
</div>

<div class="pkg-card" style="margin-top:16px;">
    <div class="toverflow-x-auto">
        <table class="pkg-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Reference</th>
                    <th class="pkg-center">Items</th>
                    <th>Notes</th>
                    <th class="pkg-center" style="width:60px;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stockOuts as $so)
                    <tr>
                        <td style="color:#94a3b8;font-size:13px;">{{ $so->id }}</td>
                        <td>
                            <div class="pkg-name">{{ \Carbon\Carbon::parse($so->date)->format('M d, Y') }}</div>
                        </td>
                        <td>
                            @if ($so->reference)
                                <span class="pkg-badge">{{ $so->reference }}</span>
                            @else
                                <span style="color:#cbd5e1;">—</span>
                            @endif
                        </td>
                        <td class="pkg-center">
                            <span style="font-weight:800;color:#0f172a;">{{ $so->items->count() }}</span>
                        </td>
                        <td style="color:#64748b;font-size:13px;max-width:240px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                            {{ $so->notes ?: '—' }}
                        </td>
                        <td class="pkg-center">
                            <a href="{{ route('packaging.stock-out.view', $so->id) }}" class="pkg-action" title="View">
                                <i class="fas fa-eye" style="font-size:13px;"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="pkg-center" style="padding:32px;color:#94a3b8;">
                            No stock-out records yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
