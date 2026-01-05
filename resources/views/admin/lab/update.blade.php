@extends('admin.lab.layouts')

@section('css')

    <style>
        .autocomplete-content img {
            display: none;
        }
        .modal .modal-content {
            height: 50vh;
        }
        .dropzone {
            background: white;
            border-radius: 5px;
            border: 2px dashed #919eab;
            border-image: none;
        }
        .dropzone .dz-message {
            text-align: center;
            margin: 0;
        }
    </style>

    {{-- Search Style --}}
    <style>
        #myInput {
            background-image: url('/css/searchicon.png'); /* Add a search icon to input */
            background-position: 10px 12px; /* Position the search icon */
            background-repeat: no-repeat; /* Do not repeat the icon image */
            width: 100%; /* Full-width */
            font-size: 16px; /* Increase font-size */
            padding: 12px 20px 12px 40px; /* Add some padding */
            border: 1px solid #ddd; /* Add a grey border */
            margin-bottom: 12px; /* Add some space below the input */
        }

        #myUL {
            /* Remove default list styling */
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #myUL li a {
            border: 1px solid #ddd; /* Add a border to all links */
            margin-top: -1px; /* Prevent double borders */
            background-color: #f6f6f6; /* Grey background color */
            padding: 12px; /* Add some padding */
            text-decoration: none; /* Remove default text underline */
            font-size: 18px; /* Increase the font-size */
            color: black; /* Add a black text color */
            display: block; /* Make it into a block element to fill the whole list */
        }

        #myUL li a:hover:not(.header) {
            background-color: #eee; /* Add a hover effect to all links, except for headers */
        }
    </style>



    <style>
        /* =========================
        TRANSACTION – COMPACT UI
        ========================= */

        .txn-card{
        border-radius:16px;
        overflow:hidden;
        }

        /* Header */
        .txn-header{
        padding:14px 16px;
        border-bottom:1px solid #eef2f7;
        }
        .txn-title{
        font-size:18px;
        font-weight:800;
        margin:0;
        }
        .txn-sub{
        font-size:13px;
        color:#94a3b8;
        margin-top:2px;
        }

        /* Body */
        .txn-body{
        padding:14px 16px;
        }

        /* Grid */
        .txn-grid{
        display:grid;
        grid-template-columns:repeat(12,1fr);
        gap:10px;
        }

        /* Fields */
        .txn-field{ display:flex; flex-direction:column; }
        .txn-span-12{ grid-column:span 12; }
        .txn-span-4{ grid-column:span 4; }

        .txn-label{
        font-size:13px;
        font-weight:700;
        color:#334155;
        margin-bottom:4px;
        }
        .txn-label span{
        font-weight:500;
        color:#94a3b8;
        }

        /* Inputs */
        .txn-input{
        height:38px !important;
        padding:8px 10px !important;
        border-radius:10px !important;
        border:1px solid #e2e8f0 !important;
        font-size:14px !important;
        background:#fff;
        }

        .txn-input:focus{
        border-color:#2563eb !important;
        box-shadow:0 0 0 2px rgba(37,99,235,.12) !important;
        }

        /* Readonly */
        .txn-readonly{
        background:#f8fafc !important;
        cursor:not-allowed;
        }

        /* Textarea */
        .txn-textarea{
        min-height:70px;
        padding:8px 10px;
        border-radius:10px;
        border:1px solid #e2e8f0;
        font-size:14px;
        }

        /* Auto badge */
        .txn-rel{ position:relative; }
        .txn-badge{
        position:absolute;
        right:10px;
        top:50%;
        transform:translateY(-50%);
        background:#f1f5f9;
        color:#64748b;
        font-size:11px;
        padding:3px 8px;
        border-radius:999px;
        pointer-events:none;
        }

        /* Actions */
        .txn-actions{
        margin-top:12px;
        padding-top:12px;
        border-top:1px solid #eef2f7;
        display:flex;
        justify-content:flex-end;
        gap:10px;
        }

        /* Buttons (Materialize-safe) */
        .txn-btn{
        display:inline-flex !important;
        align-items:center !important;
        gap:8px !important;
        height:38px !important;
        padding:0 14px !important;
        font-size:13px !important;
        font-weight:800 !important;
        border-radius:10px !important;
        cursor:pointer !important;
        border:1px solid transparent !important;
        text-decoration:none !important;
        line-height:1 !important;
        }

        /* Cancel */
        .txn-btn-ghost{
        background:#ffffff !important;
        border-color:#e2e8f0 !important;
        color:#334155 !important;
        }
        .txn-btn-ghost:hover{
        background:#f8fafc !important;
        }

        /* Update */
        .txn-btn-primary{
            color: white;
            background: #ff0071 !important;
        }
    </style>

@endsection

@section('page')

<div class="tbg-white trounded-xl tshadow-lg ttext-black-100 txn-card">

    <!-- Header -->
    <div class="txn-header">
        <div>
            <h2 class="txn-title">Transaction</h2>
            <p class="txn-sub">
                Update chemical cost & weight (auto-calculates price per unit).
            </p>
        </div>
    </div>

    <!-- Body -->
    <form action="{{ route('lab.patch', $ingredient->id) }}"
          method="POST"
          class="txn-body">
        @csrf

        <div class="txn-grid">

            <!-- Name -->
            <div class="txn-field txn-span-12">
                <label class="txn-label">
                    Name <span>(Chemical Name)</span>
                </label>
                <input type="text"
                       name="name"
                       value="{{ $ingredient->name }}"
                       class="txn-input browser-default">
            </div>

            <!-- Price -->
            <div class="txn-field txn-span-4">
                <label class="txn-label">
                    Price <span>(Cost of goods)</span>
                </label>
                <input type="text"
                       name="price"
                       id="price"
                       value="{{ $ingredient->price }}"
                       class="txn-input price browser-default">
            </div>

            <!-- Weight -->
            <div class="txn-field txn-span-4">
                <label class="txn-label">
                    Weight <span>(grams)</span>
                </label>
                <input type="text"
                       name="weight"
                       id="weight"
                       value="{{ $ingredient->weight }}"
                       class="txn-input weight browser-default">
            </div>

            <!-- Price / Unit -->
            <div class="txn-field txn-span-4">
                <label class="txn-label">
                    Price / Unit <span>(auto)</span>
                </label>
                <div class="txn-rel">
                    <input type="text"
                           name="price_per_grams"
                           value="{{ $ingredient->price_per_grams }}"
                           class="txn-input txn-readonly price_per_grams browser-default"
                           id="price_per_grams"
                           readonly>
                    <span class="txn-badge">auto</span>
                </div>
            </div>

            <!-- Note -->
            <div class="txn-field txn-span-12">
                <label class="txn-label">
                    Note <span>(optional)</span>
                </label>
                <textarea name="note"
                          rows="2"
                          class="txn-textarea browser-default">{{ $ingredient->note }}</textarea>
            </div>

        </div>

        <!-- Actions -->
        <div class="txn-actions">
            <a href="/admin/lab"
               class="txn-btn txn-btn-ghost">
                <i class="fas fa-times"></i> Cancel
            </a>

            <button type="submit"
                    class="txn-btn txn-btn-primary">
                <i class="fas fa-save"></i> Update
            </button>
        </div>
    </form>

</div>



@endsection

@section('js')
    <script>
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }// numberWithCommas


         function pricePerUnit() {
            let price = parseFloat($('#price').val()) || 0;
            let weight = parseFloat($('#weight').val()) || 0;
            let price_per_grams = 0;

            price_per_grams = price/weight;
            price_per_grams = price_per_grams.toFixed(2); // round to 2 decimal places

            $('#price_per_grams').val(price_per_grams);
        }
        
        $('#price').keyup(function () {
            pricePerUnit();
        })

        $('#weight').keyup(function () {
            pricePerUnit();
        })

    </script>
@endsection