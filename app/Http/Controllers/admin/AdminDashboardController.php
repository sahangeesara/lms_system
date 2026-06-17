<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Query basic user-role splits and total course assets
        $students_count = User::role('student')->count();
        $instructors_count = User::role('instructor')->count();
        $courses_count = Course::count();

        return view('admin.page.dashboard', compact(
            'students_count',
            'instructors_count',
            'courses_count'
        ));
    }
}
