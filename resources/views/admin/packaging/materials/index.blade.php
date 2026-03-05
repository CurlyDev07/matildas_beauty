@extends('admin.packaging.layouts')

@section('page')

<div class="pkg-card">
    <!-- Header -->
    <div class="pkg-header">
        <span class="pkg-title">
            <i class="fas fa-th-list" style="color:#d97706;"></i>
            Packaging Materials
        </span>

        <div class="pkg-tools">
            <a href="{{ route('packaging.materials.create') }}" class="pkg-icon-btn" title="Add Material" style="position:relative;">
                <i class="fas fa-box" style="font-size:18px;"></i>
                <i class="fas fa-plus" style="position:absolute;top:8px;right:8px;font-size:9px;background:#c2410c;color:#fff;width:14px;height:14px;border-radius:50%;display:flex;align-items:center;justify-content:center;"></i>
            </a>

            <form action="" class="pkg-search">
                <input type="text" id="search-input" placeholder="Search materials...">
                <button type="button"><i class="fas fa-search fa-flip-horizontal"></i></button>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div style="padding: 8px 8px 16px;">
        <div class="toverflow-x-auto">
            <table class="pkg-table" id="materials-table">
                <thead>
                    <tr>
                        <th style="width:70px;">Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th>Cost / Unit</th>
                        <th>In Stock</th>
                        <th class="pkg-center" style="width:100px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($materials as $material)
                        <tr>
                            <td>
                                @if ($material->image)
                                    <img src="{{ asset($material->image) }}"
                                         alt="{{ $material->name }}"
                                         style="width:50px;height:50px;object-fit:cover;border-radius:10px;border:1px solid #e2e8f0;">
                                @else
                                    <div style="width:50px;height:50px;border-radius:10px;background:#f1f5f9;border:1px solid #e2e8f0;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-box" style="color:#cbd5e1;font-size:20px;"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="pkg-name">{{ $material->name }}</div>
                            </td>
                            <td>
                                @if ($material->category)
                                    <span class="pkg-badge">{{ $material->category }}</span>
                                @else
                                    <span class="ttext-gray-400">—</span>
                                @endif
                            </td>
                            <td>{{ $material->unit ?? '—' }}</td>
                            <td>{{ currency() }}{{ number_format($material->cost_per_unit, 4) }}</td>
                            <td>
                                <span class="tfont-semibold" style="color:#0284c7;">
                                    {{ number_format($material->inventory->quantity ?? 0, 2) }}
                                </span>
                                <small class="ttext-gray-400">{{ $material->unit }}</small>
                            </td>
                            <td class="pkg-center">
                                <a href="{{ route('packaging.materials.edit', $material->id) }}"
                                   class="pkg-action" title="Edit" style="margin-right:6px;">
                                    <i class="fas fa-pen" style="font-size:12px;"></i>
                                </a>
                                <form action="{{ route('packaging.materials.delete') }}" method="POST" style="display:inline;"
                                      onsubmit="return confirm('Delete this material?')">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $material->id }}">
                                    <button type="submit" class="" title="Delete" style="border:none;cursor:pointer;">
                                        <i class="fas fa-trash" style="font-size:12px;"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="pkg-center" style="padding:40px;color:#94a3b8;">
                                <i class="fas fa-box" style="font-size:32px;margin-bottom:10px;display:block;"></i>
                                No packaging materials yet. <a href="{{ route('packaging.materials.create') }}" style="color:#d97706;">Add one</a>
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
        const rows   = document.querySelectorAll('#materials-table tbody tr');
        rows.forEach(row => {
            const text = row.textContent || row.innerText;
            row.style.display = text.toUpperCase().includes(filter) ? '' : 'none';
        });
    });
</script>
@endsection
