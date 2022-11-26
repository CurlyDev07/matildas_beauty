@extends('admin.expenses.layouts')


@section('page')



    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">Expenses</span>
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
                    <a href="/admin/shopee/">
                        <img src="{{ asset('icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li>
            </ul>
        </div>
        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                <tbody>
                    <tr class="tborder-0">
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Transaction ID</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Name</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Category</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Quantity</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Cost</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Action</th>
                    </tr>
                </tbody>


                @foreach ($expenses as $expense)
                    <tr>
                        <td class="ttext-sm ttext-center">MB{{ $expense->id }}</td>
                        <td class="ttext-sm ttext-center">{{ $expense->name }}</td>
                        <td class="ttext-sm ttext-center">{{ $expense->category->category }}</td>
                        <td class="ttext-sm ttext-center">{{ $expense->quantity }}</td>
                        <td class="ttext-sm ttext-center">{{ $expense->cost }}</td>
                        <td class="ttext-sm ttext-center">
                            <a href="{{ route('expenses.update', $expense->id)}}">
                                <i class="fa-external-link-alt fas gray-text tcursor-pointer tooltipped" data-position="left" data-tooltip="view transaction"></i>
                            </a>
                            <a href="{{ route('expenses.category.delete', $expense->id)}}">
                                <i class="fas fa-trash-alt hover:ttext-red-500 tcursor-pointer tpx-1 icon_color tooltipped" data-tooltip="Delete"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>

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