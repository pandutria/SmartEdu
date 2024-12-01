<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAnswer;

class StudentAnswerController extends Controller
{
    public function index($exam_id, $student_id)
    {
        $answers = StudentAnswer::with(['question', 'exam'])
            ->where('exam_id', $exam_id)
            ->where('student_id', $student_id)
            ->get();

        return response()->json($answers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'student_id' => 'required|exists:users,id',
            'question_id' => 'required|exists:questions,id',
            'selected_option' => 'required|in:A,B,C,D',
        ]);

        $answer = StudentAnswer::create($request->all());

        return response()->json([
            'message' => 'Answer submitted successfully',
            'data' => $answer,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $answer = StudentAnswer::find($id);

        if (!$answer) {
            return response()->json([
                'error' => 'Answer not found',
            ], 404);
        }

        $request->validate([
            'selected_option' => 'required|in:A,B,C,D',
        ]);

        $answer->update($request->only('selected_option'));

        return response()->json([
            'message' => 'Answer updated successfully',
            'data' => $answer,
        ]);
    }

    public function destroy($id)
    {
        $answer = StudentAnswer::find($id);

        if (!$answer) {
            return response()->json([
                'error' => 'Answer not found',
            ], 404);
        }

        $answer->delete();

        return response()->json([
            'message' => 'Answer deleted successfully',
        ]);
    }
}
