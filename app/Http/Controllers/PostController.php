<?php

namespace App\Http\Controllers\Api;

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Exports\PostsExport;
use App\Imports\PostsImport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Contracts\Services\Post\PostServiceInterface;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;

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
    public function getAllCategories()
    {
        $categories = $this->postService->getAllCategories();
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
    public function exportPdf(Post $post)
    {

        return Excel::download(new PostsExport, 'Post' . now() . '.csv');
    }

    //Export CSV For Post
    public function exportPost(Post $post)
    {
        //$posts = Post::get();
        //$categories = Category::get();
        //$pdf=PDF::loadView('posts.index',compact('posts', 'categories'));
        //return $pdf->download('posts.pdf');
        $file = 'Post' . now() . '.csv';
        $posts = Post::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$file",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = [
            'Title',
            'Description',
            'Status',
            'Categories'
        ];

        $callback = function () use ($posts, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($posts as $post) {
                $categoryNames = $post->categories->pluck('name')->toArray();

                $row['Title'] = $post->title;
                $row['Description'] = $post->description;
                $row['Status'] = $post->status;
                $row['Categories'] = implode(' | ', $categoryNames);

                fputcsv($file, [$row['Title'], $row['Description'], $row['Status'], $row['Categories']]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    //Import CSV For Post
    public function importPost(Request $request)
    {
        $file = $request->file('file');
        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();

            $this->checkUploadedFileProperties($extension, $fileSize);
            $location = 'uploads';

            $file->move($location, $filename);
            $filepath = public_path($location . "/" . $filename);

            $file = fopen($filepath, 'r');
            $importData_arr = array();
            $i = 0;
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata);
                if ($i == 0) {
                    $i++;
                    continue;
                }

                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file);

            $j = 0;
            foreach ($importData_arr as $importData) {
                $title = $importData[0];
                $description = $importData[1];
                $status = $importData[2];
                $requestCategories = explode(' | ', $importData[3]);
                $j++;

                try {
                    DB::beginTransaction();
                    $post = Post::create([
                        'title' => $title,
                        'description' => $description,
                        'status' => $status
                    ]);
                    DB::commit();
                    $databaseCategories = Category::all();
                    $categoryIds = [];
                    foreach ($databaseCategories as $databaseCategory) {
                        foreach ($requestCategories as $requestCategory) {
                            if ($databaseCategory->name === $requestCategory) {
                                array_push($categoryIds, $databaseCategory->id);
                            }
                        }
                    }
                    $post->categories()->attach($categoryIds);
                } catch (\Exception $e) {
                    dd($e);
                    DB::rollBack();
                }
            }
            return redirect()->route('posts.index')->with('success', 'Post has been Uploaded successfully');
        } else {
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        }
    }

    public function checkUploadedFileProperties($extension, $fileSize)
    {
        $valid_extension = array("csv", "xlsx");
        $maxFileSize = 2097152;

        if (in_array(strtolower($extension), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {

            } else {
                throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE);
            }
        } else {
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
        }
    }
}