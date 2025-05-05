<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 *
 * Controller to manage category-related operations.
 * Includes methods to list, show, create, update, and delete categories.
 */
class CategoryController extends Controller
{
    /**
     * Display a list of top-level categories (no parent).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();

        return response()->json([
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new category.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created category in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified category.
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified category in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return void
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified category from the database.
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function destroy(Category $category)
    {
        //
    }
}
