<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsCategory;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $categories = NewsCategory::all();
        return response()->json($categories);
    }

    public function show($id)
    {
        $category = NewsCategory::find($id);

        if (!$category) {
            return response()->json([
                'error' => 'Category not found',
            ], 404);
        }

        return response()->json($category);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = NewsCategory::create($request->all());

        return response()->json([
            'message' => 'Category created successfully',
            'data' => $category,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $category = NewsCategory::find($id);

        if (!$category) {
            return response()->json([
                'error' => 'Category not found',
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->all());

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $category,
        ]);
    }

    public function destroy($id)
    {
        $category = NewsCategory::find($id);

        if (!$category) {
            return response()->json([
                'error' => 'Category not found',
            ], 404);
        }

        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully',
        ]);
    }
}
