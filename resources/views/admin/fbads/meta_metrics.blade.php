@extends('admin.fbads.layouts')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    
    <style>
        /* Custom pink theme for Flatpickr */
        .flatpickr-calendar {
            font-family: inherit;
        }
        .flatpickr-day.selected,
        .flatpickr-day.startRange,
        .flatpickr-day.endRange,
        .flatpickr-day.selected:hover,
        .flatpickr-day.startRange:hover,
        .flatpickr-day.endRange:hover {
            background-color: #f02074;
            border-color: #f02074;
            color: #fff;
        }
        .flatpickr-day.inRange {
            background-color: #fbd1df;
            color: #000;
        }
        .flatpickr-day.today {
            border-color: #f02074;
        }
        .flatpickr-months .flatpickr-month {
            color: #f02074;
        }
        .flatpickr-months .flatpickr-next-month,
        .flatpickr-months .flatpickr-prev-month {
            color: #f02074;
        }
        .flatpickr-weekdays {
            color: #f02074;
            font-weight: 500;
        }
    </style>

    <style>
        .tdropzone {
            @apply tbg-blue-100 tborder-blue-500;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

@endsection

@section('page')

    <div class="tbg-white tmx-auto tshadow-2xl tw-full">

        @if(session('success'))
            <div class="tbg-green-100 ttext-green-700 tp-4 trounded tmb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('skipped') && count(session('skipped')))
            <div class="tbg-yellow-100 ttext-yellow-800 tp-4 trounded tmb-4">
                <strong>Skipped duplicates:</strong>
                <ul class="ttext-sm">
                    @foreach(session('skipped') as $ad)
                        <li>- {{ $ad }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('fbads.meta_metrics.post') }}" method="POST" enctype="multipart/form-data"
            class="tborder tborder-dashed tborder-gray-400 trounded tpx-6 tpy-10 ttext-center"
            ondragover="this.classList.add('tdropzone');" 
            ondragleave="this.classList.remove('tdropzone');">
            @csrf

            <label for="excel_file" class="tcursor-pointer tblock ttext-gray-600">
                <span class="ttext-xl tfont-semibold">📤 Drop your Ad Data Excel here</span><br>
                <span class="ttext-sm">or click to browse</span>
            </label>
            <input type="file" name="excel_file" id="excel_file" class="thidden" accept=".xlsx,.xls" onchange="this.form.submit()">

            @error('excel_file')
                <div class="ttext-red-500 tmt-2">{{ $message }}</div>
            @enderror
        </form>
    </div> {{-- UPLOAD --}}



@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
   

@endsection
