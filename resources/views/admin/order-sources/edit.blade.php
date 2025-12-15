@extends('admin.order-sources.layouts')

@section('content')
<div class="tmax-w-2xl tmx-auto tp-6">
    <div class="tbg-white trounded-lg tshadow-lg tp-6">
        <!-- Header -->
        <div class="tflex titems-center tmb-6">
            <a href="{{ route('order-sources.index') }}" class="ttext-gray-600 hover:ttext-gray-900 tmr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ttext-2xl tfont-bold ttext-gray-900">Edit Order Source</h1>
        </div>

        <!-- Validation Errors -->
        @if($errors->any())
            <div class="tbg-red-100 tborder tborder-red-400 ttext-red-700 tpx-4 tpy-3 trounded tmb-4">
                <ul class="tlist-disc tlist-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('order-sources.update', $source->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="tmb-4">
                <label class="tblock ttext-sm tfont-medium ttext-gray-700 tmb-2">Source Name *</label>
                <input type="text" name="name" value="{{ old('name', $source->name) }}" required
                    class="tw-full tpx-4 tpy-2 tborder tborder-gray-300 trounded-lg focus:toutline-none focus:tborder-pink-500">
            </div>

            <!-- Type -->
            <div class="tmb-4">
                <label class="tblock ttext-sm tfont-medium ttext-gray-700 tmb-2">Source Type *</label>
                <select name="type" required class="tw-full tpx-4 tpy-2 tborder tborder-gray-300 trounded-lg focus:toutline-none focus:tborder-pink-500">
                    <option value="website" {{ old('type', $source->type) == 'website' ? 'selected' : '' }}>Website</option>
                    <option value="social" {{ old('type', $source->type) == 'social' ? 'selected' : '' }}>Social Media</option>
                    <option value="sms" {{ old('type', $source->type) == 'sms' ? 'selected' : '' }}>SMS/Text</option>
                    <option value="call" {{ old('type', $source->type) == 'call' ? 'selected' : '' }}>Phone Call</option>
                    <option value="event" {{ old('type', $source->type) == 'event' ? 'selected' : '' }}>Event</option>
                    <option value="referral" {{ old('type', $source->type) == 'referral' ? 'selected' : '' }}>Referral</option>
                    <option value="other" {{ old('type', $source->type) == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <!-- Description -->
            <div class="tmb-4">
                <label class="tblock ttext-sm tfont-medium ttext-gray-700 tmb-2">Description</label>
                <textarea name="description" rows="3"
                    class="tw-full tpx-4 tpy-2 tborder tborder-gray-300 trounded-lg focus:toutline-none focus:tborder-pink-500">{{ old('description', $source->description) }}</textarea>
            </div>

            <!-- Color -->
            <div class="tmb-4">
                <label class="tblock ttext-sm tfont-medium ttext-gray-700 tmb-2">Color (Hex Code)</label>
                <div class="tflex titems-center tgap-2">
                    <input type="color" id="colorPicker" value="{{ old('color', $source->color) }}"
                        class="tw-12 th-10 tborder tborder-gray-300 trounded">
                    <input type="text" name="color" id="colorHex" value="{{ old('color', $source->color) }}"
                        class="tflex-1 tpx-4 tpy-2 tborder tborder-gray-300 trounded-lg focus:toutline-none focus:tborder-pink-500"
                        pattern="^#[0-9A-Fa-f]{6}$">
                </div>
            </div>

            <!-- Active Status -->
            <div class="tmb-6">
                <label class="tflex titems-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $source->is_active) ? 'checked' : '' }}
                        class="tw-4 th-4 ttext-pink-600 tborder-gray-300 trounded focus:tring-pink-500">
                    <span class="tml-2 ttext-sm ttext-gray-700">Active</span>
                </label>
            </div>

            <!-- Buttons -->
            <div class="tflex tjustify-end tgap-3">
                <a href="{{ route('order-sources.index') }}" class="tpx-4 tpy-2 tbg-gray-200 ttext-gray-700 trounded-lg hover:tbg-gray-300">
                    Cancel
                </a>
                <button type="submit" class="tpx-4 tpy-2 tbg-pink-600 ttext-white trounded-lg hover:tbg-pink-700">
                    Update Source
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('colorPicker').addEventListener('input', function() {
    document.getElementById('colorHex').value = this.value;
});

document.getElementById('colorHex').addEventListener('input', function() {
    if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
        document.getElementById('colorPicker').value = this.value;
    }
});
</script>
@endsection