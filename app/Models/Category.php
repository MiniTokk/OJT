<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'name',
        'created_at',
        'updated_at',
    ];

    public function posts() {
        return $this->belongsToMany(Post::class,'category_posts','post_id','category_id');
    }
}