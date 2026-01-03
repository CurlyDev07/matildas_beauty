@extends('admin.fbads.layouts')

@section('page')


    <!-- <div class="tpb-5 trounded-lg ttext-black-100">
        <form action="{{ route('jandt_reconcile_process') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" required>
            <button type="submit">Upload & Download</button>
        </form>

    </div> -->

<div class="container" style="max-width: 860px;">
    <div class="row" style="margin-top:24px;">
        <div class="col s12">
            <div class="card z-depth-1">
                <div class="card-content">
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
                        <div>
                            <span class="card-title" style="margin-bottom:4px;font-weight:700;">
                                J&amp;T Reconcile (Excel Processor)
                            </span>
                            <div class="grey-text text-darken-1" style="font-size:14px;">
                                Upload the J&amp;T Excel file and we will compute:
                                <b>Total Shipping Cost = Total Shipping Cost + COD commission + COD commission VAT fee</b>
                            </div>
                        </div>

                        <span class="new badge blue" data-badge-caption="" style="border-radius:999px;padding:0 12px;">
                            Downloads processed file
                        </span>
                    </div>

                    @if ($errors->any())
                        <div class="card-panel red lighten-5 red-text text-darken-2" style="margin-top:16px;">
                            <b>Upload failed:</b>
                            <ul style="margin:8px 0 0 18px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="divider" style="margin:18px 0;"></div>

                    <form id="jandtUploadForm"
                          action="{{ url('/admin/fbads/jandt-reconcile/process') }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="row" style="margin-bottom:0;">
                            <div class="col s12">
                                <div class="card-panel grey lighten-5" style="border-radius:12px;">
                                    <div style="display:flex;align-items:flex-start;gap:14px;">
                                        <i class="material-icons blue-text" style="font-size:28px;">upload_file</i>

                                        <div style="flex:1;">
                                            <div style="font-weight:600;margin-bottom:6px;">
                                                Select Excel File
                                            </div>

                                            <div class="grey-text text-darken-1" style="font-size:13px;margin-bottom:10px;">
                                                Accepted formats: .xlsx, .csv
                                            </div>

                                            <div class="file-field input-field" style="margin:0;">
                                                <div class="btn blue">
                                                    <span>Choose File</span>
                                                    <input type="file" class="default-browser" name="file" id="excelFile" accept=".xlsx,.csv" required>
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate default-browser" type="text" placeholder="No file selected">
                                                </div>
                                            </div>

                                            <div id="fileMeta" class="grey-text text-darken-1" style="font-size:12px;margin-top:8px;display:none;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col s12" style="display:flex;gap:10px;justify-content:flex-end;align-items:center;margin-top:8px;flex-wrap:wrap;">
                                <a href="{{ url('/admin/fbads') }}" class="btn-flat">
                                    Back
                                </a>

                                <button id="processBtn" type="submit" class="btn green">
                                    <i class="material-icons left">bolt</i>
                                    Process &amp; Download
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-action grey lighten-5" style="border-top:1px solid #eee;">
                    <div class="grey-text text-darken-2" style="font-size:13px;">
                        Tip: If your file is large, keep the tab open until download starts.
                    </div>
                </div>
            </div>

            <div id="loadingBar" class="card-panel" style="display:none;border-radius:12px;">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div class="preloader-wrapper small active">
                        <div class="spinner-layer spinner-blue-only">
                            <div class="circle-clipper left"><div class="circle"></div></div>
                            <div class="gap-patch"><div class="circle"></div></div>
                            <div class="circle-clipper right"><div class="circle"></div></div>
                        </div>
                    </div>
                    <div>
                        <div style="font-weight:700;">Processing file…</div>
                        <div class="grey-text text-darken-1" style="font-size:13px;">
                            Please don’t close this tab.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

<script>
    (function(){
    var fileInput = document.getElementById('excelFile');
    var meta = document.getElementById('fileMeta');
    var form = document.getElementById('jandtUploadForm');
    var btn = document.getElementById('processBtn');
    var loading = document.getElementById('loadingBar');

    if (fileInput) {
        fileInput.addEventListener('change', function(){
            if (!fileInput.files || !fileInput.files[0]) {
                meta.style.display = 'none';
                meta.textContent = '';
                return;
            }
            var f = fileInput.files[0];
            var sizeMB = (f.size / (1024*1024)).toFixed(2);
            meta.textContent = "Selected: " + f.name + " • " + sizeMB + " MB";
            meta.style.display = 'block';
        });
    }

    if (form) {
        form.addEventListener('submit', function(){
            // show loader + disable button (still normal form submit so download works)
            btn.disabled = true;
            btn.classList.add('disabled');
            loading.style.display = 'block';
        });
    }
})();
</script>





