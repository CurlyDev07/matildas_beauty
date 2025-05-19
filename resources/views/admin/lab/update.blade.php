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

@endsection

@section('page')

    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-5">
        <div class="text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
            Transaction
        </div>

        <form action="{{ route('lab.patch', $ingredient->id) }}" method="POST" class="tflex tpx-5 tmt-5 tflex-wrap">
            @csrf

            <div class="tw-full tmr-2">
                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100"> Name <small class="ttext-gray-600">(Chemical Name)</small></label>
                <input type="text" name="name" id="name" class="name tcursor-pointer browser-default form-control" value="{{ ($ingredient->name) }}"> 
            </div><!-- Name -->
            <div class="tw-1/4 tmr-2">
                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100"> Price <small class="ttext-gray-600">(Price / Cost of good)</small></label>
                <input type="text" name="price" id="price" class="price tcursor-pointer browser-default form-control" value="{{ ($ingredient->price) }}"> 
            </div><!-- Price -->
            <div class="tw-1/4 tmr-2">
                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100"> Weight <small class="ttext-gray-600">(Weight of Chemical)</small></label>
                <input type="text" name="weight" id="weight" class="weight tcursor-pointer browser-default form-control" value="{{ ($ingredient->weight) }}"> 
            </div><!-- Weight -->
            <div class="tw-1/4 tmr-2">
                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100"> Price/Unit <small class="ttext-gray-600">(Calculated price per unit)</small></label>
                <input type="text" name="price_per_grams"  id="price_per_grams" class="price_per_grams tcursor-not-allowed tcursor-pointer browser-default form-control" style="background-color: #eaeaea;" value="{{ ($ingredient->price_per_grams) }}"> 
            </div><!-- price_per_grams -->
            
            <div class="tw-2/5 tmr-2">
                <label for="note" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Note</label>
                <textarea name="note" id="note" cols="30" rows="3" class="browser-default form-control" style="padding: 6px;">{{ ($ingredient->note) }}</textarea>
            </div><!-- Transaction Fee -->

             <div class="tpy-5 trounded-lg ttext-right tw-full">
                <button type="submit" class="focus:tbg-primary tbg-primary tml-auto tpy-2 trounded ttext-white tw-24 waves-effect" id="submit_btn">Update</button>
            </div><!-- Save -->

        </form>
    </div><!-- Transaction -->


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