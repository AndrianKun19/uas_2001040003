<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WEB\AuthController;
use App\Http\Controllers\WEB\ClassRoomController;
use App\Http\Controllers\WEB\CourseController;
use App\Http\Controllers\WEB\EnrollmentController;
use App\Http\Controllers\WEB\LevelController;
use App\Http\Controllers\WEB\SemesterController;
use App\Http\Controllers\WEB\StudentController;
use App\Http\Controllers\WEB\TeacherController;
use App\Http\Controllers\WEB\UserController;

// Route::get('/', function () {
//     return view('landing-pages.login');
// })->name('landing');


// Route::get('/login', [AuthController::class, 'index'])->name('login.index');
// Route::post('/login', [AuthController::class, 'login'])->name('login');
// Route::put('/change-password/{id}', [AuthController::class, 'changePassword'])->name('changePassword');
// Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/user/show', [UserController::class, 'index'])->name('user.index');
//     Route::get('/user/add-form', [UserController::class, 'create'])->name('user.create');
//     Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
//     Route::get('/user/{id}/edit-form', [UserController::class, 'edit'])->name('user.edit');
//     Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
//     Route::delete('/user/{id}/delete-form', [UserController::class, 'destroy'])->name('user.destroy');
//     Route::get('/user/search', [UserController::class, 'search'])->name('user.search');
    
//     Route::get('/student/show', [StudentController::class, 'index'])->name('student.index');
//     Route::get('/student/{student_code}/settings', [StudentController::class, 'show'])->name('student.settings');
//     Route::get('/student/add-form', [StudentController::class, 'create'])->name('student.create');
//     Route::post('/student/store', [StudentController::class, 'store'])->name('student.store');
//     Route::get('/student/{id}/edit-form', [StudentController::class, 'edit'])->name('student.edit');
//     Route::put('/student/{id}/update', [StudentController::class, 'update'])->name('student.update');
//     Route::delete('/student/{id}/delete-form', [StudentController::class, 'destroy'])->name('student.destroy');
//     Route::get('/student/search', [StudentController::class, 'search'])->name('student.search');
    
//     Route::get('/teacher/show', [TeacherController::class, 'index'])->name('teacher.index');
//     Route::get('/teacher/{teacher_code}/settings', [TeacherController::class, 'show'])->name('teacher.settings');
//     Route::get('/teacher/add-form', [TeacherController::class, 'create'])->name('teacher.create');
//     Route::post('/teacher/store', [TeacherController::class, 'store'])->name('teacher.store');
//     Route::get('/teacher/{id}/edit-form', [TeacherController::class, 'edit'])->name('teacher.edit');
//     Route::put('/teacher/{id}/update', [TeacherController::class, 'update'])->name('teacher.update');
//     Route::delete('/teacher/{id}/delete-form', [TeacherController::class, 'destroy'])->name('teacher.destroy');
    
//     Route::get('/course/show', [CourseController::class, 'index'])->name('course.index');
//     Route::get('/course/add-form', [CourseController::class, 'create'])->name('course.create');
//     Route::post('/course/store', [CourseController::class, 'store'])->name('course.store');
//     Route::get('/course/{id}/edit-form', [CourseController::class, 'edit'])->name('course.edit');
//     Route::put('/course/{id}/update', [CourseController::class, 'update'])->name('course.update');
//     Route::delete('/course/{id}/delete-form', [CourseController::class, 'destroy'])->name('course.destroy');
    
//     Route::get('/class-room/show', [ClassRoomController::class, 'index'])->name('class-room.index');
//     Route::get('/class-room/add-form', [ClassRoomController::class, 'create'])->name('class-room.create');
//     Route::post('/class-room/store', [ClassRoomController::class, 'store'])->name('class-room.store');
//     Route::get('/class-room/{id}/edit-form', [ClassRoomController::class, 'edit'])->name('class-room.edit');
//     Route::put('/class-room/{id}/update', [ClassRoomController::class, 'update'])->name('class-room.update');
//     Route::delete('/class-room/{id}/delete-form', [ClassRoomController::class, 'destroy'])->name('class-room.destroy');
//     Route::get('/class-room/search', [ClassRoomController::class, 'search'])->name('class-room.search');

//     Route::get('/level/show', [LevelController::class, 'index'])->name('level.index');
//     Route::get('/level/add-form', [LevelController::class, 'create'])->name('level.create');
//     Route::post('/level/store', [LevelController::class, 'store'])->name('level.store');
//     Route::get('/level/{id}/edit-form', [LevelController::class, 'edit'])->name('level.edit');
//     Route::put('/level/{id}/update', [LevelController::class, 'update'])->name('level.update');
//     Route::delete('/level/{id}/delete-form', [LevelController::class, 'destroy'])->name('level.destroy');

//     Route::get('/semester/show', [SemesterController::class, 'index'])->name('semester.index');
//     Route::get('/semester/add-form', [SemesterController::class, 'create'])->name('semester.create');
//     Route::post('/semester/store', [SemesterController::class, 'store'])->name('semester.store');
//     Route::get('/semester/{id}/edit-form', [SemesterController::class, 'edit'])->name('semester.edit');
//     Route::put('/semester/{id}/update', [SemesterController::class, 'update'])->name('semester.update');
//     Route::delete('/semester/{id}/delete-form', [SemesterController::class, 'destroy'])->name('semester.destroy');
    
//     Route::get('/enrollment/{id}/show', [EnrollmentController::class, 'index'])->name('enrollment.index');
//     Route::get('/enrollment/{id}/add-form', [EnrollmentController::class, 'create'])->name('enrollment.create');
// });