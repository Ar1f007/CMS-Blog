<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Http\Requests\Users\UpdateProfileRequest;

class UsersController extends Controller
{

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index')->with('users', User::paginate(10));
    }

    /**
     * 
     * make user an admin
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function makeAdmin(User $user)
    {
        $user->role = 'admin';
        $user->save();
        $name = $user->name;
        session()->flash('message', $name . ' is now an admin of this blog.');

        return back();
    }

    /**
     * 
     * Update user info
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    
    /**
     * 
     * Display posts of the particular writer
     * 
     * @return Illuminate\Http\Response
     */
    public function view($user)
    {
        return view('posts.index')->with('posts', Post::where('user_id', $user)->paginate(10));
    }

    /**
     * 
     * Display the posts of the admin
     * 
     * @return \Illuminate\Http\Response
     */
    public function adminsPost($user)
    {
        $posts = Post::where('user_id', $user)->paginate(10);
        return view('posts.index', compact('posts', $posts));
    }


}
