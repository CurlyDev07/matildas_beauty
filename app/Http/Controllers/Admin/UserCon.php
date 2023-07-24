<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class UserCon extends Controller
{
    public function index(){
        $users = User::all();

        return view('admin.users.index', ['users' => $users]);
    }

    public function role(Request $request){
        $user = User::find($request->id);
        $user->update(['role' => $request->role]);

        return redirect()->back()->with('success', 'Success');
    }
}
