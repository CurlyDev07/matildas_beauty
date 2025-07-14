@extends('admin.fbads.layouts')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        .tdropzone {
            @apply tbg-blue-100 tborder-blue-500;
        }
    </style>
@endsection

@section('page')

<div class="tw-full tmx-auto">
    @if(session('success'))
        <div class="tbg-green-100 ttext-green-700 tp-4 trounded tmb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('duplicates'))
        <div class="tbg-yellow-100 ttext-yellow-800 tp-4 trounded tmt-4">
            <strong>Skipped duplicates:</strong>
            <ul class="ttext-sm tmt-2">
                @foreach(session('duplicates') as $dup)
                    <li>- {{ $dup }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    @if($errors->any())
        <div class="tbg-red-100 ttext-red-700 tp-4 trounded tmb-4">
            <ul class="tlist-disc tml-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="uploadForm" action="{{ route('fbads.meta_metrics.post') }}" method="POST" enctype="multipart/form-data" class="tbg-white tborder tborder-dashed tborder-gray-300 trounded tpx-6 tpy-10 ttext-center">
        @csrf

        <label for="excel_file" class="tcursor-pointer tblock ttext-gray-500">
            <span class="ttext-lg tfont-semibold">📤 Drop your Facebook Ads Excel file here</span><br>
            <span class="ttext-sm">or click to select</span>
        </label>

        <input type="file" name="excel_file" id="excel_file" class="thidden" accept=".xlsx,.xls">

        <div id="previewContainer" class="thidden tmt-6 ttext-left">
            <h2 class="ttext-lg tfont-bold tmb-2">📊 File Preview</h2>
            <div class="toverflow-auto tbg-gray-50 trounded tshadow ttext-sm">
                <table id="previewTable" class="tmin-w-full ttext-left tborder-collapse"></table>
            </div>
            <div class="tmt-4">
                <button type="submit" class="tbg-blue-600 thover:bg-blue-700 ttext-white tfocus:outline-none tfont-semibold trounded tpy-2 tpx-4">Import to Database</button>
            </div>
        </div>

        <div id="progressBarContainer" class="thidden tmt-4">
            <div class="tbg-gray-200 trounded">
                <div id="progressBar" class="tbg-blue-500 ttext-white ttext-xs tpy-1 trounded ttext-center" style="width: 0%">0%</div>
            </div>
        </div>
    </form>
</div>
@endsection




@section('js')

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        const fileInput = document.getElementById('excel_file');
        const previewTable = document.getElementById('previewTable');
        const previewContainer = document.getElementById('previewContainer');
        const progressBarContainer = document.getElementById('progressBarContainer');
        const progressBar = document.getElementById('progressBar');

        fileInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, { type: 'array' });
                const sheet = workbook.Sheets[workbook.SheetNames[0]];
                const json = XLSX.utils.sheet_to_json(sheet, { header: 1 });

                if (json.length > 0) {
                    previewTable.innerHTML = '';
                    const limit = 10;
                    json.slice(0, limit).forEach((row, i) => {
                        const tr = document.createElement('tr');
                        row.forEach(cell => {
                            const td = document.createElement(i === 0 ? 'th' : 'td');
                            td.className = 'tborder tpx-2 tpy-1';
                            td.textContent = cell;
                            tr.appendChild(td);
                        });
                        previewTable.appendChild(tr);
                    });

                    previewContainer.classList.remove('thidden');
                }
            };
            reader.readAsArrayBuffer(file);
        });

        document.getElementById('uploadForm').addEventListener('submit', function () {
            progressBarContainer.classList.remove('thidden');
            let width = 0;
            const interval = setInterval(() => {
                if (width >= 98) {
                    clearInterval(interval);
                    return;
                }
                width += 1;
                progressBar.style.width = width + '%';
                progressBar.textContent = width + '%';
            }, 100);
        });
    </script>
@endsection
