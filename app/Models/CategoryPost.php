<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;
    public function categories() {
        return $this->belongsToMany(Category::class,'category_posts') 
        ->withPivot('post_id','category_id') // load post_id on the pivot
        ->distinct();
    }
    public function posts() {
        return $this->belongsToMany(Post::class,'category_posts')
        ->withPivot('post_id','category_id') // load category_id on the pivot
        ->distinct();
    }

}

