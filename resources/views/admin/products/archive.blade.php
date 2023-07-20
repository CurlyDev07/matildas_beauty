@extends('admin.products.layouts')

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
            <span class="ttext-base ttext-title tfont-medium">Products Archive</span>
        </div>
        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full centered">
                <tbody>
                    <tr class="tborder-0">
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">ID#</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Photo</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Name</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Deleted At</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Actions</th>
                    </tr>

                    @foreach ($archive as $item)
                        <tr class="tborder-0 hover:tbg-blue-100">
                            <td class="tp-3 tpx-5 ttext-black-100 tfont-medium">#{{ $item['id'] }}</td>
                            <td class="tp-3 tpx-5">
                                <img src="{{ $item['primary_image'] }}" class="tmx-auto" style="height: 50px;width: 50px;">
                            </td>
                            <td class="tp-3 tpx-5">
                                <a href="{{ item_show_slug($item['title'], $item['id']) }}" target="_blank" class="hover:tunderline ttext-blue-500">{{ $item['title'] }}</a>                        </td>
                            <td class="tp-3 tpx-5">{{ Carbon\Carbon::parse($item['deleted_at'])->format('M d, Y - h:i') }}</td>
                            <td class="tp-3 tpx-5">
                                <span class="chip green lighten-5 waves-effect waves-green restore" data-property_id="{{ $item['id'] }}">
                                    <span class="green-text">Restore</span>
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
        $('.restore').click(function (e) {
            $.ajax({
                type: 'POST',
                url: '{{ route("products.restore") }}',
                data: {
                    property_ids: [$(this).data('property_id')]
                },
            });

            $(this).parent().parent().remove();
        });

        $('#restore_all').click(function (e) {
            $.ajax({
                type: 'POST',
                url: '{{ route("products.restore") }}',
                data: {
                    property_ids: $(this).data('ids')
                },
            });

            window.location.reload();
        });
    </script>
@endsection