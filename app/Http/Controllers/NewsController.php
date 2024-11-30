<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('category')->get();
        return response()->json($news);
    }

    public function show($id)
    {
        $news = News::with('category')->find($id);

        if (!$news) {
            return response()->json([
                'error' => 'News not found',
            ], 404);
        }

        return response()->json($news);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'imageUrl' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'category_id' => 'required|exists:news_categories,id',
        ]);

        $news = News::create($request->all());

        return response()->json([
            'message' => 'News created successfully',
            'data' => $news,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json([
                'error' => 'News not found',
            ], 404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'imageUrl' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'category_id' => 'required|exists:news_categories,id',
        ]);

        $news->update($request->all());

        return response()->json([
            'message' => 'News updated successfully',
            'data' => $news,
        ]);
    }

    public function destroy($id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json([
                'error' => 'News not found',
            ], 404);
        }

        $news->delete();

        return response()->json([
            'message' => 'News deleted successfully',
        ]);
    }
}
