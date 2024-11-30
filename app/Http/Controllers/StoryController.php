<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::all();
        return response()->json($stories);
    }

    public function show($id)
    {
        $story = Story::find($id);

        if (!$story) {
            return response()->json([
                'error' => 'Story not found',
            ], 404);
        }

        return response()->json($story);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'imageUrl' => 'nullable|string|max:255',
            'videoUrl' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'text' => 'nullable|string',
        ]);

        $story = Story::create($request->all());

        return response()->json([
            'message' => 'Story created successfully',
            'data' => $story,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $story = Story::find($id);

        if (!$story) {
            return response()->json([
                'error' => 'Story not found',
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'imageUrl' => 'nullable|string|max:255',
            'videoUrl' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'text' => 'nullable|string',
        ]);

        $story->update($request->all());

        return response()->json([
            'message' => 'Story updated successfully',
            'data' => $story,
        ]);
    }

    public function destroy($id)
    {
        $story = Story::find($id);

        if (!$story) {
            return response()->json([
                'error' => 'Story not found',
            ], 404);
        }

        $story->delete();

        return response()->json([
            'message' => 'Story deleted successfully',
        ]);
    }
}
