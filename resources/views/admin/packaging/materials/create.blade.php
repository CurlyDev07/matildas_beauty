@extends('admin.packaging.layouts')

@section('page')

<div class="pkg-form-card">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;padding-bottom:16px;border-bottom:1px solid #eef2f7;">
        <a href="{{ route('packaging.materials') }}" class="pkg-action" title="Back" style="flex-shrink:0;">
            <i class="fas fa-arrow-left" style="font-size:13px;"></i>
        </a>
        <div>
            <div style="font-size:18px;font-weight:800;color:#0f172a;">Add Packaging Material</div>
            <div style="font-size:13px;color:#94a3b8;">Fill in the details below</div>
        </div>
    </div>

    <form action="{{ route('packaging.materials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="tflex tflex-wrap" style="gap:20px;">

            <!-- Image Upload -->
            <div style="flex:0 0 100%;">
                <label class="pkg-label">Material Image <small class="ttext-gray-400">(optional)</small></label>
                <div id="image-preview-wrap" style="display:none;margin-bottom:10px;">
                    <img id="image-preview" style="max-height:120px;border-radius:12px;border:1px solid #e2e8f0;" alt="">
                </div>
                <input type="file" name="image" id="image-input" class="browser-default" accept="image/*"
                       style="border:1px dashed #e2e8f0;border-radius:10px;padding:8px;width:100%;background:#f8fafc;">
            </div>

            <!-- Name -->
            <div style="flex:1;min-width:220px;">
                <label class="pkg-label">Material Name <span class="ttext-red-500">*</span></label>
                <input type="text" name="name" class="pkg-input browser-default" value="{{ old('name') }}" required placeholder="e.g. Kraft Box 100ml">
                @error('name') <small class="ttext-red-500">{{ $message }}</small> @enderror
            </div>

            <!-- Category -->
            <div style="flex:1;min-width:180px;">
                <label class="pkg-label">Category</label>
                <input type="text" name="category" class="pkg-input browser-default" value="{{ old('category') }}" placeholder="e.g. Box, Bottle, Sachet">
            </div>

            <!-- Unit -->
            <div style="flex:0 0 160px;">
                <label class="pkg-label">Unit</label>
                <input type="text" name="unit" class="pkg-input browser-default" value="{{ old('unit') }}" placeholder="e.g. pcs, rolls">
            </div>

            <!-- Cost per unit -->
            <div style="flex:0 0 200px;">
                <label class="pkg-label">Cost per Unit (₱)</label>
                <input type="number" name="cost_per_unit" class="pkg-input browser-default" value="{{ old('cost_per_unit') }}" step="0.0001" min="0" placeholder="0.00">
            </div>
        </div>

        <div style="display:flex;gap:12px;margin-top:28px;">
            <button type="submit" class="pkg-btn pkg-btn-primary">
                <i class="fas fa-save"></i> Save Material
            </button>
            <a href="{{ route('packaging.materials') }}" class="pkg-btn pkg-btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@endsection

@section('js')
<script>
    document.getElementById('image-input').addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('image-preview').src = e.target.result;
            document.getElementById('image-preview-wrap').style.display = 'block';
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection
