<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index($exam_id)
    {
        $questions = Question::where('exam_id', $exam_id)->get();
        return response()->json($questions);
    }

    public function show($id)
    {
        $question = Question::with('exam')->find($id);

        if (!$question) {
            return response()->json([
                'error' => 'Question not found',
            ], 404);
        }

        return response()->json($question);
    }

    public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|in:A,B,C,D',
        ]);

        $question = Question::create($request->all());

        return response()->json([
            'message' => 'Question created successfully',
            'data' => $question,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $question = Question::find($id);

        if (!$question) {
            return response()->json([
                'error' => 'Question not found',
            ], 404);
        }

        $request->validate([
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|in:A,B,C,D',
        ]);

        $question->update($request->all());

        return response()->json([
            'message' => 'Question updated successfully',
            'data' => $question,
        ]);
    }

    public function destroy($id)
    {
        $question = Question::find($id);

        if (!$question) {
            return response()->json([
                'error' => 'Question not found',
            ], 404);
        }

        $question->delete();

        return response()->json([
            'message' => 'Question deleted successfully',
        ]);
    }
}
