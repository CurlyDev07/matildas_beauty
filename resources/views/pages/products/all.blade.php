@extends('layouts.app')

@section('content')
    <div class="tmx-0 tpx-0 md:tmx-10 md:tpx-8 tpb-5">
        <div class="tflex tjustify-between titems-center sm:tpt-5">
            <div class="thidden xl:tblock tw-1/5 ttext-2xl ttext-title tfont-medium">Products</div>
            <div class="tw-full sm:tmx-1 xl:tw-4/5 tflex titems-center tjustify-between sm:tjustify-center tbg-white tpx-5 tpy-2 sm:tpy-3 trounded">

                <span class="thidden sm:tblock tmr-3 ttext-gray-600 ttext-sm">Sort by</span>

                <a href="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" 
                    class="thidden sm:tblock  tborder tborder-gray-300 tcursor-pointer waves-effect tmr-3 tpx-5 tpy-2 trounded ttext-sm
                    @if (request()->sort == 'latest')
                        tbg-primary ttext-white
                    @endif
                ">Latest</a>

                <a href="{{ request()->fullUrlWithQuery(['sort' => 'sales']) }}" 
                    class="tborder tborder-gray-300 tcursor-pointer waves-effect tmr-3 tpx-5 tpy-2 trounded ttext-sm
                    @if (request()->sort == 'sales')
                        tbg-primary ttext-white
                    @endif
                ">Top Sales</a>

                <a href="{{ request()->fullUrlWithQuery(['price' => 'desc']) }}" 
                    class="tborder tborder-gray-300 tcursor-pointer waves-effect tmr-3 tpx-5 tpy-2 trounded ttext-sm
                    @if (request()->price == 'desc')
                        tbg-primary ttext-white
                    @endif
                ">Price: High</a>

                <a href="{{ request()->fullUrlWithQuery(['price' => 'asc']) }}" 
                    class="tborder tborder-gray-300 tcursor-pointer waves-effect sm:tmr-auto tpx-5 tpy-2 trounded ttext-sm
                    @if (request()->price == 'asc')
                        tbg-primary ttext-white
                    @endif
                ">Price: Low</a>
                
                <div class="thidden sm:tflex titems-center">
                    <span class="ttext-sm ttracking-widest tmr-5 tml-auto">
                        <span class="ttext-primary">{{ $products->currentPage() }}</span>/{{ $products->lastPage() }}
                    </span>

                    <a href="{{ $products->previousPageUrl() }}" 
                        class="
                        @if ($products->onFirstPage())
                            tbg-gray-200 tpointer-events-none
                        @endif
                        material-icons tcursor-default waves-effect tborder tborder-gray-200 tborder-gray-300 tborder-r-0 tpx-1 tpy-1 trounded-br-sm trounded-tr-sm ttext-gray-700">chevron_left</a href="">
                    <a href="{{ $products->nextPageUrl() }}" 
                        class="
                        @if (!$products->hasMorePages())
                            tbg-gray-200 tpointer-events-none
                        @endif
                        material-icons tcursor-pointer waves-effect tborder tborder-gray-300 tpx-1 tpy-1 trounded-br-sm trounded-tr-sm ttext-gray-700">chevron_right</a href="">
                </div>
            </div>
        </div>

        <div class="tflex tjustify-center">
            <div class="thidden xl:tblock xl:tw-1/5">
                <div class="tmr-5 tsticky ttop-0">
                    <div class="tflex titems-center titems-center tmb-5">
                        <svg class="shopee-svg-icon " enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0" style="font-size: 14px;margin-right: .625rem;stroke: currentColor; height: 14px;"><g><polyline fill="none" points="5.5 13.2 5.5 5.8 1.5 1.2 13.5 1.2 9.5 5.8 9.5 10.2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"></polyline></g></svg>
                        <span class="ttext-title tfont-medium">SEARCH FILTER</span>
                    </div>

                    <div class="titems-center tpb-5">
                        <p class="tmb-3 ttext-base ttext-title tfont-medium">Price Range</p>
                        <form method="GET">
                            <div class="tflex titems-center tjustify-between">
                                <input value="{{request()->min}}" name="min" type="number" placeholder="{{ currency() }} MIN" class="browser-default focus:toutline-none tborder tborder-gray-400 tleading-5 tpx-2 tpy-1 trounded ttext-sm tw-20">
                                <span class="tleading-5 ttext-sm">to</span>
                                <input value="{{request()->max}}" name="max" type="number" placeholder="{{ currency() }} MAX" class="browser-default focus:toutline-none tborder tborder-gray-400 tleading-5 tpx-2 tpy-1 trounded ttext-sm tw-20">
                            </div>
                            <button type="submit" class="focus:tbg-primary focus:toutline-none tbg-primary tmt-5 tpy-1 trounded ttext-sm ttext-white tw-full waves-effect waves-light">APPLY</button>
                        </form>
                    </div>
                </div>
            </div><!-- Left Filter -->

            <div class="tw-full xl:tw-4/5 tpt-5 t-mx-2 tflex tflex-wrap">
                @foreach ($products as $product)
                
                    <div class="product tpx-1 tw-1/2 sm:tw-1/3 lg:tw-1/4 tmb-8">
                        <div class="product-hover hover:tshadow-xl tbg-white tshadow-md trounded-lg toverflow-hidden">
                            <div class="tpx-4 tpy-2"  style="min-height: 60.75px;">
                                <a href="{{ item_show_slug($product['title'], $product['id']) }}" style="font-size: 14px; height: 43px;" class="hover:ttext-primary hover:tunderline product-title tfont-medium tmt-1 truncate ttext-sm">
                                    {{ $product['title'] }}
                                </a>
                            </div>
                            <div class="toverflow-hidden tcursor-pointer" onclick="item_show('{{ item_show_slug($product['title'], $product['id']) }}')">
                                <img class="product-image th-40 md:th-56 tw-full tobject-cover tmt-2" src="{{ asset($product['images'][0]['img']) }}" alt="NIKE AIR">
                            </div>
                            <div 
                                class="tcursor-pointer tflex titems-center tjustify-between tpx-4 tbg-primary">
                                <h1 class="ttext-gray-200 tfont-medium ttext-xl"><span class="ttext-md tfont-normal">{{ currency() }}</span> {{ number_format($product['price'],2) }}</h1>
                                <span data-id="{{$product['id']}}" class="add_to_cart  fa-cart-plus fas tcursor-pointer tp-2 trounded-full ttext-white waves-effect waves-light" style="font-size: 21px;"></span>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="product-hover tw-1/4 tpx-2 tmb-4" onclick="item_show('{{ item_show_slug($product['title'], $product['id']) }}')">
                        <div class=" tbg-white trounded">
                            <img src="{{ $product['images'][0]['img'] }}" style="margin: 0 auto;height: 232px;" alt="">
                            <div class="tpx-3 tpy-2 tcursor-pointer">
                                <div class="tmt-1 ttext-gray-800 ttext-sm truncate tcursor-pointer">
                                    {{ $product['title'] }}
                                </div>
                                <div class="tflex titems-center tmt-1 tcursor-pointer">
                                    <div class="tfont-medium ttext-primary ttext-lg">
                                        {{ currency() }}{{ number_format($product['price']) }}
                                    </div>
                                    <strike class="ttext-gray-500 ttext-sm tml-2">
                                        {{ $product['compare_price'] != '' ? '{{ currency() }}'.number_format($product['compare_price']) : '' }}
                                    </strike>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                @endforeach
            </div><!-- Right Products -->
        </div>

        @if ($products->hasMorePages())
            <div class="tbg-white tflex tjustify-end tpb-1 tpt-5">
                {{ $products->onEachSide(1)->appends(request()->except('page'))->links() }}
            </div>
        @endif
        

    </div>


@endsection

@section('js')

    <script src="{{ asset('js/plugins/sweatalert.js') }}"></script>

    @include('plugins.fb_messenger')
@endsection