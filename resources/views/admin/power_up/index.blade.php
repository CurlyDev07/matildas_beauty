@extends('admin.power_up.layouts')

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

        @if(session()->has('duplicate'))
            <div class="tbg-green-100 tborder-b tflex titems-center tmb-4 tp-4 tshadow ttext-green-700 txt-sm" role="alert">
                <svg class="tw-5 th-5 tinline tmr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <div class="">
                    <span class="tfont-medium">Duplicate:</span> New item duplicated successfully
                </div>
            </div>
        @endif<!-- Duplicate SUCCESSFULL MESSAGE -->

        <div class="tborder-b tpx-5 tpy-3">
            <ul class="tflex titems-center">
                {{-- <li class="tmr-2">
                    <div class="tborder tflex titems-center tpx-2 trounded ttext-sm tw-16" >
                        <img class="tpr-1" src="{{ asset('images/icons/platform.png') }}" alt="">

                        <select id="platform" class="platform tcursor-pointer browser-default form-control" style="border: none;padding-top: 5px;padding-bottom: 5px;">
                            <option value="fb">FB</option>
                            <option value="shopee">Shopee</option>
                            <option value="lazada">Lazada</option>
                            <option value="tiktok">Tiktok</option>
                        </select> 
                    </div>
                </li><!-- Platform Filter--> --}}
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
                    <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">User</th>
                    <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Account</th>
                    <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Device</th>
                    <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">(Sf/Total)</th>
                    <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Purchase</th>
                    <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Review</th>
                    <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Status</th>
                    <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Action</th>
                </tr>
                
                @foreach ($power_up as $data) 
                    <tr class="hover:tshadow-2xl row" id="{{ $data->id }}">
                        <td class="ttext-sm ttext-center tpy-1">{{ $data->store->store_name  }}</td>
                        <td class="ttext-sm ttext-center tpy-1">{{  $data->user->first_name  }}</td>
                        <td class="ttext-sm ttext-center tpy-1">{{ $data->email }} | {{ $data->password }}</td>
                        <td class="ttext-sm ttext-center tpy-1">{{ $data->phone ?? '--' }}</td>
                        <td class="ttext-sm ttext-center tpy-1">{{ $data->sf }} | {{ $data->total }}</td>
                        <td class="ttext-sm ttext-center tpy-1">
                            <span class="tfont-medium">{{ date_f($data->purchase_date, 'd, M')  }}</span>
                        </td>
                        <td class="ttext-sm ttext-center tpy-1">
                            @if ($data->review_date == '1970-01-01')
                                <span class="chip red lighten-5 waves-effect waves-red" data-id="{{ $data->id }}" style="cursor: pointer;">
                                    <span class="red-text tooltipped" style="cursor: pointer;" data-position="right" data-tooltip="mark as reviewed">--</span>
                                </span>
                            @else
                                <span class="chip green lighten-5 waves-effect waves-green tooltipped" style="cursor: pointer;"  data-position="right" data-tooltip="Reviewed">
                                    <span class="green-text" style="cursor: pointer;">{{  date_f($data->review_date, 'd M') }}</span>
                                </span>
                            @endif
                        </td><!-- review_date -->
                        <td class="ttext-sm ttext-center tpy-1">
                            <span class="tfont-medium">
                                @if ($data->status == 'Shipping')   
                                    @php
                                        $date = date_diff(date_create(date('Y-m-d')), date_create($data->purchase_date));
                                    @endphp

                                    @if ($date->days > 3)
                                        <span class="chip orange lighten-5 waves-effect waves-orange review-chip" data-id="{{ $data->id }}" style="cursor: pointer;">
                                        <span class="orange-text tinline-block tooltipped" style="cursor: pointer;width: 67px;" data-position="right" data-tooltip="mark as reviewed">To Review</span>                                        </span>
                                    @else
                                        <span class="chip red lighten-5 waves-effect waves-red review-chip" data-id="{{ $data->id }}" style="cursor: pointer;">
                                            <span class="red-text tooltipped" style="cursor: pointer;" data-position="right" data-tooltip="mark as reviewed">{{ $data->status }}</span>
                                        </span>
                                    @endif
                                @else
                                        
                                @if ($data->status == 'PENDING')
                                    
                                @endif
                                    <span class="chip green lighten-5 waves-effect waves-green tooltipped" style="cursor: pointer;"  data-position="right" data-tooltip="Reviewed">
                                        <span class="green-text" style="cursor: pointer;">{{ $data->status }}</span>
                                    </span>
                                @endif
                            </span>
                        </td><!-- status -->
                        <td class="ttext-sm ttext-center tpy-1">
                            <a href="/admin/powerup/update/{{ $data->id }}">
                                <i class="fas fa-edit hover:ttext-pink-500 tcursor-pointer tpx-1 icon_color tooltipped" data-position="right" data-tooltip="Edit"></i>       
                            </a>
                            <a href="/admin/powerup/duplicate?id={{ $data->id }}">
                                <i class="fas fa-copy hover:ttext-pink-500 tcursor-pointer tpx-1 icon_color tooltipped" data-position="right" data-tooltip="Duplicate"></i>       
                            </a>
                        </td><!-- action --> 
                    </tr>
                @endforeach
            </table>
        </div><!-- TABLE -->
        <div class="tbg-white tflex tjustify-end tpb-1">
            {{ $power_up->onEachSide(1)->appends(request()->except('page'))->links() }}
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

    $('.review-chip').click(function(){
        let self = $(this);
        
        Swal.fire({
            title: 'Mark as Reviewed?',
            text: "You won't be able to revert this!",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Mark as Reviewed!',
                    'Your power-up has been updated.',
                    'success'
                )// success prompt

                $.ajax({
                    url: '/admin/powerup/mark-as-reviewed',
                    type: 'POST',
                    data: { id: $(this).data('id') },
                    success: ()=>{
                         // Change Button text and color
                        self.attr('class', 'chip green lighten-5 waves-effect waves-green status');
                        self.children().html('Done')
                        self.children().attr('class', 'green-text')
                        self.parent().parent().prev().children().attr('class', 'chip green lighten-5 waves-effect waves-green')
                        self.parent().parent().prev().children().children().attr('class', 'green-text')
                        self.parent().parent().prev().children().children().html('Today')
                    }
                });// update via Ajax request
            }
        })// swal
    });
    
</script>
@endsection