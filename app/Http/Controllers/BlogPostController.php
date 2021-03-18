<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class BlogPostController extends Controller
{
    public function displayPost(Post $post)
    {
        return view('blog.show')->with('post', $post);   
    }

    public function categoryPostIndex(Category $category)
    {
        return view('blog.category')
        ->with('category', $category)
        ->with('posts', $category->posts()->searched()->simplePaginate(4))
        ->with('categories', Category::all())
        ->with('tags', Tag::all());
    }

    public function tagPostIndex(Tag $tag)
    {
        return view('blog.tag')->with('tag', $tag)
        ->with('categories', Category::all())
        ->with('tags', Tag::all())        
        ->with('posts', $tag->posts()->searched()->simplePaginate(4));
    }

}
