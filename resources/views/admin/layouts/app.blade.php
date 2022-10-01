
@include('admin.layouts.head')
@include('admin.layouts.nav')

{{-- LOADER --}}
<style>
    .progress {
        position: relative;
        height: 4px;
        display: block;
        width: 100%;
        background-color: #aefb49;
        border-radius: 2px;
        margin: 0!important;
        overflow: hidden;
    }
    .progress .indeterminate {
        background-color: #e4f11f!important;;
    }
    .progress_parent{
        position: -webkit-sticky; /* Safari */
        position: sticky;
        top: 0;
        z-index: 999;
        display: none;
    }
</style>
<div class="progress_parent" id="progress">
    <div class="progress">
        <div class="indeterminate"></div>
    </div>
</div>

    <div style="background-color: #f3f5f7;min-height: 100vh;">
        <div class="tcontainer tpy-8">
            @yield('content')
        </div> 
    </div>
     
@include('admin.layouts.footer')


