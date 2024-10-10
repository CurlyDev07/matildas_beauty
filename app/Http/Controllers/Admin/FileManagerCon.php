<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Folder;
use App\File;
use Illuminate\Support\Facades\Storage;


class FileManagerCon extends Controller
{
    public function index(){
        $folders = Folder::all();
        return view('admin.file_manager.index', ['folders' => $folders]);
    }// index folder list

    public function folder($id){
        $folder = Folder::find($id);
        $files = File::where('folder_id', $id)->get();

        return view('admin.file_manager.folder', ['files' => $files, 'folder' => $folder]);
    }// inside the folder

    public function add_folder(){
        $folder = Folder::create(['name' => 'New Folder']);

        return $folder->id;
    }// add folder
   
    public function upload(Request $request){
        
        echo ini_set('post_max_size');
        echo ini_set('upload_max_filesize');

        if (request()->hasFile('file')) {
            $file = $request->file('file');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = uuid().'.'.$file_ext;

            $store = Storage::disk('filemanager')->putFileAs('/', $file, $file_name);
            // $store = Storage::disk('s3')->putFileAs('/filemanager', $file, $file_name);

            File::create([
                'folder_id' => $request->folder_id,
                'file_name' => $file_name,
                'file_ext' => $file_ext,
                'file_size' => $file->getSize(),
            ]);
        }

        dd("FIle upload");
        return redirect()->back();
    }// Upload File inside the folder

    public function change_name(Request $request){
        $change_name = Folder::find($request->id)->update(['name' => $request->name]);
        return response(['success' => 'Success!']);
    }
}