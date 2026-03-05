@extends('admin.fbads.layouts')

@section('page')

<div style="max-width:480px;margin:0 auto;padding:24px 0;">

    <div style="background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(0,0,0,.08);overflow:hidden;">
        <!-- Header -->
        <div style="background:linear-gradient(135deg,#f59e0b,#d97706);padding:20px 24px;">
            <div style="font-size:18px;font-weight:700;color:#fff;">
                <i class="fas fa-edit" style="margin-right:8px;"></i>Edit Entry
            </div>
            <div style="font-size:13px;color:rgba(255,255,255,.75);margin-top:4px;">
                Logged by {{ $entry->user->first_name }} {{ $entry->user->last_name }}
                &mdash; {{ $entry->created_at->format('M d, Y g:i A') }}
            </div>
        </div>

        <form method="POST" action="{{ route('fbads.incentives.update', $entry->id) }}" style="padding:24px;">
            @csrf
            @method('PUT')

            <!-- Type selector -->
            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:13px;font-weight:700;color:#374151;margin-bottom:10px;text-transform:uppercase;letter-spacing:.5px;">Activity Type</label>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                    @foreach(['Upsell', 'InfoTxt', 'Pancake', 'Events'] as $type)
                    <label style="cursor:pointer;">
                        <input type="radio" name="type" value="{{ $type }}" style="display:none;" class="type-radio"
                            {{ (old('type', $entry->type) == $type) ? 'checked' : '' }}>
                        <div class="type-card" style="border:2px solid #e2e8f0;border-radius:10px;padding:12px 10px;text-align:center;transition:all .15s;background:#f8fafc;">
                            <div style="font-size:14px;font-weight:700;color:#475569;">{{ $type }}</div>
                        </div>
                    </label>
                    @endforeach
                </div>
                @error('type')
                    <div style="font-size:12px;color:#ef4444;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Mobile number -->
            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:13px;font-weight:700;color:#374151;margin-bottom:8px;text-transform:uppercase;letter-spacing:.5px;">Customer Mobile Number</label>
                <div style="position:relative;">
                    <i class="fas fa-mobile-alt" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:15px;"></i>
                    <input type="text" name="customer_mobile" value="{{ old('customer_mobile', $entry->customer_mobile) }}"
                        placeholder="e.g. 09551234567"
                        style="width:100%;padding:11px 12px 11px 36px;border:2px solid #e2e8f0;border-radius:10px;font-size:15px;outline:none;box-sizing:border-box;transition:border-color .15s;"
                        onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='#e2e8f0'">
                </div>
                @error('customer_mobile')
                    <div style="font-size:12px;color:#ef4444;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex;gap:10px;">
                <a href="{{ route('fbads.incentives.index') }}"
                    style="flex:1;background:#f1f5f9;color:#475569;border:none;border-radius:10px;padding:13px;font-size:15px;font-weight:600;cursor:pointer;text-align:center;text-decoration:none;display:block;">
                    Cancel
                </a>
                <button type="submit"
                    style="flex:2;background:linear-gradient(135deg,#f59e0b,#d97706);color:#fff;border:none;border-radius:10px;padding:13px;font-size:15px;font-weight:700;cursor:pointer;">
                    <i class="fas fa-save" style="margin-right:8px;"></i>Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.type-radio:checked + .type-card {
    border-color: #f59e0b !important;
    background: #fef9c3 !important;
}
.type-card:hover {
    border-color: #fcd34d !important;
    background: #fffbeb !important;
}
</style>

<script>
document.querySelectorAll('.type-radio').forEach(function(radio) {
    radio.addEventListener('change', function() {
        document.querySelectorAll('.type-card').forEach(function(card) {
            card.style.borderColor = '#e2e8f0';
            card.style.background = '#f8fafc';
        });
        if (this.checked) {
            this.nextElementSibling.style.borderColor = '#f59e0b';
            this.nextElementSibling.style.background = '#fef9c3';
        }
    });
});

document.querySelectorAll('.type-radio:checked').forEach(function(radio) {
    radio.nextElementSibling.style.borderColor = '#f59e0b';
    radio.nextElementSibling.style.background = '#fef9c3';
});
</script>

@endsection
