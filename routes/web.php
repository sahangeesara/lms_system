<?php

use App\Http\Controllers\admin\AdminCourseController;
use App\Http\Controllers\admin\AdminLessonController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\AdminCourseController2;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public Guest Root Landing Page
Route::get('/', function () {
    return view('welcome');
});

// =========================================================================
// STANDARD USER STUDENT PORTAL ROUTES
// =========================================================================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/course', function () { return view('course'); })->name('course');
    Route::get('/lesson', function () { return view('lesson'); })->name('lesson');
    Route::get('/enrollment', function () { return view('enrollment'); })->name('enrollment');
});

// Profile Editing Pipeline Management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========================================================================
// ADMINISTRATOR ROLES PANEL MATRIX (Prefix group sets up named references automatically)
// =========================================================================
Route::middleware(['auth', 'verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Core Admin Dashboard
        Route::get('/dashboard', function () {
            return view('admin.page.dashboard');
        })->name('dashboard');


        Route::resource('/users', AdminUserController::class);

        Route::get('/user/create',function (){
            return view('admin.user.create');
        } )->name('user.create');
        Route::get('/user/edit',function (){
            return view('admin.user.edit');
        } )->name('user.edit');




        // Course Management
        Route::resource('/courses', AdminCourseController::class);
        Route::resource('/lesson', AdminLessonController::class);

        Route::get('/course/create',function (){
            return view('admin.course.create');
        } )->name('course.create');

        Route::get('/courses/edit',function (){
            return view('admin.course.edit');
        } )->name('courses.edit');

        // Lesson Configuration
        Route::get('/lessons', function () {
            return "Admin Lessons";
        })->name('lessons.index');

        // Enrollment Pipelines
        Route::get('/enrollments', function () {
            return "Admin Enrollments";
        })->name('enrollments.index');



        // Structural Testing Layout Anchor
        Route::get('/side-navbar', function () {
            return view('layouts.side_navbar');
        })->name('side_navbar');
    });

// =========================================================================
// ADDITIONAL ROLE SPECIFIC DASHBOARDS
// =========================================================================
Route::middleware(['auth', 'role:instructor'])->group(function () {
    Route::get('/instructor/dashboard', function () {
        return "Instructor Dashboard";
    });
});

Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
    Route::get('/dashboard', function () {
        return "Student Dashboard";
    });
    Route::resource('/courses', CourseController::class);

});

require __DIR__.'/auth.php';
