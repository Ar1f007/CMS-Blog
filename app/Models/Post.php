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

    protected $fillable = ['title', 'content', 'image', 'published_at'];
    
    /**
    * delete image from the storage
    * @return void
    */

    public function deleteImage(){
        Storage::delete($this->image);
    }

}
