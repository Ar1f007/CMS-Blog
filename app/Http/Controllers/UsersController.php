<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Users\UpdateProfileRequest;

class UsersController extends Controller
{
    public function index()
    {
        return view('users.index')->with('users', User::paginate());
    }

    public function makeAdmin(User $user)
    {
        $user->role = 'admin';
        $user->save();
        $name = $user->name;
        session()->flash('message', $name . ' is now an admin of this blog.');

        return back();
    }

    public function update(UpdateProfileRequest $request)
    {
        auth()->user()->update($request->only('name', 'email'));

        if($request->input('password')){
            auth()->user()->update([
                'password' => bcrypt($request->input('password'))
            ]);
        }

        return redirect(route('profile'))->with('message', 'Profile saved successfully.');

    }
}
