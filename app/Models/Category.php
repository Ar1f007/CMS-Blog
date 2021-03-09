<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];



    /**
     * Creating one to many relation between post and category
     * one category can have many posts
     */
    public function posts(){    
       return $this->hasMany(Post::class);
    }
}
