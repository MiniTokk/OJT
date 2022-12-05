<?php

namespace App\Contracts\Dao\Category;

use App\Models\Category;

interface CategoryDaoInterface
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index();

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest $request
     */
    public function store($request);

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest $request
     * @param  \App\Models\Category $category
     */
    public function update($request, $post);

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category $category
     */
    public function destroy(Category $post);
}