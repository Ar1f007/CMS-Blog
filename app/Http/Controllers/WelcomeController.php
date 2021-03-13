<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    public function index(){

    return view('welcome')
    ->with('posts', Post::searched()->simplePaginate(4))
    ->with('categories', Category::all())
    ->with('tags', Tag::all());

    }
}
