@extends('admin.layouts.app')

@section('css')
<style>
.jt-detail-table-wrap {
    overflow: auto;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    background: #ffffff;
}
.jt-detail-table {
    min-width: 1050px;
    width: 100%;
    border-collapse: collapse;
}
.jt-detail-table thead th {
    position: sticky;
    top: 0;
    z-index: 1;
    background: #f8fafc;
    color: #0f172a;
    font-size: 12px;
    font-weight: 700;
    padding: 11px 10px;
    border-bottom: 1px solid #e2e8f0;
    white-space: nowrap;
}
.jt-detail-table tbody td {
    font-size: 12px;
    color: #334155;
    padding: 10px;
    border-bottom: 1px solid #f1f5f9;
    white-space: nowrap;
}
.jt-detail-table tbody tr:nth-child(even) { background: #fcfdff; }
.jt-detail-table tbody tr:hover { background: #f8fafc; }
.jt-money { font-weight: 700; color: #0f172a; }
.jt-bill { font-weight: 700; color: #111827; }
.jt-muted-col { color: #94a3b8 !important; font-weight: 600; }
.jt-pop-col { color: #0f172a !important; font-weight: 800; }
</style>
@endsection

@section('content')
<div style="background:#fff;border:1px solid #e5e7eb;border-radius:14px;padding:16px;">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;margin-bottom:14px;">
        <div>
            <h1 style="margin:0;font-size:20px;font-weight:800;color:#111827;">
                J&amp;T Payout Detail
            </h1>
            <div style="font-size:12px;color:#6b7280;margin-top:4px;">
                {{ $upload->original_file_name }} | Payout Date: {{ $upload->payout_date ? date_f($upload->payout_date, 'M d, Y') : '—' }}
            </div>
        </div>
        <a href="{{ route('fbads.jandt_payouts') }}" style="background:#f3f4f6;color:#111827;text-decoration:none;padding:8px 12px;border-radius:8px;font-size:12px;font-weight:700;">
            Back
        </a>
    </div>

    <div style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:10px;margin-bottom:14px;">
        <div style="border:1px solid #e5e7eb;border-radius:10px;padding:10px;">
            <div style="font-size:11px;color:#6b7280;">COD Total Amount</div>
            <div style="font-size:16px;font-weight:800;color:#111827;">₱{{ number_format((float)$totals->cod_total_amount, 2) }}</div>
        </div>
        <div style="border:1px solid #e5e7eb;border-radius:10px;padding:10px;">
            <div style="font-size:11px;color:#6b7280;">COD Deductions (COD Total - COD Payable)</div>
            <div style="font-size:16px;font-weight:800;color:#b91c1c;">₱{{ number_format((float)$totals->cod_total_amount - (float)$totals->total_cod_payable, 2) }}</div>
        </div>
        <div style="border:1px solid #e5e7eb;border-radius:10px;padding:10px;">
            <div style="font-size:11px;color:#6b7280;">Total Freight Receivable</div>
            <div style="font-size:16px;font-weight:800;color:#64748b;">₱{{ number_format((float)$totals->total_freight_receivable, 2) }}</div>
        </div>
        <div style="border:1px solid #e5e7eb;border-radius:10px;padding:10px;">
            <div style="font-size:11px;color:#6b7280;">Return Shipping</div>
            <div style="font-size:16px;font-weight:800;color:#64748b;">₱{{ number_format((float)$totals->return_shipping, 2) }}</div>
        </div>
        <div style="border:1px solid #e5e7eb;border-radius:10px;padding:10px;">
            <div style="font-size:11px;color:#6b7280;">Amount After Deduction</div>
            <div style="font-size:16px;font-weight:800;color:#111827;">₱{{ number_format((float)$totals->amount_after_deduction, 2) }}</div>
        </div>
        <div style="border:1px solid #e5e7eb;border-radius:10px;padding:10px;">
            <div style="font-size:11px;color:#6b7280;">Total Deduction</div>
            <div style="font-size:16px;font-weight:800;color:#b91c1c;">₱{{ number_format((float)$totalDeduction, 2) }}</div>
        </div>
        <div style="border:1px solid #e5e7eb;border-radius:10px;padding:10px;">
            <div style="font-size:11px;color:#6b7280;">Rows</div>
            <div style="font-size:16px;font-weight:800;color:#111827;">{{ number_format($rows->total()) }}</div>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:10px;margin-bottom:14px;">
        <div style="font-size:12px;color:#334155;">Prev Period Deduction: <b>₱{{ number_format((float)$totals->previous_period_bill_deduction, 2) }}</b></div>
        <div style="font-size:12px;color:#334155;">Current Period Deduction: <b>₱{{ number_format((float)$totals->current_period_bill_deduction, 2) }}</b></div>
        <div style="font-size:12px;color:#334155;">Total Adjustment: <b>₱{{ number_format((float)$totals->total_adjustment, 2) }}</b></div>
    </div>

    <div class="jt-detail-table-wrap">
        <table class="jt-detail-table">
            <thead>
                <tr>
                    <th>Bill #</th>
                    <th>Billing Date</th>
                    <th>COD Total Amount</th>
                    <th>COD Deductions</th>
                    <th>Total Freight Receivable</th>
                    <th>Return Shipping</th>
                    <th>Amount After Deduction</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $row)
                    @php
                        $billingLabel = $row->billing_date_raw;
                        if (strpos((string) $row->billing_date_raw, '+') !== false) {
                            $parts = explode('+', (string) $row->billing_date_raw);
                            $fromTs = strtotime($parts[0]);
                            $toTs = strtotime($parts[1]);
                            if ($fromTs && $toTs) {
                                $billingLabel = date('M d', $fromTs) . ' to ' . date('M d Y', $toTs);
                            }
                        }
                    @endphp
                    <tr>
                        <td class="jt-bill">{{ preg_replace('/-F\\d+$/', '', (string) $row->bill_number) }}</td>
                        <td>{{ $billingLabel }}</td>
                        <td class="jt-money jt-pop-col">₱{{ number_format((float)$row->cod_total_amount, 2) }}</td>
                        <td class="jt-money jt-muted-col">₱{{ number_format((float)$row->cod_total_amount - (float)$row->total_cod_payable, 2) }}</td>
                        <td class="jt-money jt-muted-col">₱{{ number_format((float)$row->total_freight_receivable, 2) }}</td>
                        <td class="jt-money jt-muted-col">₱{{ number_format((float)$row->return_shipping, 2) }}</td>
                        <td class="jt-money jt-pop-col">₱{{ number_format((float)$row->amount_after_deduction, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top:12px;">
        {{ $rows->links() }}
    </div>
</div>
@endsection
