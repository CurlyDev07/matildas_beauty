@extends('admin.file_manager.layouts')

    

@section('page')


    <div class="tpb-5 trounded-lg ttext-black-100">

        @if (session('success'))
            <div class="tbg-green-200 tborder tborder-green-600 tfont-medium tmb-3 tpy-2 trounded ttext-center ttext-green-900">
                Update Successful
            </div>
        @endif

        <div class="tbg-white tpb-5 trounded-lg tshadow-2xl ttext-black-100 tmb-10">
            <div class="tflex tjustify-between text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
                <div class="">Folders</div>
                <div id="new" class="hover:tbg-gray-300 tbg-white tborder tflex tpx-5 tpy-3 trounded tcursor-pointer">
                    <svg class="Q6yead QJZfhe " width="24" height="24" viewBox="0 0 24 24" focusable="false"><path d="M20 13h-7v7h-2v-7H4v-2h7V4h2v7h7v2z"></path></svg>
                    <span>New Folder</span>
                </div><!-- NEW -->
            </div>

            <div id="folder_container" class="tflex tflex-wrap tpx-5">
                <div id="sample-folder" class="folder tw-1/5 tp-1 thidden">
                    <div class="hover:tbg-gray-400 tbg-gray-300 tflex tpx-3 tpy-4 trounded tcursor-pointer">
                        <svg style="color: #444746;" focusable="false" viewBox="0 0 24 24" height="24px" width="24px" fill="currentColor" class="a-s-fa-Ha-pa">
                            <g>
                                <path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"></path>
                                <path d="M0 0h24v24H0z" fill="none"></path>
                            </g>
                        </svg>
                        <input type="text" value="New Folder" class="filename browser-default tbg-gray-300 tfont-medium tml-2 tw-40">
                        <svg class="options tml-auto" viewBox="0 0 20 20" focusable="false" class=" c-qd a-s-fa-Ha-pa" width="20px" height="20px" fill="currentColor">
                            <path fill="none" d="M0 0h20v20H0V0z"></path>
                            <path d="M10 6c.82 0 1.5-.68 1.5-1.5S10.82 3 10 3s-1.5.67-1.5 1.5S9.18 6 10 6zm0 5.5c.82 0 1.5-.68 1.5-1.5s-.68-1.5-1.5-1.5-1.5.68-1.5 1.5.68 1.5 1.5 1.5zm0 5.5c.82 0 1.5-.67 1.5-1.5 0-.82-.68-1.5-1.5-1.5s-1.5.68-1.5 1.5c0 .83.68 1.5 1.5 1.5z"></path>
                        </svg>
                    </div>
                </div><!-- FOLDER TEMPLATE HIDDEN -->
               
                @foreach ($folders as $folder)
                    <div id="{{ $folder->id }}" class="folder tw-1/5 tp-1">
                        <div class="hover:tbg-gray-400 tbg-gray-300 tflex tpx-3 tpy-4 trounded tcursor-pointer">
                            <svg style="color: #444746;" focusable="false" viewBox="0 0 24 24" height="24px" width="24px" fill="currentColor" class="a-s-fa-Ha-pa">
                                <g>
                                    <path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"></path>
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                </g>
                            </svg>
                            <input type="text" value="{{ $folder->name }}" class="filename browser-default tbg-gray-300 tfont-medium tml-2 tw-40">
                            <svg class="options tml-auto" viewBox="0 0 20 20" focusable="false" class=" c-qd a-s-fa-Ha-pa" width="20px" height="20px" fill="currentColor">
                                <path fill="none" d="M0 0h20v20H0V0z"></path>
                                <path d="M10 6c.82 0 1.5-.68 1.5-1.5S10.82 3 10 3s-1.5.67-1.5 1.5S9.18 6 10 6zm0 5.5c.82 0 1.5-.68 1.5-1.5s-.68-1.5-1.5-1.5-1.5.68-1.5 1.5.68 1.5 1.5 1.5zm0 5.5c.82 0 1.5-.67 1.5-1.5 0-.82-.68-1.5-1.5-1.5s-1.5.68-1.5 1.5c0 .83.68 1.5 1.5 1.5z"></path>
                            </svg>
                        </div>
                    </div><!-- Folder FROM DB -->
                @endforeach
            </div>
        </div>
    </div>



@endsection

@section('js')
    <script>
          

        $('.filename').change(function () {
            let name = $(this).val();
            let id = $(this).parent().parent().attr('id');

            $.ajax({
                url: '/admin/file-manager/folder/change-name',
                type: 'POST',
                data: {name: name, id: id},
                success: (res)=>{
                    M.toast(
                        {
                            html: 'Folder Name Changed Successfully',
                            displayLength: 1500,
                            classes: 'tbg-green-900 tfont-medium toast tpx-10 trounded ttext-sm',
                            outDuration: 400
                        }
                    )
                   console.log(res);
                }
            });// update via Ajax request
        });// Change File Name

        $('#new').click(function () {
            let new_folder = $('#sample-folder').clone(true, true);
            new_folder.removeClass('thidden');

            $.ajax({
                url: '/admin/file-manager/add-folder',
                type: 'POST',
                success: (res)=>{
                    new_folder.attr('id', res); // Chnage Folder ID
                    $('#folder_container').prepend(new_folder);
                }
            });// update via Ajax request
        })

        $('.filename').click(function(e){
            e.stopPropagation();
        });

        $('.options').click(function(e){
            e.stopPropagation();
        });

        $('.folder').click(function () {
            let id = $(this).attr('id');
            window.location = '/admin/file-manager/folder/'+ id;
        })


    </script>
@endsection
