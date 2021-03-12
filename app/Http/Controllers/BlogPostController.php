<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogPostController extends Controller
{
    public function displayPost(Post $post){
        return view('blog.show')->with('post', $post);
    }
}
