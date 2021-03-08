<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $imagePath = $request->image->store('posts');

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'published_at' => $request->published_at
        ]);

            session()->flash('message', 'Post created successfully.');

            return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //get the attributes 
        $data = $request->only(['title', 'content', 'published_at']);

        //check if there is a new image 
        if($request->hasFile('image')){

            // upload it and store the path
            $imagePath = $request->image->store('posts');

            // delete old one from storage
            Storage::delete($post->image);

            $data['image'] = $imagePath;
        }

        $post->update($data); 
        session()->flash('message', 'Post updated successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if($post->trashed()){

            Storage::delete($post->image);
            $post->forceDelete();
            session()->flash('message', 'Post deleted permanently');

            return redirect()->back();
        }
        else{
            $post->delete();
            session()->flash('message', 'Post trashed successfully. If you want to restore it, go to the "Trashed post" category.');
        }
         
        return redirect(route('posts.index'));
    }

    /**
     * Display the list of all the trashed posts
    
     * @return \Illuminate\Http\Response
     */

    public function trashed(){
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts', $trashed);
    }
}
