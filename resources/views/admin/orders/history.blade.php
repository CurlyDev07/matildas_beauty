@extends('admin.orders.layouts')


@section('page')
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">Orders List</span>
            <ul class="tflex titems-center">
                <li class="tmr-4">
                    <form action="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="tflex titems-center">
                        <input type="text" name="search" id="barcode" value="{{ request()->search ?? '' }}" class="browser-default tborder-b tborder-gray-200 tborder-l tborder-t toutline-none tpx-3 tpy-2 trounded-bl trounded-tl" placeholder="Search order number">
                        <button type="submit" class="focus:tbg-white focus:toutline-none grey-text tborder tborder-gray-200 tborder-l-0 tcursor-pointer toutline-none tpx-3 tpy-2 trounded-r-full waves-effect">
                            <i class="fa-flip-horizontal fa-lg fa-search fas"></i>
                        </button>
                    </form>
                </li><!-- SEARCH -->
                <li class="tmr-4 tpt-1">
                    @if (request()->sort == 'asc')
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="tooltipped" data-position="top" data-tooltip="Sort by newest">
                            <i class="material-icons grey-text tmr-3">sort_by_alpha</i>
                        </a>
                    @else
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}" class="tooltipped" data-position="top" data-tooltip="Sort by oldest">
                            <i class="material-icons grey-text">sort_by_alpha</i>
                        </a>
                    @endif
                </li><!-- SORT -->
                <li>
                    <a href="/admin/orders/">
                        {{-- <img src="{{ asset('icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter"> --}}
                    </a>
                </li>
            </ul>
        </div>
        <div class="tpx-3 tpy-4 tflex">
            <table style="width: 100%;">
                <colgroup>
                    <col span="2" style="background-color: #D6EEEE">
                    <col span="3" style="background-color: pink">
                </colgroup>
                <tr>
                    <th>MON</th>
                    <th>TUE</th>
                    <th>WED</th>
                    <th>THU</th>
                    <th>FRI</th>
                    <th>SAT</th>
                    <th>SUN</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td>
                    <td>7</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>9</td>
                    <td>10</td>
                    <td>11</td>
                    <td>12</td>x
                    <td>13</td>
                    <td>14</td>
                </tr>
            </table>
            
            <div class="col">
                <h4 class="tborder tp-2">Products</h4>
                <div class="tflex tflex-col">
                    @foreach ($products as $product)
                        <span class="tp-2 tborder">{{ $product->title }}</span> 
                    @endforeach
                </div>
            </div>

            {{-- <div class="col">
                <h4 class="tborder tp-2">May 24</h4>
                <div class="tflex tflex-col">
                    @foreach ($orders as $order)
                        <span class="tp-2 tborder ttext-center">{{ $order->total_qty }}</span>
                    @endforeach
                </div>
            </div> --}}

            <div class="col">
                <h4 class="tborder tp-2">May 25</h4>
                <div class="tflex tflex-col">
                    <span class="tp-2 tborder ttext-center">23</span>
                    <span class="tp-2 tborder ttext-center">23</span>
                    <span class="tp-2 tborder ttext-center">23</span>
                    <span class="tp-2 tborder ttext-center">23</span>
                    <span class="tp-2 tborder ttext-center">23</span>
                    <span class="tp-2 tborder ttext-center">23</span>
                    <span class="tp-2 tborder ttext-center">23</span>
                </div>
            </div>



        </div><!-- TABLE -->
    </div>
@endsection


@section('js')
<script>
    $(document).ready(function(){
        $('.modal').modal();
        $('.dropdown-trigger').dropdown();

        // CHANGE STATUS
        $('.change_status').click(function(){
            let id = $(this).data('id');
            let status = $(this).data('status');

            $.ajax({
                url: '/admin/orders/change-status',
                type: 'POST',
                data: {
                    id: id,
                    status: status,
                },
                success: ()=>{
                   
                }
            });
        });
    });
</script>
@endsection