@extends('layouts.app')

@section('content')
    <div class="col s12 tmb-8 tpx-0 tbg-white tborder-t">
        <div class="tcontainer py-8">
            <ul class="tabs">
                <li class="tab col s3"><a class="active" href="#profile">Profile</a></li>
                <li class="tab col s3"><a href="#orders">Orders</a></li>
                {{-- <li class="tab col s3"><a href="#wishlist">Wishlist</a></li> --}}
                {{-- <li class="tab col s3"><a href="#address">Address Book</a></li> --}}
            </ul>
        </div>
    </div>

    <div class="tmx-3 tpx-0 md:tmx-10 md:tpx-8 sm:tpb-8 md:tpy-8">
        <div class="ttext-black-100 tpb-8">
            @include('pages.user.profile')
            @include('pages.user.orders')
            {{-- @include('pages.user.wishlist') --}}
            {{-- @include('pages.user.address') --}}
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('.tabs').tabs({
                // swipeable: true
            });
        });

          // REMOVE TO WISHLIST
          $('.delete_wishlist').click(function (params) {
            let product_id = $(this).attr('product_id');
            $.get( "wishlist/add/" + product_id, function( data ) {
            });

            $(this).parent().parent().parent().parent().parent().remove();
        }); 
    </script>
    
@endsection