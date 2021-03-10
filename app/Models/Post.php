<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $dates = ['published_at'];

    protected $fillable = ['title', 'content', 'image', 'published_at', 'category_id'];
    
    /**
    * delete image from the storage
    * @return void
    */

    public function deleteImage(){
      
        Storage::delete($this->image);
    }

    /**
     * relationship between category and post
     * A post has one category
     * A category has many posts
     */
    public function category(){ // this category is the name of model called Category

      return  $this->belongsTo(Category::class);

    }


    /**
     * many to many relationship
     * between posts and tags
     * A post can have many tags
     */
    public function tags(){

      return $this->belongsToMany(Tag::class);

    }
}
