<?php

namespace App\Services\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Contracts\Dao\Category\CategoryDaoInterface;
use App\Contracts\Services\Category\CategoryServiceInterface;

class CategoryService implements CategoryServiceInterface
{
    private $categoryDao;

    public function __construct(CategoryDaoInterface $categoryDao)
    {
        $this->categoryDao = $categoryDao;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return $this->categoryDao->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest $request
     */
    public function store(Request $request)
    {
        return $this->categoryDao->store($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest $request
     * @param  \App\Models\Category $category
     */
    public function update(Request $request, Category $category)
    {
        return $this->categoryDao->update($request, $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category $category
     */
    public function destroy(Category $category)
    {
        return $this->categoryDao->destroy($category);
    }
}
