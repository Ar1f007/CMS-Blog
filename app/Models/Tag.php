<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    /**
     * Many to many relationship 
     * between Tags and Posts
     * A tag can have many posts
     * 
     */

     public function posts(){

        return $this->belongsToMany(Post::class);
        
     }
}
