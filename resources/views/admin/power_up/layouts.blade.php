@extends('admin.layouts.app')

@section('content')
    <div id="profile" class="col s12">
        <div class="ttext-2xl ttext-title tfont-medium tpb-4">Power Up</div>
        <div class="tflex">
            <div class="tw-1/4 tmr-10 trounded-lg">
                
                <ul class="collection with-header tshadow-lg tm-0 tsticky ttop-0">
                    <li onclick="window.location.href = '/admin/powerup'" class="collection-item tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/powerup', 'tborder-primary tborder-l-4') }}">
                        <div class="ttext-md ttext-black-100 tmy-1 ">
                            List
                            <a class="secondary-content">
                                <i class="fas fa-users ttext-primary"></i>
                            </a>
                        </div>
                    </li>
                    <li onclick="window.location.href = '/admin/powerup/create'" class="collection-item tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/powerup/create', 'tborder-primary tborder-l-4') }}">
                        <div class="ttext-md ttext-black-100 tmy-1 ">
                            Add
                            <a class="secondary-content">
                                <i class="fas fa-user-plus ttext-primary"></i>
                            </a>
                        </div>
                    </li>
                  
                </ul>
            </div><!-- NAV -->
            <div class="tw-3/4">
                @yield('page')
            </div><!-- CONTENT -->
        </div>
    </div>
@endsection

