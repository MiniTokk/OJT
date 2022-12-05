<?php

namespace App\Dao\Category;

use App\Models\Category;
use App\Contracts\Dao\Category\CategoryDaoInterface;

class CategoryDao implements CategoryDaoInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::latest()->paginate(5);
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Http\Requests\CategoryRequest $request
     * @return object
     */
    public function store($request)
    {
        return $category = Category::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest $request
     * @param  \App\Models\Category $category
     */

      /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest $request
     * @param  \App\Models\Category $category
     */

    public function edit($request, $category)
    {
        return $category->update($request->all());
    }
    public function update($request, $category)
    {
        return $category->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category $category
     */
    public function destroy(Category $category)
    {
        return $category->delete();
    }
}