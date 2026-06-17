<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. System-wide course count
        $total_courses_count = Course::count();

        // 2. Personal enrollment count
        $enrolled_count = Enrollment::where('user_id', $userId)->count();

        // 3. Total lessons in enrolled courses
        $total_lessons_count = DB::table('lessons')
            ->whereIn('course_id', function ($query) use ($userId) {
                $query->select('course_id')->from('enrollments')->where('user_id', $userId);
            })->count();
//
//        // 4. Calculate completed lessons for this user
//        // NOTE: Adjust the table/query below to match your database schema
//        $completed_lessons_count = DB::table('lesson_completions')
//            ->where('user_id', $userId)
//            ->count();
//
//        // 5. Overall progress calculation
//        $overall_progress = $total_lessons_count > 0
//            ? round(($completed_lessons_count / $total_lessons_count) * 100)
//            : 0;

        return view('dashboard', [
            'total_courses_count' => $total_courses_count,
            'enrolled_count'      => $enrolled_count,
            'total_lessons_count' => $total_lessons_count,
//            'overall_progress'    => $overall_progress, // Ensure this is passed
        ]);
    }
}
