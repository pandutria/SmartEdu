<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;

class ExamController extends Controller
{
    public function index()
    {

        $exams = Exam::with(['questions', 'creator'])->get();
        return response()->json($exams);
    }

    public function show($id)
    {
        $exam = Exam::with(['questions', 'creator'])->find($id);

        if (!$exam) {
            return response()->json([
                'error' => 'Exam not found',
            ], 404);
        }

        return response()->json($exam);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'created_by' => 'required|exists:users,id',
            'due_date' => 'required|date',
        ]);

        $exam = Exam::create($request->all());

        return response()->json([
            'message' => 'Exam created successfully',
            'data' => $exam,
        ], 201);
    }

    public function destroy($id)
    {
        $exam = Exam::find($id);

        if (!$exam) {
            return response()->json([
                'error' => 'Exam not found',
            ], 404);
        }

        $exam->delete();

        return response()->json([
            'message' => 'Exam deleted successfully',
        ]);
    }
}
