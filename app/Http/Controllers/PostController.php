<?php

namespace App\Http\Controllers\Api;

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postService->index();
        return view('posts.index', compact('posts'));
    }

    /**
     *Get all Category 
     *@return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->postService->create();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
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
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $posts = $this->postService->edit($post);
        $oldCategoryIds = $post->categories->pluck('id')->toArray();
        return view('posts.edit', compact('posts', 'oldCategoryIds'));
    }

    /**
     * Update the specified resource in storage.
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
     * Download CSV For Post
     * @param \App\Models\Post $post
     * @return mixed
     */
    public function exportPost(Post $post)
    {
        $posts = $this->postService->exportPost($post);
        return $posts;
    }

    /**
     * Upload CSV For Post
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function importPost(Request $request)
    {
        $posts = $this->postService->importPost($request);
        return redirect()->route('posts.index')->with('success', 'Post has been uploaded successfully.');
    }
      
}
