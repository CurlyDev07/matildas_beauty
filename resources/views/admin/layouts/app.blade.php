
@include('admin.layouts.head')
@include('admin.layouts.nav')

<style>
    .progress {
        position: relative;
        height: 3px;
        display: block;
        width: 100%;
        background-color: #aefb49;
        border-radius: 0;
        margin: 0 !important;
        overflow: hidden;
    }
    .progress .indeterminate {
        background-color: #e91e8c !important;
    }
    .progress_parent {
        position: sticky;
        top: 0;
        z-index: 999;
        display: none;
    }
</style>

<div class="admin-main-content">

    <div class="progress_parent" id="progress">
        <div class="progress">
            <div class="indeterminate"></div>
        </div>
    </div>

    <div style="padding: 28px 32px;">
        @yield('content')
    </div>

</div>

@include('admin.layouts.footer')
