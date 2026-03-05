@extends('admin.fbads.layouts')

@section('page')

<div style="max-width:480px;margin:0 auto;padding:24px 0;">

    @if(session('success'))
        <div style="background:#dcfce7;border:1px solid #86efac;color:#15803d;border-radius:10px;padding:12px 16px;margin-bottom:16px;font-size:14px;font-weight:600;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(0,0,0,.08);overflow:hidden;">
        <!-- Header -->
        <div style="background:linear-gradient(135deg,#6366f1,#8b5cf6);padding:20px 24px;">
            <div style="font-size:18px;font-weight:700;color:#fff;">
                <i class="fas fa-plus-circle" style="margin-right:8px;"></i>New Incentive Entry
            </div>
            <div style="font-size:13px;color:rgba(255,255,255,.75);margin-top:4px;">Log your activity for incentive tracking</div>
        </div>

        <!-- Agent info -->
        <div style="padding:16px 24px 0;display:flex;align-items:center;gap:10px;">
            <div style="width:38px;height:38px;border-radius:50%;background:#ede9fe;display:flex;align-items:center;justify-content:center;">
                <i class="fas fa-user" style="color:#7c3aed;font-size:16px;"></i>
            </div>
            <div>
                <div style="font-size:13px;color:#94a3b8;">Logged as</div>
                <div style="font-size:15px;font-weight:700;color:#0f172a;">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
            </div>
        </div>

        <form method="POST" action="{{ route('fbads.incentives.store') }}" style="padding:20px 24px 24px;">
            @csrf

            <!-- Type selector -->
            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:13px;font-weight:700;color:#374151;margin-bottom:10px;text-transform:uppercase;letter-spacing:.5px;">Activity Type</label>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                    @foreach(['Upsell' => ['#fee2e2','#ef4444','#b91c1c'], 'InfoTxt' => ['#dbeafe','#3b82f6','#1d4ed8'], 'Pancake' => ['#fef9c3','#eab308','#92400e'], 'Events' => ['#dcfce7','#22c55e','#15803d']] as $type => [$bg, $border, $text])
                    <label style="cursor:pointer;">
                        <input type="radio" name="type" value="{{ $type }}" style="display:none;" class="type-radio" {{ old('type') == $type ? 'checked' : '' }}>
                        <div class="type-card" data-type="{{ $type }}" style="border:2px solid #e2e8f0;border-radius:10px;padding:12px 10px;text-align:center;transition:all .15s;background:#f8fafc;">
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
                    <input type="text" name="customer_mobile" value="{{ old('customer_mobile') }}"
                        placeholder="e.g. 09551234567"
                        style="width:100%;padding:11px 12px 11px 36px;border:2px solid #e2e8f0;border-radius:10px;font-size:15px;outline:none;box-sizing:border-box;transition:border-color .15s;"
                        onfocus="this.style.borderColor='#6366f1'" onblur="this.style.borderColor='#e2e8f0'">
                </div>
                @error('customer_mobile')
                    <div style="font-size:12px;color:#ef4444;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit"
                style="width:100%;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:10px;padding:13px;font-size:15px;font-weight:700;cursor:pointer;letter-spacing:.3px;">
                <i class="fas fa-check" style="margin-right:8px;"></i>Submit Entry
            </button>
        </form>
    </div>

    <div style="text-align:center;margin-top:14px;">
        <a href="{{ route('fbads.incentives.index') }}" style="font-size:13px;color:#6366f1;text-decoration:none;">
            <i class="fas fa-list" style="margin-right:4px;"></i>View all entries
        </a>
    </div>
</div>

<style>
.type-radio:checked + .type-card {
    border-color: #6366f1 !important;
    background: #ede9fe !important;
}
.type-card:hover {
    border-color: #a5b4fc !important;
    background: #f5f3ff !important;
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
            this.nextElementSibling.style.borderColor = '#6366f1';
            this.nextElementSibling.style.background = '#ede9fe';
        }
    });
});

// Init checked state on load
document.querySelectorAll('.type-radio:checked').forEach(function(radio) {
    radio.nextElementSibling.style.borderColor = '#6366f1';
    radio.nextElementSibling.style.background = '#ede9fe';
});
</script>

@endsection
