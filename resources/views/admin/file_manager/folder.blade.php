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
                <div class="">
                    <a href="{{ route('file_manager.index') }}" type="submit" class="focus:tbg-gray-800 hover:tbg-gray-500 tbg-gray-800 tml-auto tpy-2 ttext-white tw-24 waves-effect tpx-2" >
                        <i class="fas fa-arrow-left"></i>
                        Folders
                    </a>
                </div>
                <div class="tflex titems-center tjustify-between">
                    <a href="{{ route('file_manager.index') }}">File Manager </a>
                    <i class="fas fa-chevron-right ttext-gray-500 tmx-2"></i> 
                    <a href="{{ route('file_manager.index') }}">Folders</a>
                    <i class="fas fa-chevron-right ttext-gray-500 tmx-2"></i> 
                    <span class="ttext-gray-700 tunderline">{{ $folder->name }}</span>
                    
                </div>
                    
                <form method="POST" action="{{ route('file_manager.upload') }}" class="tflex" enctype="multipart/form-data">
                    @csrf
                    <div id="new" class="hover:tbg-gray-300 tbg-white tborder tflex tpx-5 tpy-3  tcursor-pointer">
                        <svg class="Q6yead QJZfhe" width="24" height="24" viewBox="0 0 24 24" focusable="false"><path d="M20 13h-7v7h-2v-7H4v-2h7V4h2v7h7v2z"></path></svg>
                        <span>New File</span>
                    </div><!-- NEW -->
                    <input type="text" name="folder_id" value="{{ request()->id }}" class="thidden">
                    <input type="file" id="new_file" name="file" class="thidden">
                    <button type="submit" class="focus:tbg-primary tbg-primary tml-auto tpy-2 ttext-white tw-24 waves-effect" >Upload</button>
                </form>
            </div>

            <div id="image_container" class="tflex tflex-wrap tpx-5">
                @foreach ($files as $file)

                    @if ($file->file_ext == 'mp4')
                        <div class="lg:tw-1/4 md:tw-1/3 sm:tw-1/2 tflex tjustify-center tpx-1 trelative tw-full tmb-5   tpy-2">
                            <div class="tborder tflex titems-center tjustify-center tpx-2 trelative tshadow-2xl tw-full" style="max-width: 280px; max-height: 280px; height: 280px;overflow: hidden;">
                                <div class="tabsolute tpy-1 tbg-white tfont-medium tpx-2 ttext-sm tw-full ttruncate ttext-gray-900" style="top: 0%; left: 0%;">filemanager/{{ $file->file_name }}</div>
                                {{-- <img class="lazy" data-src="{{ asset('filemanager/'. $file->file_name) }}" > --}}
                                <video class="tw-full video-testimonial" controls playsinline webkit-playsinline>
                                    <source src="{{ asset('filemanager/'. $file->file_name) }}" type="video/mp4">
                                    <source src="movie.ogg" type="video/ogg">
                                </video>
                                <div class="tabsolute tbg-white tfont-medium tpx-2 truncate ttext-sm tw-full tpy-1" style="bottom: 0%; left: 0%;">
                                    <div class="tw-full tflex tjustify-between tpx-5">
                                        <div class="">Size: <span class="file_size ttext-gray-900">{{ $file->file_size }}</span></div>
                                        <div class=""> Type: <span class="ttext-gray-900">Png</span> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="lg:tw-1/4 md:tw-1/3 sm:tw-1/2 tflex tjustify-center tpx-1 trelative tw-full tmb-5   tpy-2">
                            <div class="tborder tflex titems-center tjustify-center tpx-2 trelative tshadow-2xl tw-full" style="max-width: 280px; max-height: 280px; height: 280px;overflow: hidden;">
                                <div class="tabsolute tpy-1 tbg-white tfont-medium tpx-2 ttext-sm tw-full ttruncate ttext-gray-900" style="top: 0%; left: 0%;">filemanager/{{ $file->file_name }}</div>
                                <img class="lazy" data-src="{{ asset('filemanager/'. $file->file_name) }}" >
                                <div class="tabsolute tbg-white tfont-medium tpx-2 truncate ttext-sm tw-full tpy-1" style="bottom: 0%; left: 0%;">
                                    <div class="tw-full tflex tjustify-between tpx-5">
                                        <div class="">Size: <span class="file_size ttext-gray-900">{{ $file->file_size }}</span></div>
                                        <div class=""> Type: <span class="ttext-gray-900">Png</span> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                @endforeach
            </div>
        </div>
    </div>



@endsection

@section('js')


    <script>

        function bytesToSize(bytes) {
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            if (bytes === 0) return 'n/a';
            const i = parseInt(Math.floor(Math.log(Math.abs(bytes)) / Math.log(1024)), 10);
            if (i === 0) return `${bytes} ${sizes[i]}`;
            return `${(bytes / (1024 ** i)).toFixed(1)} ${sizes[i]}`;
        }
                

        $(function() {
            $.each($('.file_size'), function (indexInArray, val) { 
                let file_size = bytesToSize($(this).html());
                $(this).html(file_size);
            });
            
            $('.lazy').Lazy();
        });

        $('#new').click(function () {
            $('#new_file').click();
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
