@extends('admin.layouts.app')

@section('content')
@include('admin.warehouse_inventory.partials.styles')

<div class="wi-page">
    @include('admin.warehouse_inventory.partials.toast')

    <div class="wi-hero trounded-lg tp-5 tmb-5">
        <div class="wi-toolbar">
            <div>
                <div class="ttext-xs tfont-bold tuppercase" style="color:#f40167;">Movement Audit Trail</div>
                <h4 class="tm-0 tfont-bold wi-section-title">{{ $batchCode }}</h4>
                <div class="ttext-sm wi-muted">Create, edit, and failed edit history for this movement batch.</div>
            </div>
            <a href="{{ route('warehouse_inventory.movements', ['display' => 'summary']) }}" class="wi-btn-dark waves-effect">
                <i class="fas fa-arrow-left tmr-2"></i> Movement History
            </a>
        </div>
    </div>

    <div class="wi-panel tp-4">
        @forelse($audits as $audit)
            @php
                $actionStyle = [
                    'created' => ['label' => 'Created', 'icon' => 'fas fa-plus-circle', 'color' => '#16a34a', 'bg' => '#dcfce7'],
                    'updated' => ['label' => 'Updated', 'icon' => 'fas fa-pen', 'color' => '#2563eb', 'bg' => '#dbeafe'],
                    'update_failed' => ['label' => 'Update Failed', 'icon' => 'fas fa-exclamation-triangle', 'color' => '#dc2626', 'bg' => '#fee2e2'],
                ][$audit->action] ?? ['label' => ucfirst($audit->action), 'icon' => 'fas fa-circle', 'color' => '#475569', 'bg' => '#f1f5f9'];
                $before = $audit->before_snapshot ?: [];
                $after = $audit->after_snapshot ?: [];
            @endphp
            <div class="tborder tborder-gray-200 trounded-lg tp-4 tmb-4" style="background:#fff;">
                <div class="tflex titems-start tjustify-between tflex-wrap tmb-3" style="gap:12px;">
                    <div class="tflex titems-start" style="gap:12px;">
                        <span class="tinline-flex titems-center tjustify-center trounded-full" style="width:38px;height:38px;background:{{ $actionStyle['bg'] }};color:{{ $actionStyle['color'] }};">
                            <i class="{{ $actionStyle['icon'] }}"></i>
                        </span>
                        <div>
                            <div class="tfont-bold wi-section-title">{{ $actionStyle['label'] }}</div>
                            <div class="ttext-xs wi-muted">
                                {{ optional($audit->created_at)->format('M d, g:iA') }}
                                by {{ optional($audit->user)->first_name ?: 'Unknown' }}
                            </div>
                        </div>
                    </div>
                    <span class="wi-code">{{ $audit->batch_code }}</span>
                </div>

                <div class="ttext-sm wi-section-title tmb-3">{{ $audit->summary ?: '-' }}</div>

                @if($audit->error_message)
                    <div class="tp-3 tmb-3 trounded" style="background:#fff1f2;color:#be123c;border:1px solid #fecdd3;">
                        <strong>Error:</strong> {{ $audit->error_message }}
                    </div>
                @endif

                <div class="row tmb-0">
                    <div class="col s12 m6 tmb-3">
                        @include('admin.warehouse_inventory.movements.partials.audit_snapshot', ['title' => 'Before', 'snapshot' => $before, 'compareSnapshot' => $after, 'side' => 'before'])
                    </div>
                    <div class="col s12 m6 tmb-3">
                        @include('admin.warehouse_inventory.movements.partials.audit_snapshot', ['title' => 'After', 'snapshot' => $after, 'compareSnapshot' => $before, 'side' => 'after'])
                    </div>
                </div>
            </div>
        @empty
            <div class="tpy-10 ttext-center wi-muted">No audit records yet.</div>
        @endforelse

        <div class="tp-2">{{ $audits->links() }}</div>
    </div>
</div>
@endsection
