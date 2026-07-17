<style>
    .wi-page {
        background: #f7f9fc;
        margin: -16px;
        padding: 24px;
        min-height: calc(100vh - 64px);
    }

    .wi-hero {
        background: linear-gradient(135deg, #fff7fb 0%, #ffffff 48%, #fff6df 100%);
        border: 1px solid #ffd6e8;
        box-shadow: 0 18px 45px rgba(61, 81, 112, 0.08);
    }

    .wi-panel,
    .wi-card {
        background: #fff;
        border: 1px solid #e4e9f2;
        border-radius: 10px;
        box-shadow: 0 12px 28px rgba(61, 81, 112, 0.08);
    }

    .wi-card {
        position: relative;
        overflow: hidden;
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .wi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 36px rgba(61, 81, 112, 0.13);
    }

    .wi-card:before {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        height: 4px;
    }

    .wi-card-pink:before { background: #f40167; }
    .wi-card-green:before { background: #10b981; }
    .wi-card-orange:before { background: #f59e0b; }
    .wi-card-red:before { background: #ef4444; }

    .wi-icon {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .wi-section-title {
        color: #23324d;
        letter-spacing: .01em;
    }

    .wi-muted {
        color: #667085;
    }

    .wi-table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .wi-table thead tr {
        background: #fff7fb;
        color: #344054;
    }

    .wi-table thead th {
        font-weight: 800;
        white-space: nowrap;
        border-bottom: 1px solid #ffd6e8;
    }

    .wi-table tbody tr:nth-child(even) {
        background: #fbfcff;
    }

    .wi-table tbody tr:hover {
        background: #fff4d8;
    }

    .wi-table-fixed {
        table-layout: fixed;
    }

    .wi-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: block;
    }

    .wi-progress {
        height: 10px;
        background: #e8edf5;
        border-radius: 999px;
        overflow: hidden;
    }

    .wi-progress-bar {
        height: 10px;
        background: linear-gradient(90deg, #f40167, #f4ad2b);
        border-radius: 999px;
    }

    .wi-pill {
        border: 1px solid #e4e9f2;
        background: #f8fafc;
        color: #344054;
        font-size: 12px;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 999px;
        display: inline-block;
    }

    .wi-month-filter {
        height: 44px;
        min-width: 190px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 6px 12px;
        border-radius: 14px;
        border: 1px solid #ffd6e8;
        background: linear-gradient(135deg, #ffffff 0%, #fff7fb 100%);
        box-shadow: 0 10px 26px rgba(244, 1, 103, .12);
        cursor: pointer;
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
    }

    .wi-month-filter:hover {
        transform: translateY(-1px);
        border-color: #f40167;
        box-shadow: 0 14px 32px rgba(244, 1, 103, .18);
    }

    .wi-month-icon {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        background: linear-gradient(135deg, #f40167, #f4ad2b);
        flex: 0 0 32px;
    }

    .wi-month-text {
        display: flex;
        flex-direction: column;
        gap: 1px;
        min-width: 0;
    }

    .wi-month-label {
        color: #f40167;
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .04em;
        line-height: 1;
    }

    .wi-month-input {
        width: 120px;
        height: 22px;
        border: 0 !important;
        outline: 0 !important;
        padding: 0 !important;
        background: transparent !important;
        color: #23324d;
        font-size: 13px;
        font-weight: 900;
        line-height: 1;
        cursor: pointer;
    }

    .wi-month-input::-webkit-calendar-picker-indicator {
        cursor: pointer;
        opacity: .7;
        filter: hue-rotate(295deg) saturate(1.5);
    }

    .wi-month-clear {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        color: #f40167;
        border: 1px solid #ffd6e8;
        box-shadow: 0 10px 24px rgba(61, 81, 112, .08);
        transition: transform .18s ease, box-shadow .18s ease, background .18s ease;
    }

    .wi-month-clear:hover {
        transform: translateY(-1px);
        background: #fff7fb;
        box-shadow: 0 14px 30px rgba(244, 1, 103, .14);
    }

    .wi-type-pill {
        border-radius: 999px;
        padding: 5px 10px;
        font-size: 11px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
        border: 1px solid transparent;
    }

    .wi-type-add {
        background: #dcfce7;
        color: #166534;
        border-color: #bbf7d0;
    }

    .wi-type-subtract {
        background: #fee2e2;
        color: #991b1b;
        border-color: #fecaca;
    }

    .wi-type-transfer {
        background: #dbeafe;
        color: #1d4ed8;
        border-color: #bfdbfe;
    }

    .wi-type-none {
        background: #f1f5f9;
        color: #475569;
        border-color: #e2e8f0;
    }

    .wi-code {
        background: #f8fafc;
        border: 1px solid #e4e9f2;
        color: #344054;
        border-radius: 6px;
        padding: 4px 8px;
        font-size: 12px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        max-width: 100%;
    }

    .wi-code i {
        color: #f40167;
        margin-right: 6px;
    }

    .wi-item-photo {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid #e4e9f2;
        background: #f8fafc;
        flex: 0 0 48px;
    }

    .wi-item-photo-placeholder {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        border: 1px solid #e4e9f2;
        background: #fff7fb;
        color: #f40167;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 48px;
    }

    .wi-picker {
        position: relative;
    }

    .wi-picker-panel {
        position: absolute;
        left: 0;
        right: 0;
        top: calc(100% + 6px);
        background: #fff;
        border: 1px solid #d7deea;
        border-radius: 10px;
        box-shadow: 0 18px 45px rgba(61, 81, 112, .16);
        z-index: 20;
        max-height: 320px;
        overflow-y: auto;
        display: none;
    }

    .wi-picker-panel.is-open {
        display: block;
    }

    .wi-picker-option {
        width: 100%;
        border: 0;
        background: #fff;
        display: flex;
        align-items: center;
        text-align: left;
        padding: 10px;
        cursor: pointer;
        border-bottom: 1px solid #edf1f7;
    }

    .wi-picker-option:hover {
        background: #fff7fb;
    }

    .wi-picker-option:last-child {
        border-bottom: 0;
    }

    .wi-movement-board {
        display: flex;
        border: 1px solid #e4e9f2;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        min-height: 520px;
    }

    .wi-movement-catalog {
        width: 38%;
        border-right: 1px solid #e4e9f2;
        background: #fbfcff;
        display: flex;
        flex-direction: column;
    }

    .wi-movement-selected {
        width: 62%;
        display: flex;
        flex-direction: column;
        background: #fff;
    }

    .wi-movement-header {
        padding: 16px;
        border-bottom: 1px solid #e4e9f2;
        background: #fff;
    }

    .wi-product-scroll,
    .wi-selected-scroll {
        overflow-y: auto;
        padding: 12px;
    }

    .wi-product-scroll {
        max-height: 430px;
    }

    .wi-selected-scroll {
        max-height: 470px;
    }

    .wi-catalog-item,
    .wi-selected-item {
        display: flex;
        align-items: center;
        width: 100%;
        border: 0;
        background: transparent;
        text-align: left;
        padding: 10px;
        border-radius: 10px;
    }

    .wi-catalog-item {
        cursor: pointer;
    }

    .wi-catalog-item:hover {
        background: #fff7fb;
    }

    .wi-selected-item {
        border-bottom: 1px solid #edf1f7;
        border-radius: 0;
    }

    .wi-selected-fields {
        display: flex;
        align-items: flex-end;
        gap: 12px;
        margin-left: auto;
    }

    .wi-selected-fields .wi-input {
        width: 108px;
    }

    @media (max-width: 992px) {
        .wi-movement-board {
            display: block;
        }

        .wi-movement-catalog,
        .wi-movement-selected {
            width: 100%;
        }

        .wi-movement-catalog {
            border-right: 0;
            border-bottom: 1px solid #e4e9f2;
        }
    }

    .wi-icon-btn {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        border: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .wi-row-actions {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 4px;
        border: 1px solid #e4e9f2;
        border-radius: 999px;
        background: #fff;
        box-shadow: 0 6px 16px rgba(61, 81, 112, .08);
    }

    .wi-row-action-btn {
        width: 30px !important;
        height: 30px !important;
        min-width: 30px !important;
        padding: 0 !important;
        border-radius: 999px !important;
        border: 0 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: #f8fafc !important;
        color: #64748b !important;
        box-shadow: none !important;
        line-height: 1 !important;
        cursor: pointer;
        transition: background .15s ease, color .15s ease, transform .15s ease;
    }

    .wi-row-action-btn:hover {
        transform: translateY(-1px);
    }

    .wi-row-action-edit:hover,
    .wi-row-action-save:hover {
        background: #eff6ff !important;
        color: #2563eb !important;
    }

    .wi-row-action-delete:hover,
    .wi-row-action-remove:hover {
        background: #fff1f2 !important;
        color: #e11d48 !important;
    }

    .wi-modal-backdrop {
        position: fixed;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background: rgba(15, 23, 42, .55);
        z-index: 9998;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 24px;
    }

    .wi-modal-backdrop.is-open {
        display: flex;
    }

    .wi-modal {
        width: 100%;
        max-width: 980px;
        max-height: 88vh;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 28px 80px rgba(15, 23, 42, .28);
        display: flex;
        flex-direction: column;
    }

    .wi-modal-header {
        background: linear-gradient(135deg, #fff7fb 0%, #ffffff 55%, #fff6df 100%);
        border-bottom: 1px solid #ffd6e8;
        z-index: 1;
    }

    .wi-modal > form {
        display: flex;
        flex-direction: column;
        min-height: 0;
    }

    .wi-modal-body {
        flex: 1;
        overflow-y: auto;
        padding: 16px;
    }

    .wi-modal-footer {
        border-top: 1px solid #e4e9f2;
        background: #fff;
        padding: 14px 16px;
    }

    .wi-form-label {
        display: block;
        color: #344054;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .wi-form-section {
        border: 1px solid #edf1f7;
        background: #fbfcff;
        border-radius: 10px;
        padding: 14px 14px 4px;
        margin-bottom: 14px;
    }

    .wi-form-section-title {
        display: flex;
        align-items: center;
        color: #23324d;
        font-weight: 900;
        font-size: 13px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .wi-form-section-title i {
        color: #f40167;
        margin-right: 8px;
    }

    .wi-input-icon {
        position: relative;
    }

    .wi-input-icon i {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: #f40167;
        z-index: 1;
    }

    .wi-input-icon .wi-input {
        padding-left: 36px !important;
    }

    .wi-input,
    .wi-select,
    .wi-textarea {
        width: 100%;
        border: 1px solid #d7deea !important;
        border-radius: 8px !important;
        padding: 9px 10px !important;
        background: #fff !important;
        color: #23324d !important;
        height: 40px !important;
        box-sizing: border-box !important;
        margin: 0 !important;
    }

    .wi-textarea {
        height: auto !important;
        min-height: 40px;
    }

    .wi-input:focus,
    .wi-select:focus,
    .wi-textarea:focus {
        border-color: #f40167 !important;
        box-shadow: 0 0 0 3px rgba(244, 1, 103, .12) !important;
        outline: none !important;
    }

    .wi-btn-primary,
    .wi-btn-dark,
    .wi-btn-danger,
    .wi-btn-light {
        border: 0;
        border-radius: 8px;
        font-weight: 800;
        padding: 10px 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
        cursor: pointer;
    }

    .wi-btn-primary {
        background: #f40167;
        color: #fff;
    }

    .wi-btn-dark {
        background: #23324d;
        color: #fff;
    }

    .wi-btn-danger {
        background: #ef4444;
        color: #fff;
    }

    .wi-btn-light {
        background: #fff;
        color: #23324d;
        border: 1px solid #d7deea;
    }

    .wi-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }

    .wi-overflow {
        overflow-x: auto;
    }

    .wi-toast-wrap {
        position: fixed;
        right: 24px;
        top: 84px;
        z-index: 10000;
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-width: 380px;
    }

    .wi-toast {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        border-radius: 12px;
        padding: 14px 16px;
        background: #fff;
        border: 1px solid #e4e9f2;
        box-shadow: 0 18px 45px rgba(61, 81, 112, .16);
        color: #23324d;
        transition: opacity .25s ease, transform .25s ease;
        position: relative;
    }

    .wi-toast.is-hiding {
        opacity: 0;
        transform: translateY(-8px);
    }

    .wi-toast-success {
        border-left: 4px solid #10b981;
    }

    .wi-toast-error {
        border-left: 4px solid #ef4444;
    }

    .wi-toast i {
        margin-top: 2px;
    }

    .wi-toast-success i {
        color: #10b981;
    }

    .wi-toast-error i {
        color: #ef4444;
    }

    .wi-toast-close {
        border: 0;
        background: #f3f6fb;
        color: #64748b;
        width: 26px;
        height: 26px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-left: auto;
        cursor: pointer;
        flex-shrink: 0;
        transition: background .15s ease, color .15s ease, transform .15s ease;
    }

    .wi-toast-close:hover {
        background: #fee2e2;
        color: #dc2626;
        transform: scale(1.06);
    }

    .wi-toast-close i {
        margin: 0;
        color: inherit;
        font-size: 12px;
    }
</style>
