<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class Post extends Model implements Viewable
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithViews;
    protected $dates = ['published_at'];

    protected $fillable = ['title', 'user_id', 'content', 'image', 'published_at', 'category_id'];
    
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

    /**
     * checks if the post has any tag 
     * @return bool
     */

     public function hasTag($tagId){

      return in_array($tagId, $this->tags->pluck('id')->toArray());

     }

     public function user(){

        return $this->belongsTo(User::class);

     }

     public function scopePublished($query){

      return $query->where('published_at', '<=', now());

     }

     public function scopeSearched($query){
      $search = request()->query('search');

      if(!$search){
        return $query->published();
      }

      return $query->published()->where('title', 'LIKE', '%'.$search.'%');
      
     }

     
}
