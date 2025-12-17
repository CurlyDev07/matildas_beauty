@extends('admin.layouts.app')

@section('content')
<div class="tcontainer tmx-auto tpx-4 tpy-8">
    <div class="tflex tjustify-between titems-center tmb-8">
        <div>
            <h1 class="ttext-3xl tfont-bold ttext-gray-900">FB Ads Products</h1>
            <p class="ttext-gray-600 tmt-1">Manage your Facebook advertising products</p>
        </div>
        <a href="{{ route('fb-ads.create') }}" class="tbg-blue-600 ttext-white tpx-6 tpy-3 trounded-lg thover:bg-blue-700 tflex titems-center tgap-2 tshadow-sm ttransition-all thover:shadow-md">
            <svg class="tw-8 th-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Add New Product
        </a>
    </div>

    @if(session('success'))
        <div class="tbg-green-50 tborder-l-4 tborder-green-500 ttext-green-800 tpx-6 tpy-4 trounded-r-lg tmb-6 tflex titems-center tgap-3 tshadow-sm">
            <svg class="tw-8 th-8 ttext-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="tfont-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="tbg-white tshadow-lg trounded-xl toverflow-hidden tborder tborder-gray-100">
        <table class="tmin-w-full">
            <thead class="tbg-gradient-to-r tfrom-gray-50 tto-gray-100">
                <tr>
                    <th class="tpx-6 tpy-4 ttext-left ttext-xs tfont-bold ttext-gray-700 tuppercase ttracking-wider">Image</th>
                    <th class="tpx-6 tpy-4 ttext-left ttext-xs tfont-bold ttext-gray-700 tuppercase ttracking-wider">SKU</th>
                    <th class="tpx-6 tpy-4 ttext-left ttext-xs tfont-bold ttext-gray-700 tuppercase ttracking-wider">Product Name</th>
                    <th class="tpx-6 tpy-4 ttext-left ttext-xs tfont-bold ttext-gray-700 tuppercase ttracking-wider">Price</th>
                    <th class="tpx-6 tpy-4 ttext-center ttext-xs tfont-bold ttext-gray-700 tuppercase ttracking-wider">Order</th>
                    <th class="tpx-6 tpy-4 ttext-center ttext-xs tfont-bold ttext-gray-700 tuppercase ttracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="tdivide-y tdivide-gray-100">
                @foreach($products as $product)
                <tr class="thover:bg-gray-50 ttransition-colors">
                    <td class="tpx-6 tpy-4">
                        @if($product->image1)
                            <div class="tw-16 th-16 trounded-lg toverflow-hidden tshadow-sm tborder-2 tborder-gray-100">
                                <img src="{{ $product->image1 }}" alt="{{ $product->product_name }}" class="tw-full th-full tobject-cover">
                            </div>
                        @else
                            <div class="tw-16 th-16 trounded-lg tbg-gray-100 tflex titems-center tjustify-center">
                                <svg class="tw-8 th-8 ttext-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </td>
                    <td class="tpx-6 tpy-4">
                        <span class="ttext-sm tfont-mono ttext-gray-700 tbg-gray-100 tpx-2 tpy-1 trounded">{{ $product->sku }}</span>
                    </td>
                    <td class="tpx-6 tpy-4">
                        <span class="ttext-sm tfont-medium ttext-gray-900">{{ $product->product_name }}</span>
                    </td>
                    <td class="tpx-6 tpy-4">
                        <div class="tflex titems-center tgap-2">
                            <span class="ttext-lg tfont-bold ttext-gray-900">₱{{ number_format($product->price, 2) }}</span>
                            @if($product->slashed_price)
                                <span class="tline-through ttext-gray-400 ttext-sm">₱{{ number_format($product->slashed_price, 2) }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="tpx-6 tpy-4">
                        <div class="tflex tflex-col titems-center tgap-2">
                            <form action="{{ route('fb-ads.update-order', $product->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="direction" value="up">
                                <button type="submit" class="ttext-gray-400 thover:text-blue-600 thover:bg-blue-50 tp-1 trounded ttransition-all disabled:opacity-20 disabled:cursor-not-allowed" {{ $loop->first ? 'disabled' : '' }}>
                                    <svg class="tw-8 th-8" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </form>
                            <div class="tbg-gray-100 tpx-3 tpy-1 trounded-full">
                                <span class="ttext-xs tfont-bold ttext-gray-700">{{ $product->order }}</span>
                            </div>
                            <form action="{{ route('fb-ads.update-order', $product->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="direction" value="down">
                                <button type="submit" class="ttext-gray-400 thover:text-blue-600 thover:bg-blue-50 tp-1 trounded ttransition-all disabled:opacity-20 disabled:cursor-not-allowed" {{ $loop->last ? 'disabled' : '' }}>
                                    <svg class="tw-8 th-8" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                    <td class="tpx-6 tpy-4">
                        <div class="tflex titems-center tjustify-center tgap-3">
                            <a href="{{ route('fb-ads.edit', $product->id) }}" class="ttext-blue-600 thover:text-blue-800 tfont-medium ttext-sm tflex titems-center tgap-1 thover:bg-blue-50 tpx-3 tpy-1.5 trounded ttransition-all">
                                <svg class="tw-4 th-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('fb-ads.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ttext-red-600 thover:text-red-800 tfont-medium ttext-sm tflex titems-center tgap-1 thover:bg-red-50 tpx-3 tpy-1.5 trounded ttransition-all">
                                    <svg class="tw-4 th-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($products->isEmpty())
        <div class="tpy-16 ttext-center">
            <svg class="tmx-auto th-16 tw-16 ttext-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
            </svg>
            <h3 class="tmt-4 ttext-lg tfont-medium ttext-gray-900">No products yet</h3>
            <p class="tmt-2 ttext-gray-600">Get started by adding your first product.</p>
            <a href="{{ route('fb-ads.create') }}" class="tmt-6 tinline-flex titems-center tgap-2 tbg-blue-600 ttext-white tpx-6 tpy-3 trounded-lg thover:bg-blue-700 ttransition-all">
                <svg class="tw-8 th-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add Product
            </a>
        </div>
        @endif
    </div>
</div>
@endsection