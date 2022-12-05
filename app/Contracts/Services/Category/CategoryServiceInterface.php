<?php

namespace App\Contracts\Services\Category;

use App\Models\Category;
use Illuminate\Http\Request;

interface CategoryServiceInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index();

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest $request
     */
    public function store(Request $request);

    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\CategoryRequest $request
     * @param  \App\Models\Category $category
     */
    public function update(Request $request, Category $category);

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category $category
     */
    public function destroy(Category $category);
}