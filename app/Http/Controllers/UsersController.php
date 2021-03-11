<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index(){
        return view('users.index')->with('users', User::paginate());
    }

    public function makeAdmin(User $user){

        $user->role = 'admin';
        $user->save();
        $name = $user->name;
        session()->flash('message', $name . ' is now an admin of this blog.');

        return back();


    }
}
