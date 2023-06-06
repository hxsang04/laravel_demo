<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::orderByDesc('id')->paginate(5);
        return view('admin.user.view', compact('users'));
    }

    public function show(User $user){
        return view('admin.user.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success','Successful delete!');
    }

    public function trash(){
        $users = User::onlyTrashed()->orderByDesc('id')->paginate(5);
        return view('admin.user.trash', compact('users'));
    }

    public function restore($id){
        $user = User::withTrashed()->findOrFail($id);
        if(isset($user)){
            $user->restore();
            return back()->with('success', 'Successful restore!');
        }
        
    }

}
