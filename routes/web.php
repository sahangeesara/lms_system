<?php

use App\Http\Controllers\admin\AdminCourseController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\AdminEnrollmentsController;
use App\Http\Controllers\admin\AdminLessonController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\AdminCourseController2;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentsController;
use App\Http\Controllers\instructor\InstructorCourseController;
use App\Http\Controllers\instructor\InstructorDashboardController;
use App\Http\Controllers\instructor\InstructorEnrollmentsController;
use App\Http\Controllers\instructor\InstructorLessonController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

// Public Guest Root Landing Page
Route::get('/', function () {
    return view('welcome');
});

// =========================================================================
// STANDARD USER STUDENT PORTAL ROUTES
// =========================================================================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/course', function () { return view('course'); })->name('course');
    Route::get('/lesson', function () { return view('lessons'); })->name('lesson');
    Route::get('/enrollment', function () { return view('enrollments'); })->name('enrollment');
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
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('/users', AdminUserController::class);

        Route::get('/user/create',function (){
            return view('admin.user.create');
        } )->name('user.create');
        Route::get('/user/edit',function (){
            return view('admin.user.edit');
        } )->name('user.edit');




        // Course Management
        Route::resource('/courses', AdminCourseController::class);

        Route::get('/course/create',function (){
            return view('admin.course.create');
        } )->name('course.create');

        Route::get('/courses/edit',function (){
            return view('admin.course.edit');
        } )->name('courses.edit');

        Route::resource('/lessons', AdminLessonController::class);
        Route::resource('/enrollments', AdminEnrollmentsController::class);

        Route::get('/lessons/edit', function () {
            return view('admin.lessons.edit');
        })->name('lessons.edi');

        // Enrollment Pipelines

        // Structural Testing Layout Anchor
        Route::get('/side-navbar', function () {
            return view('layouts.side_navbar');
        })->name('side_navbar');
    });

// =========================================================================
// ADDITIONAL ROLE SPECIFIC DASHBOARDS
// =========================================================================
Route::middleware(['auth', 'role_or:instructor|admin'])
    ->prefix('instructor')
    ->name('instructor.')
    ->group(function () {
        Route::get('/dashboard', [InstructorDashboardController::class,'index'])->name('dashboard');
        Route::resource('/courses', InstructorCourseController::class);
        Route::resource('/lessons', InstructorLessonController::class);
        Route::resource('/enrollments', InstructorEnrollmentsController::class);

    });

Route::middleware(['auth', 'role_or:student|admin'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::resource('/courses', CourseController::class);
    Route::resource('/lessons', LessonController::class);
    Route::resource('/enrollments', EnrollmentsController::class);

    Route::get('/lessons/{slug}', [LessonController::class, 'show'])->name('lessons.show');

        Route::get('/enrollments', [EnrollmentsController::class, 'enrollments'])->name('enrollments.index');
        // Change the URI parameter string from '/payment/checkout' to just '/checkout'
        Route::post('/checkout', [StripeController::class, 'checkout'])->name('payment.checkout');

        // If you want your success and cancel pages to match, drop the '/payment' here too:
        Route::get('/checkout/success', [StripeController::class, 'success'])->name('payment.success');
        Route::get('/checkout/cancel', [StripeController::class, 'cancel'])->name('payment.cancel');

        Route::get('/lessons/{slug}', [LessonController::class, 'show'])->name('lessons.show');
});

require __DIR__.'/auth.php';
