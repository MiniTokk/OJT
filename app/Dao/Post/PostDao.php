<?php

namespace App\Dao\Post;

use App\Models\Post;
use App\Models\Category;
use App\Exports\PostsExport;
use App\Imports\PostsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Contracts\Dao\Post\PostDaoInterface;

class PostDao implements PostDaoInterface
{
    /**
     * Display a listing of the resource.
     * @return object
     */
    public function index()
    {
        return Post::latest()->paginate(5);
    }

     //Get Category Data
     public function create()
     {
       return Category::all();
     }
 
     //Edit Post Data
     public function edit($post)
     {
         $post =Post::findOrFail($post->id);
         // dd($post);
         $categories= Category::all();
         return array("post"=>$post,"categories"=>$categories);
 
     }
 
    /**
     * Show the form for creating a new resource.
     * @param  \App\Http\Requests\PostRequest $request
     */
    public function store($request)
    {
        $post = Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status
    
          ]);
    
          $post->categories()->attach($request->category);
    
          return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest $request
     * @param  \App\Models\Post  $post
     */

    public function update($request, $post)
    {
        $post = Post::findOrFail($post->id);
       $post->update([
        'title'=>$request->title,
        'description'=>$request->description,
        'status'=>$request->status
       ]);
       $post->categories()->detach();
       $post->categories()->attach($request->category);
       return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post $post
     */
    public function destroy(Post $post)
    {
        return $post->delete();
    }
     /**
     * Download CSV File
     * @param \App\Models\Post $post
     * @param mixed $request
     * @return \Maatwebsite\Excel\Excel
     */
    public function exportPost(Post $post)
    {
        return Excel::download(new PostsExport, 'Post' . now() . '.csv');
    }

    /**
     * Upload CSV File
     * @param \App\Models\Post $post
     * @param mixed $request
     * @return \Maatwebsite\Excel\Excel
     */
    public function importPost(Request $request)
    {
        return Excel::import(new PostsImport, $request->file('file'));
    }
}
