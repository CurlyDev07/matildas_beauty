@extends('admin.categories.layouts')

@section('css')
    <style>
        .icon_color{
            color: #9e9e9e
        }
    </style>
@endsection

@section('page')
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">Orders List</span>
            <ul class="tflex titems-center">
                <li class="tmr-4">
                    <form action="http://127.0.0.1:8000/admin/orders?sort=desc" class="tflex titems-center">
                        <input type="text" name="search" id="barcode" value="" class="browser-default tborder-b tborder-gray-200 tborder-l tborder-t toutline-none tpx-3 tpy-2 trounded-bl trounded-tl" placeholder="Search order number">
                        <button type="submit" class="focus:tbg-white focus:toutline-none grey-text tborder tborder-gray-200 tborder-l-0 tcursor-pointer toutline-none tpx-3 tpy-2 trounded-r-full waves-effect">
                            <i class="fa-flip-horizontal fa-lg fa-search fas"></i>
                        </button>
                    </form>
                </li><!-- SEARCH -->
                <li class="tmr-4 tpt-1">
                    <a href="http://127.0.0.1:8000/admin/orders?sort=asc" class="tooltipped" data-position="top" data-tooltip="Sort by oldest">
                        <i class="material-icons grey-text">sort_by_alpha</i>
                    </a>
                </li><!-- SORT -->
                <li>
                    <a href="/admin/orders/">
                        <img src="http://127.0.0.1:8000/icons/clear_filter.png" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li>
            </ul>
        </div>
        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                <tbody>
                    <tr class="tborder-0">
                        <th class="ttext-left tp-3 tpx-5 ttext-black-100 tfont-medium">Name</th>
                        <th class="ttext-left tp-3 tpx-5 ttext-black-100 tfont-medium">Link</th>
                        <th class="tfont-medium tp-3 tpx-5 ttext-black-100 ttext-left tw-32 ttext-center">Actions</th>
                    </tr>

                    @foreach ($categories as $category)
                        <tr class="tborder-0 hover:tbg-blue-100">
                            <td class="tp-3 tpx-5">{{ $category['title'] }}</td>
                            <td class="tp-3 tpx-5">
                                <a href="{{ $category['link'] }}" class="ttext-blue-500 tunderline tcursor-pointer">{{ $category['link'] }}</a>
                            </td>
                            <td class="tp-3 tpx-5 ttext-center">
                                <span class="chip lighten-5 red tcursor-pointer waves-effect waves-red delete" data-id="{{ $category['id'] }}">
                                    <span class="red-text">Delete</span>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- TABLE -->
    </div>
@endsection

@section('js')
    <script>
        $('.delete').click(function () {
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: '{{ route("category.delete") }}',
                data: { id: id }
            });
            $(this).parent().parent().remove();
        });
    </script>
@endsection