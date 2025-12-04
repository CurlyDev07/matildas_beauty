@extends('admin.layouts.app')

@section('content')
<div class="tcontainer tmx-auto tpx-4 tpy-6">
    <div class="tmax-w-5xl tmx-auto tbg-white tshadow-sm trounded-lg tpx-6 tpt-5 tpb-6">
        <div class="tflex tjustify-between titems-center tmb-5 tborder-b tborder-gray-200 tpb-3">
            <h2 class="ttext-lg tfont-bold ttext-gray-800">Create Product</h2>
            <a href="{{ route('fb-ads.index') }}" class="ttext-gray-500 ttext-sm thover:text-gray-700 tfont-medium">Cancel</a>
        </div>
        
        <form action="{{ route('fb-ads.store') }}" method="POST">
            @csrf
            
            <div class="tgrid tgrid-cols-1 md:tgrid-cols-4 tgap-4 tmb-4">
                <div class="tcol-span-1">
                    <label class="tblock ttext-gray-700 ttext-xs tfont-bold tmb-1">SKU <span class="ttext-red-500">*</span></label>
                    <input type="text" name="sku" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3" required>
                </div>
                <div class="tcol-span-1 md:tcol-span-2">
                    <label class="tblock ttext-gray-700 ttext-xs tfont-bold tmb-1">Product Name <span class="ttext-red-500">*</span></label>
                    <input type="text" name="product_name" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3" required>
                </div>
                <div class="tcol-span-1">
                    <label class="tblock ttext-gray-700 ttext-xs tfont-bold tmb-1">Price <span class="ttext-red-500">*</span></label>
                    <input type="number" step="0.01" name="price" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3" required>
                </div>
            </div>

            <div class="tgrid tgrid-cols-1 md:tgrid-cols-4 tgap-4 tmb-4">
                 <div class="tcol-span-1">
                    <label class="tblock ttext-gray-700 ttext-xs tfont-bold tmb-1">Slashed Price</label>
                    <input type="number" step="0.01" name="slashed_price" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3">
                </div>
                 <div class="tcol-span-1">
                    <label class="tblock ttext-gray-700 ttext-xs tfont-bold tmb-1">Discount Tag</label>
                    <input type="text" name="discount_tag" placeholder="e.g. 50% OFF" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3">
                </div>
                <div class="tcol-span-1">
                    <label class="tblock ttext-gray-700 ttext-xs tfont-bold tmb-1">Scarcity Text</label>
                    <input type="text" name="scarcity_text" placeholder="e.g. Only 3 Left!" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3">
                </div>
                 <div class="tcol-span-1 md:tcol-span-4">
                    <label class="tblock ttext-gray-700 ttext-xs tfont-bold tmb-1">Description</label>
                    <textarea name="description" rows="2" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3"></textarea>
                </div>
            </div>

            <div class="tmb-4">
                <label class="tblock ttext-gray-700 ttext-xs tfont-bold tmb-1">Promo Bullets</label>
                <div class="tgrid tgrid-cols-1 md:tgrid-cols-3 tgap-3">
                    <input type="text" name="promo_line1" placeholder="Bullet point 1" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3">
                    <input type="text" name="promo_line2" placeholder="Bullet point 2" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3">
                    <input type="text" name="promo_line3" placeholder="Bullet point 3" class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-sm tborder-gray-300 trounded-md tpy-1.5 tpx-3">
                </div>
            </div>

            <div class="tmb-2 tborder-t tborder-gray-100 tpt-3">
                <label class="tblock ttext-gray-700 ttext-xs tfont-bold tmb-2">Image Links (URLs)</label>
                <div class="tgrid tgrid-cols-2 md:tgrid-cols-5 tgap-3">
                    @for($i=1; $i<=5; $i++)
                        <div>
                            <label class="tblock ttext-gray-500 ttext-xs tmb-1 tfont-medium">Image {{ $i }}</label>
                            <input type="text" name="image{{ $i }}" placeholder="https://..." class="tshadow-sm focus:tring-blue-500 focus:tborder-blue-500 tblock tw-full ttext-xs tborder-gray-300 trounded-md tpy-1.5 tpx-2 ttruncate">
                        </div>
                    @endfor
                </div>
            </div>

            <div class="tflex titems-center tjustify-end tmt-5 tborder-t tborder-gray-200 tpt-4">
                <button type="submit" class="tbg-blue-600 thover:bg-blue-700 ttext-white ttext-sm tfont-bold tpy-2 tpx-6 trounded-md focus:toutline-none focus:tring-2 focus:tring-offset-2 focus:tring-blue-500">
                    Create Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection