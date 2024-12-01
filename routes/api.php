<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StudentAnswerController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('roles')->group(function () {
    Route::get('/', [RoleController::class, 'index']);
    Route::get('{id}', [RoleController::class, 'show']);
    Route::post('/', [RoleController::class, 'store']);
    Route::put('{id}', [RoleController::class, 'update']);
    Route::delete('{id}', [RoleController::class, 'destroy']);
});

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});


Route::prefix('news-categories')->group(function () {
    Route::get('/', [NewsCategoryController::class, 'index']);
    Route::get('{id}', [NewsCategoryController::class, 'show']);
    Route::post('/', [NewsCategoryController::class, 'store']);
    Route::put('{id}', [NewsCategoryController::class, 'update']);
    Route::delete('{id}', [NewsCategoryController::class, 'destroy']);
});

Route::prefix('news')->group(function () {
    Route::get('/', [NewsController::class, 'index']);
    Route::get('{id}', [NewsController::class, 'show']);
    Route::post('/', [NewsController::class, 'store']);
    Route::put('{id}', [NewsController::class, 'update']);
    Route::delete('{id}', [NewsController::class, 'destroy']);
});

Route::prefix('stories')->group(function () {
    Route::get('/', [StoryController::class, 'index']);
    Route::get('{id}', [StoryController::class, 'show']);
    Route::post('/', [StoryController::class, 'store']);
    Route::put('{id}', [StoryController::class, 'update']);
    Route::delete('{id}', [StoryController::class, 'destroy']);
});

Route::prefix('exams')->group(function () {
    Route::get('/', [ExamController::class, 'index']);
    Route::get('{id}', [ExamController::class, 'show']);
    Route::post('/', [ExamController::class, 'store']);
    Route::delete('{id}', [ExamController::class, 'destroy']);
});

Route::prefix('exams/{exam_id}/questions')->group(function () {
    Route::get('/', [QuestionController::class, 'index']);
    Route::get('{id}', [QuestionController::class, 'show']);
    Route::post('/', [QuestionController::class, 'store']);
    Route::put('{id}', [QuestionController::class, 'update']);
    Route::delete('{id}', [QuestionController::class, 'destroy']);
});

Route::prefix('exams/{exam_id}/students/{student_id}/answers')->group(function () {
    Route::get('/', [StudentAnswerController::class, 'index']);
    Route::post('/', [StudentAnswerController::class, 'store']);
    Route::put('{id}', [StudentAnswerController::class, 'update']);
    Route::delete('{id}', [StudentAnswerController::class, 'destroy']);
});





