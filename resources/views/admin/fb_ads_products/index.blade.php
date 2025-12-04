@extends('admin.layouts.app')

@section('content')
<div class="tcontainer tmx-auto tpx-4 tpy-8">
    <div class="tflex tjustify-between titems-center tmb-6">
        <h1 class="ttext-2xl tfont-bold ttext-gray-800">FB Ads Products</h1>
        <a href="{{ route('fb-ads.create') }}" class="tbg-blue-600 ttext-white tpx-4 tpy-2 trounded thover:bg-blue-700">
            Add New Product
        </a>
    </div>

    @if(session('success'))
        <div class="tbg-green-100 tborder tborder-green-400 ttext-green-700 tpx-4 tpy-3 trounded tmb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="tbg-white tshadow-md trounded t-overflow-hidden">
        <table class="tmin-w-full tleading-normal">
            <thead>
                <tr>
                    <th class="tpx-5 tpy-3 tborder-b-2 tborder-gray-200 tbg-gray-100 ttext-left ttext-xs tfont-semibold ttext-gray-600 tuppercase ttracking-wider">Image</th>
                    <th class="tpx-5 tpy-3 tborder-b-2 tborder-gray-200 tbg-gray-100 ttext-left ttext-xs tfont-semibold ttext-gray-600 tuppercase ttracking-wider">SKU</th>
                    <th class="tpx-5 tpy-3 tborder-b-2 tborder-gray-200 tbg-gray-100 ttext-left ttext-xs tfont-semibold ttext-gray-600 tuppercase ttracking-wider">Name</th>
                    <th class="tpx-5 tpy-3 tborder-b-2 tborder-gray-200 tbg-gray-100 ttext-left ttext-xs tfont-semibold ttext-gray-600 tuppercase ttracking-wider">Price</th>
                    <th class="tpx-5 tpy-3 tborder-b-2 tborder-gray-200 tbg-gray-100 ttext-left ttext-xs tfont-semibold ttext-gray-600 tuppercase ttracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td class="tpx-5 tpy-5 tborder-b tborder-gray-200 tbg-white ttext-sm">
                        @if($product->image1)
                            <img src="{{ $product->image1 }}" alt="Img" class="tw-10 th-10 trounded-full tobject-cover">
                        @else
                            <span class="ttext-gray-400">No Img</span>
                        @endif
                    </td>
                    <td class="tpx-5 tpy-5 tborder-b tborder-gray-200 tbg-white ttext-sm">{{ $product->sku }}</td>
                    <td class="tpx-5 tpy-5 tborder-b tborder-gray-200 tbg-white ttext-sm">{{ $product->product_name }}</td>
                    <td class="tpx-5 tpy-5 tborder-b tborder-gray-200 tbg-white ttext-sm">
                        {{ number_format($product->price, 2) }}
                        @if($product->slashed_price)
                            <span class="tline-through ttext-gray-500 ttext-xs tml-1">{{ number_format($product->slashed_price, 2) }}</span>
                        @endif
                    </td>
                    <td class="tpx-5 tpy-5 tborder-b tborder-gray-200 tbg-white ttext-sm">
                        <a href="{{ route('fb-ads.edit', $product->id) }}" class="ttext-blue-600 thover:text-blue-900 tmr-3">Edit</a>
                        <form action="{{ route('fb-ads.destroy', $product->id) }}" method="POST" class="tinline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ttext-red-600 thover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="tpx-5 tpy-5 tbg-white tborder-t tflex tflex-col txs:flex-row titems-center txs:justify-between">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection