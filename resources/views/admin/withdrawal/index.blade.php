@extends('admin.withdrawal.layouts')

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@section('css')
    <style>
        select:focus, input:focus{
            outline: none;
            border:none;
            -webkit-box-shadow: none!important;
            -moz-box-shadow: none!important;
            box-shadow: none!important;
        }

        .select-dropdown{
            border-bottom: none!important;
            margin-bottom: 0px;
        }
        .select-wrapper{
            height: 31px;
        }
        .caret{
            display: none;
        }
    </style>
@endsection

@section('page')

    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">

        <div class="tborder-b tpx-5 tpy-3">
            <ul class="tflex titems-center">
              
                <li class="tmr-2">
                    <div class="tborder tflex titems-center tpx-2 trounded ttext-sm tw-16" >
                        <img class="tpr-1" src="{{ asset('images/icons/store.png') }}" alt="">
                        <select id="stores" class="stores tcursor-pointer browser-default form-control" style="border: none;padding-top: 5px;padding-bottom: 5px;">
                            <option value="#" selected>Choose ...</option>

                            @foreach ($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                            @endforeach
                        </select> 
                    </div>
                </li><!-- Store Filter-->
                <li class="tmr-2">
                    <div class="tborder tflex titems-center tpx-2 tpy-1 trounded ttext-sm" >
                        <img class="tpr-1" src="{{ asset('images/icons/calendar.png') }}" alt="">
                        <input type="text" name="purchase_date" id="purchase_date" value="{{ request()->purchase_date }}" class="browser-default tooltipped" data-position="top" data-tooltip="Filter by purchase date"/>
                    </div>
                </li><!-- purchase_date Filter-->
                <li class="tmr-2">
                    <div class="tborder tflex titems-center tpx-2 tpy-1 trounded ttext-sm" >
                        <img class="tpr-1" src="{{ asset('images/icons/calendar.png') }}" alt="">
                        <input type="text" name="review_date" id="review_date" value="{{ request()->review_date }}" class="browser-default tooltipped" data-position="top" data-tooltip="Filter by review date"/>
                    </div>
                </li><!-- review_date Filter-->
                <li class="tml-3 tml-auto tmr-2">
                    <a href="/admin/powerup">
                        <img src="{{ asset('images/icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li><!-- REMOVE FILTER -->
            </ul>
            <ul class="tflex titems-center tjustify-center tmt-2">
                @if (!request()->purchase_date && !request()->review_date)
                    <li class="tmr-2">
                        <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                            <span class="tpl-1 ttext-red-500">
                                <i class="fas fa-bookmark"></i>
                                Past 7 Days
                            </span>
                        </div>
                    </li>
                @endif <!-- Default Date |  Past 7 Days-->

                @if (request()->purchase_date)
                    <li class="tmr-2">
                        <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                            <span class="tpl-1 ttext-red-500">
                                <i class="fas fa-bookmark"></i>
                                Purchase: {{ request()->purchase_date }}
                            </span>
                        </div>
                    </li>
                @endif <!--PURCHASE Date-->

                @if (request()->review_date)
                <li class="tmr-2">
                    <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                        <span class="tpl-1 ttext-red-500">
                            <i class="fas fa-bookmark"></i>
                            Review: {{ request()->review_date }}
                        </span>
                    </div>
                </li>
                @endif <!--REVIEW Date-->

                @if (request()->stores)
                    <li class="tmr-2">
                        <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                            <span class="tpl-1 ttext-red-500">
                                <i class="fas fa-bookmark"></i>
                                @foreach ($stores as $store)
                                    @if ($store->id == request()->stores)
                                        {{ $store->store_name }}
                                    @endif
                                @endforeach
                            </span>
                        </div>
                    </li>
                @endif <!--STORE FILTER -->
            </ul>
        </div>

        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                <tr class="tborder-0">
                    <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Store</th>
                    <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Amount</th>
                    <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Date</th>
                    <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Statu</th>
                </tr>
                

                @foreach ($withdrawal as $withdraw)
                    <tr>
                        <td class="ttext-sm ttext-center tpy-1">{{ $withdraw->store->store_name }}</td>
                        <td class="ttext-sm ttext-center tpy-1">{{ $withdraw->amount }}</td>
                        <td class="ttext-sm ttext-center tpy-1">{{ $withdraw->date }}</td>
                        <td class="ttext-sm ttext-center tpy-1">
                            @if ($withdraw->status == 'to_validate')
                                <span class="chip red lighten-5 waves-effect waves-red to_validate" data-id="{{ $withdraw->id }}" style="cursor: pointer;">
                                    <span class="red-text tooltipped" style="cursor: pointer;" data-position="right" data-tooltip="mark as reviewed">{{ $withdraw->status }}</span>
                                </span>
                            @else
                                <span class="chip green lighten-5 waves-effect waves-green" data-id="{{ $withdraw->id }}" style="cursor: pointer;">
                                    <span class="green-text tooltipped" style="cursor: pointer;" data-position="right" data-tooltip="mark as reviewed">{{ $withdraw->status }}</span>
                                </span>
                            @endif
                            
                        </td>
                    </tr>
                @endforeach
            </table>
        </div><!-- TABLE -->
        <div class="tbg-white tflex tjustify-end tpb-1">
            {{-- {{ $withdrawal->onEachSide(1)->appends(request()->except('page'))->links() }} --}}
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session()->has('duplicate'))
    <script>
        $("#{{ session()->get('id') }}").addClass('tbg-green-100');
    </script>
@endif<!-- Duplicate SUCCESSFULL MESSAGE -->

<script>

    $('input[name="purchase_date"]').daterangepicker({
        maxDate: moment(),
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    $('#purchase_date').change(function () {
        const parser = new URL(window.location.href);
        parser.searchParams.set("purchase_date", $(this).val());
        window.location = parser.href;
    });

    $('input[name="review_date"]').daterangepicker({
        maxDate: moment(),
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    $('#review_date').change(function () {
        const parser = new URL(window.location.href);
        parser.searchParams.set("review_date", $(this).val());
        window.location = parser.href;
    });

    $('#stores').change(function (e) {
        e.preventDefault();

        const parser = new URL(window.location.href);
        parser.searchParams.set("stores", $(this).val());
        window.location = parser.href;

        return false;

    });


    $('#platform').change(function (e) {
        e.preventDefault();

        const parser = new URL(window.location.href);
        parser.searchParams.set("platform", $(this).val());
        window.location = parser.href;

        return false;

    });


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

    $('.to_validate').click(function(){
        let self = $(this);
        
        Swal.fire({
            title: 'Mark as Validated?',
            text: "You won't be able to revert this!",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Mark as Validated!',
                    'Your withdrawal status has been updated.',
                    'success'
                )// success prompt

                $.ajax({
                    url: '/admin/withdrawal/status',
                    type: 'POST',
                    data: { id: $(this).data('id') },
                    success: ()=>{
                        self.parent().html(`<span class="chip green lighten-5 waves-effect waves-green" data-id="1" style="cursor: pointer;">
                                    <span class="green-text tooltipped" style="cursor: pointer;" data-position="right" data-tooltip="mark as reviewed">validated</span>
                                </span>`);
                         // Change Button text and color
                    }
                });// update via Ajax request
            }
        })// swal
    });
    
</script>
@endsection