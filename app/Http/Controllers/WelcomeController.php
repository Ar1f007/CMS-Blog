<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    public function index(){

    $search = request()->query('search');

    if($search)
    {
        $posts = Post::where('title', 'LIKE', "%{$search}%")->simplePaginate(1);
    }
    else
    {
        $posts = Post::simplePaginate(4);
    }

    return view('welcome')
    ->with('posts', $posts)
    ->with('categories', Category::all())
    ->with('tags', Tag::all());

    }
}
