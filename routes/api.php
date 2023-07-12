<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\StudentinfoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group([
    'middleware' => ['api'],
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);
});

Route::group([
    'middleware' => ['api'],
    'prefix' => 'grades'
], function ($router) {
    Route::get('/show/{grade}', [GradeController::class, 'show']);
    Route::get('/index', [GradeController::class, 'index']);
    Route::post('/store', [GradeController::class, 'store']);
    Route::post('/update/{grade}', [GradeController::class, 'update']);
    Route::delete('/destroy/{grade}', [GradeController::class, 'destroy']);
});



Route::group([
    'middleware' => ['api'],
    'prefix' => 'classroom'
], function ($router) {
    Route::get('/show/{classroom}', [ClassroomController::class, 'show']);
    Route::get('/index', [ClassroomController::class, 'index']);
    Route::post('/store', [ClassroomController::class, 'store'])->middleware('auth:api');
    Route::post('/update/{classroom}', [ClassroomController::class, 'update'])->middleware('auth:api');
    Route::delete('/destroy/{classroom}', [ClassroomController::class, 'destroy'])->middleware('auth:api');

});

Route::group([
    'middleware' => ['api'],
    'prefix' => 'section'
], function ($router) {
    Route::get('/show/{section}', [SectionController::class, 'show']);
    Route::get('/index', [SectionController::class, 'index']);
    Route::post('/store', [SectionController::class, 'store'])->middleware('auth:api');
    Route::post('/update/{section}', [SectionController::class, 'update'])->middleware('auth:api');
    Route::delete('/destroy/{section}', [SectionController::class, 'destroy'])->middleware('auth:api');

});


Route::group([
    'middleware' => ['api'],
    'prefix' => 'students'
], function ($router) {
    Route::get('/show/{Studentinfo}', [StudentinfoController::class, 'show']);
    Route::get('/showStudentInfo', [StudentinfoController::class, 'showStudentInfo']);
    Route::get('/index', [StudentinfoController::class, 'index']);
    Route::post('/store', [StudentinfoController::class, 'store']);
    Route::get('/edit', [StudentinfoController::class, 'edit']);
    Route::post('/update/{Studentinfo}', [StudentinfoController::class, 'update']);
    Route::delete('/destroy/{Studentinfo}', [StudentinfoController::class, 'destroy']);
    Route::post('/promotion', [StudentinfoController::class, 'promotion']);
    Route::get('/filterStudents/{grade_id}/{classroom_id}/{section_id}', [StudentinfoController::class, 'filterStudents']);
    Route::get('/filterStudentsName/{name}', [StudentinfoController::class, 'filterStudentsName']);

});


Route::group([
    'middleware' => ['api'],
    'prefix' => 'subjects'
], function ($router) {
    Route::get('/show/{subject}', [SubjectController::class, 'show']);
    Route::get('/index', [SubjectController::class, 'index']);
    Route::post('/store', [SubjectController::class, 'store']);
    Route::post('/update/{subject}', [SubjectController::class, 'update']);
    Route::delete('/destroy/{subject}', [SubjectController::class, 'destroy']);
});


Route::group([
    'middleware' => ['api'],
    'prefix' => 'lessons'
], function ($router) {
    Route::get('/show/{lesson}', [LessonController::class, 'show']);
    Route::get('/index', [LessonController::class, 'index']);
    Route::post('/store', [LessonController::class, 'store']);
    Route::post('/update/{lesson}', [LessonController::class, 'update']);
    Route::delete('/destroy/{lesson}', [LessonController::class, 'destroy']);
});


Route::group([
    'middleware' => ['api'],
    'prefix' => 'exams'
], function ($router) {
    Route::get('/show/{exam}', [ExamController::class, 'show']);
    Route::get('/index', [ExamController::class, 'index']);
    Route::post('/store', [ExamController::class, 'store']);
    Route::post('/update/{exam}', [ExamController::class, 'update']);
    Route::delete('/destroy/{exam}', [ExamController::class, 'destroy']);
    Route::get('/showQuestionsExam/{exam}', [ExamController::class, 'showQuestionsExam']);

});


Route::group([
    'middleware' => ['api'],
    'prefix' => 'questions'
], function ($router) {
    Route::get('/show/{question}', [QuestionController::class, 'show']);
    Route::get('/index', [QuestionController::class, 'index']);
    Route::post('/store', [QuestionController::class, 'store']);
    Route::post('/update/{question}', [QuestionController::class, 'update']);
    Route::delete('/destroy/{question}', [QuestionController::class, 'destroy']);
});


Route::group([
    'middleware' => ['api'],
    'prefix' => 'degrees'
], function ($router) {
    
    Route::get('/show/{degree}', [DegreeController::class, 'show'])->middleware('authTow:api');
    Route::get('/index', [DegreeController::class, 'index']);
    Route::post('/store', [DegreeController::class, 'store']);
    Route::post('/update/{degree}', [DegreeController::class, 'update']);
    Route::post('/endExam', [DegreeController::class, 'endExam']);
    Route::delete('/destroy/{degree}', [DegreeController::class, 'destroy']);
});