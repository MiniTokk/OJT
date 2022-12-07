<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function categories() {
        return $this->belongsToMany(Category::class,'category_posts','post_id','category_id')->withTimestamps();
    }

    public static function getAllPosts(){
        $result = DB::table('posts')
            ->select('id', 'name', 'email')
            ->get()->toArray();
        return $result;
    }
}
