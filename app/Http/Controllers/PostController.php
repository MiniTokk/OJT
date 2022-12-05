<?php

namespace App\Http\Controllers\Api;

namespace App\Http\Controllers;

use Excel;
use App\Models\Post;
use App\Exports\PostsExport;
//use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PostsImport;
use App\Http\Requests\PostRequest;
use App\Contracts\Services\Post\PostServiceInterface;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postService->index();
        return view('posts.index', compact('posts'));
    }

    /**
     *Get Category Data in Post Create Route
     */
    public function create()
    {
        $categories = $this->postService->create();
        return view('posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
      
        $posts = $this->postService->store($request);
        
        return redirect()->route('posts.index', compact('posts'))->with('success', 'Post has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $posts = $this->postService->edit($post);
        return view('posts.edit', compact('posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $posts = $this->postService->update($request, $post);
        return redirect()->route('posts.index', compact('posts'))->with('success', 'Post Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $posts = $this->postService->destroy($post);
        return redirect()->route('posts.index', compact('posts'))->with('success', 'Post has been deleted successfully');
    }

    /**
     * pivot table
     */
    public function categorypost()
    {
        $posts=Post::find(1);

        foreach ($posts->categories()->get() as $categorypost) {
            $categorypost->pivot->name;
        }
        return view('posts.create',compact('posts'));
    }

    //Export CSV For Post
    public function exportPost(Post $post) {
        return Excel::download(new PostsExport,'Post'.now().'.xlsx');
    }

     //Import CSV For Post
     public function importPost(PostRequest $request,Post $post) {
    //    $post = Post::create([
    //        'title'=>$request->title,
    //        'description'=>$request->description,
    //        'status'=>$request->status
    //        
    //      ]);
    //
    //      $post->categories()->attach($request->category);
    

        dd($request);
       Excel::import(new PostsImport, $request->file('file'));

         return redirect()->route('posts.index', compact('posts'))->with('success', 'Post has been created successfully.');
        }

}