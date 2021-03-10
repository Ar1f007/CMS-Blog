<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;


class PostsController extends Controller
{

    public function __construct(){
        $this->middleware('verifyCategoriesExist')->only(['create', 'store']);
    }


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
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
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

        $post = Post::create([

            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'category_id' => $request->category,
            'published_at' => $request->published_at

        ]);

        // if there is any tag or number of tags attached
        // associate this tag or this collection of tags to the post 
        
        if($request->tags){

            $post->tags()->attach($request->tags);

        }

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
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
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
        $data = $request->only(['title', 'content', 'published_at', 'category']);

        //check if there is a new image 
        if($request->hasFile('image')){

            // upload it and store the path
            $imagePath = $request->image->store('posts');

            // delete old one from storage
            $post->deleteImage();

            $data['image'] = $imagePath;

        }

        if($request->tags){

            // if there is new tag added or previous tag got removed
            // helper function sync is gonna attach/detach the tags to the post

            $post->tags()->sync($request->tags);

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

            $post->deleteImage();
            $post->forceDelete();
            session()->flash('message', 'Post deleted permanently');

            return back();
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

    public function restore($id){

        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();
        session()->flash('message', 'Post restored successfully.');

        return back();
    }
}
