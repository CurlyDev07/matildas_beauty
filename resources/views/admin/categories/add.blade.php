@extends('admin.categories.layouts')

@section('page')
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b text-base tfont-medium tpx-5 tpy-4 t ttext-title">
            Add Category
        </div>
        <form action="{{ route('category.store') }}" method="POST" class="tpx-5 tpt-5">
            @csrf
            <div class="tw-1/1 tflex tflex-col tmr-2">
                <label for="title" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Title</label>
                <input type="text" id="title" name="title" class="browser-default form-control" required style="padding: 6px;" placeholder="Oolong Tea">
            </div>
            <div class="tw-1/1 tflex tflex-col tmr-2 tmt-5">
                <label for="link" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Link</label>
                <input type="text" name="link" id="link" class="browser-default form-control" style="padding: 6px;" required placeholder="http://oolong-tea-i.1">
            </div>
            <div class="tw-1/1 tflex tjustify-end tpy-5 trounded-lg 100 tmt-5">
                <button type="submit" class="focus:tbg-primary tbg-primary tml-auto tpy-2 trounded ttext-white tw-24 waves-effect">Submit</button>
            </div>
        </form>
    </div>
@endsection
