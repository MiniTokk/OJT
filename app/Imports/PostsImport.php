<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Post;
use Maatwebsite\Excel\Concerns\ToModel;

class PostsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $categoryIds = [];
        $post = Post::where('title', $row[0])->first();

        if (!$post) {
            $post = Post::create([
                'title' => $row[0],
                'description' => $row[1],
                'status' => $row[2]
            ]);
        }

        $categories = explode('|', $row[3]);
        foreach ($categories as  $category) {
            $existCategory = Category::where('name', trim($category))->first();
            if (!$existCategory) {
                $existCategory = Category::create(['name' => $category]);
            }

            $categoryIds[] = $existCategory->id;
        }
        info($categoryIds);
        $post->categories()->detach();
        $post->categories()->attach($categoryIds);
        return $post;
    }
}