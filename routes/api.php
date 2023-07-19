<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\API\ClassRoomController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\EnrollmentController;
use App\Http\Controllers\API\GradeController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\TeacherController;
use App\Http\Controllers\API\UserController;

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

Route::post('login', [AuthController::class, 'login']);
// Route::post('register', [AuthController::class, 'register']);

Route::get('user', [UserController::class, 'index']);
Route::get('student', [StudentController::class, 'index']);
Route::get('teacher', [TeacherController::class, 'index']);
Route::get('class-room', [ClassRoomController::class, 'index']);
Route::get('course', [CourseController::class, 'index']);
Route::get('enrollment', [EnrollmentController::class, 'index']);
Route::get('schedule', [EnrollmentController::class, 'index']);
Route::get('attendance', [AttendanceController::class, 'index']);
Route::get('grade', [GradeController::class, 'index']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::post('password/{id}', [AuthController::class, 'changePassword']);

    Route::get('user/{id}', [UserController::class, 'show']);
    Route::post('user', [UserController::class, 'store']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);

    Route::get('student/{id}', [StudentController::class, 'show']);
    Route::post('student', [StudentController::class, 'store']);
    Route::put('student/{id}', [StudentController::class, 'update']);
    Route::delete('student/{id}', [StudentController::class, 'destroy']);

    Route::get('teacher/{id}', [TeacherController::class, 'show']);
    Route::post('teacher', [TeacherController::class, 'store']);
    Route::put('teacher/{id}', [TeacherController::class, 'update']);
    Route::delete('teacher/{id}', [TeacherController::class, 'destroy']);

    Route::get('class-room/{id}', [ClassRoomController::class, 'show']);
    Route::post('class-room', [ClassRoomController::class, 'store']);
    Route::put('class-room/{id}', [ClassRoomController::class, 'update']);
    Route::delete('class-room/{id}', [ClassRoomController::class, 'destroy']);

    Route::get('course/{id}', [CourseController::class, 'show']);
    Route::post('course', [CourseController::class, 'store']);
    Route::put('course/{id}', [CourseController::class, 'update']);
    Route::delete('course/{id}', [CourseController::class, 'destroy']);


    Route::get('enrollment/{id}', [EnrollmentController::class, 'show']);
    Route::post('enrollment', [EnrollmentController::class, 'store']);
    Route::put('enrollment/{id}', [EnrollmentController::class, 'update']);
    Route::delete('enrollment/{id}', [EnrollmentController::class, 'destroy']);

    Route::get('schedule/{id}', [EnrollmentController::class, 'show']);
    Route::post('schedule', [EnrollmentController::class, 'store']);
    Route::put('schedule/{id}', [EnrollmentController::class, 'update']);
    Route::delete('schedule/{id}', [EnrollmentController::class, 'destroy']);

    Route::get('attendance/{id}', [AttendanceController::class, 'show']);
    Route::post('attendance', [AttendanceController::class, 'store']);
    Route::put('attendance/{id}', [AttendanceController::class, 'update']);
    Route::delete('attendance/{id}', [AttendanceController::class, 'destroy']);

    Route::get('grade/{id}', [GradeController::class, 'show']);
    Route::post('grade', [GradeController::class, 'store']);
    Route::put('grade/{id}', [GradeController::class, 'update']);
    Route::delete('grade/{id}', [GradeController::class, 'destroy']);
});