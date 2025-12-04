@extends('admin.layouts.app')

@section('content')
<div class="tcontainer tmx-auto tpx-4 tpy-6">
    <div class="tmax-w-5xl tmx-auto tbg-white tshadow-sm trounded-lg tpx-6 tpt-5 tpb-6">
        <div class="tflex tjustify-between titems-center tmb-5 tborder-b tborder-gray-200 tpb-3">
            <h2 class="ttext-lg tfont-bold ttext-gray-800">Edit Product</h2>
            <a href="{{ route('fb-ads.index') }}" class="ttext-gray-500 ttext-sm thover:text-gray-700 tfont-medium">Cancel</a>
        </div>
        
        <form action="{{ route('fb-ads.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="tgrid tgrid-cols-1 md:tgrid-cols-4 tgap-4 tmb-4">
                <div class="tcol-span-1">
                    <label class="tblock ttext-gray-700 ttext-xs tfont-bold tmb-1">SKU <span class="ttext-red-500">*</span></label>
                    <input type="text" name="sku" value="{{ $product->sku }}" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3" required>
                </div>
                <div class="tcol-span-1 md:tcol-span-2">
                    <label class="tblock ttext-gray-700 ttext-xs tfont-bold tmb-1">Product Name <span class="ttext-red-500">*</span></label>
                    <input type="text" name="product_name" value="{{ $product->product_name }}" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3" required>
                </div>
                <div class="tcol-span-1">
                    <label class="tblock ttext-gray-700 ttext-xs tfont-bold tmb-1">Price <span class="ttext-red-500">*</span></label>
                    <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3" required>
                </div>
            </div>

             <div class="tgrid tgrid-cols-1 md:tgrid-cols-4 tgap-4 tmb-4">
                 <div class="tcol-span-1">
                    <label class="tblock ttext-gray-700 ttext-xs tfont-bold tmb-1">Slashed Price</label>
                    <input type="number" step="0.01" name="slashed_price" value="{{ $product->slashed_price }}" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3">
                </div>
                 <div class="tcol-span-1">
                    <label class="tblock ttext-gray-700 ttext-xs tfont-bold tmb-1">Discount Tag</label>
                    <input type="text" name="discount_tag" value="{{ $product->discount_tag }}" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3">
                </div>
                <div class="tcol-span-1">
                    <label class="tblock ttext-gray-700 ttext-xs tfont-bold tmb-1">Scarcity Text</label>
                    <input type="text" name="scarcity_text" value="{{ $product->scarcity_text }}" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3">
                </div>
                 <div class="tcol-span-1 md:tcol-span-4">
                    <label class="tblock ttext-gray-700 ttext-xs tfont-bold tmb-1">Description</label>
                    <textarea name="description" rows="2" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3">{{ $product->description }}</textarea>
                </div>
            </div>

            <div class="tmb-4">
                <label class="tblock ttext-gray-700 ttext-xs tfont-bold tmb-1">Promo Bullets</label>
                <div class="tgrid tgrid-cols-1 md:tgrid-cols-3 tgap-3">
                    <input type="text" name="promo_line1" value="{{ $product->promo_line1 }}" placeholder="Bullet 1" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3">
                    <input type="text" name="promo_line2" value="{{ $product->promo_line2 }}" placeholder="Bullet 2" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3">
                    <input type="text" name="promo_line3" value="{{ $product->promo_line3 }}" placeholder="Bullet 3" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3">
                </div>
            </div>

            <div class="tmb-2 tborder-t tborder-gray-100 tpt-3">
                <label class="tblock ttext-gray-700 ttext-xs tfont-bold tmb-2">Image Links (URLs)</label>
                <div class="tgrid tgrid-cols-2 md:tgrid-cols-5 tgap-3">
                    @for($i=1; $i<=5; $i++)
                        @php $imgField = 'image'.$i; @endphp
                        <div>
                            <label class="tblock ttext-gray-500 ttext-xs tmb-1 tfont-medium">Image {{ $i }}</label>
                            <div class="tflex trounded-md tshadow-sm">
                                <input type="text" name="image{{ $i }}" value="{{ $product->$imgField }}" class="focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-xs tborder-gray-300 trounded-l-md tpy-1.5 tpx-2 ttruncate">
                                @if($product->$imgField)
                                    <a href="{{ $product->$imgField }}" target="_blank" class="tinline-flex titems-center tpx-2 trounded-r-md tborder tborder-l-0 tborder-gray-300 tbg-gray-50 ttext-gray-500 thover:bg-gray-100" title="Open image in new tab">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="th-4 tw-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                @else
                                    <span class="tinline-flex titems-center tpx-2 trounded-r-md tborder tborder-l-0 tborder-gray-300 tbg-gray-50 ttext-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="th-4 tw-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="tflex titems-center tjustify-end tmt-5 tborder-t tborder-gray-200 tpt-4">
                <button type="submit" class="tbg-blue-600 thover:bg-blue-700 ttext-white ttext-sm tfont-bold tpy-2 tpx-6 trounded-md focus:toutline-none focus:tring-2 focus:tring-offset-2 focus:tring-blue-500">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection