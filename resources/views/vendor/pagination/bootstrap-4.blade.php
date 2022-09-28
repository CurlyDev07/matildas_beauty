@if ($paginator->hasPages())
<div class="tflex tjustify-between titems-center tmb-4 tpx-5">
    <div>
        <span class="ttext-gray-600 tmr-4 ttext-sm">
            Page 
            <span class="ttext-primary tfont-medium">{{ $paginator->currentPage() }}</span>
            /
            {{ $paginator->lastPage() }}
            of
            {{ $paginator->total() }} 
            items
        </span>
    </div>
    <ul class="tflex tjustify-end">
        {{-- Previous Page Link --}}
        
        @if ($paginator->onFirstPage())
            <li class="tmr-2">
                <span class="tbg-gray-100 tcursor-not-allowed tcursor-pointer trounded-full tshadow-md ttext-blue-300 tz-50" style="padding: 6px 12px;">
                    <i class="fas fa-chevron-left"></i>
                </span>
            </li>{{-- Disabled --}}
        @else
            <li class="tmr-2">
                <a class="tbg-white trounded-full tshadow-md ttext-blue-500 tz-50 tcursor-pointer hover:tbg-blue-500 hover:ttext-white" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" style="padding: 6px 12px;">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
        @endif
     
       

        {{-- Array Of Links --}}
        {{-- @for ($i = 1; $i < 9; $i++)
            @if ($i == 3)
                <li class="tmr-2">
                    <span class="tbg-blue-500 trounded-full ttext-white tz-50 tcursor-pointer hover:tbg-blue-500 hover:ttext-white" style="padding: 6px 12px;">{{ $i }}</span>
                </li>
            @else
                <li class="tmr-2">
                    <span class="tbg-white trounded-full tshadow-md ttext-blue-500 tz-50 tcursor-pointer hover:tbg-blue-500 hover:ttext-white" style="padding: 6px 12px;">{{ $i }}</span>
                </li>
            @endif
        @endfor --}}


        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="tmr-2">
                    <span class="tbg-gray-100 tcursor-not-allowed tcursor-pointer trounded-full tshadow-md ttext-blue-300 tz-50" style="padding: 6px 12px;">
                        <i class="fas fa-ellipsis-h"></i>
                    </span>
                </li>{{-- Disabled --}}
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="tmr-2">
                            <a class="page-link" href="{{ $url }}">
                                <span class="tbg-blue-500 trounded-full ttext-white tz-50 tcursor-pointer hover:tbg-blue-500 hover:ttext-white" style="padding: 6px 12px;">{{ $page }}</span>
                            </a>
                        </li>{{-- Active --}}
                    @else
                        <li class="tmr-2">
                            <a class="page-link" href="{{ $url }}">
                                <span class="tbg-white trounded-full tshadow-md ttext-blue-500 tz-50 tcursor-pointer hover:tbg-blue-500 hover:ttext-white" style="padding: 6px 12px;">{{ $page }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach


        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="tmr-2">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" class="tbg-white trounded-full tshadow-md ttext-blue-500 tz-50 tcursor-pointer hover:tbg-blue-500 hover:ttext-white" style="padding: 6px 12px;">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="tmr-2">
                <span class="tbg-gray-100 tcursor-not-allowed tcursor-pointer trounded-full tshadow-md ttext-blue-300 tz-50" style="padding: 6px 12px;">
                    <i class="fas fa-chevron-right"></i>
                </span>
            </li>{{-- Disabled --}}
        @endif
    </ul>
</div>
@endif