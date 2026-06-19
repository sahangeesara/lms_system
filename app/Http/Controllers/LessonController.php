<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // FIXED: Removed the is_active constraint so admins can see all records, and pluralized the assignment variable
            $lessons = Lesson::with('course')
                ->orderBy('course_id', 'asc')
                ->orderBy('order', 'asc')
                ->get();

            return view('lessons', [
                'lessons' => $lessons,
                'title'   => 'Curriculum Lessons Ledger'
            ]);

        } catch (\Throwable $th) {
            Log::error('Failed to fetch lessons inside index(): ' . $th->getMessage(), [
                'exception' => $th
            ]);

            return redirect()->back()->withErrors([
                'error' => 'Failed to load curriculum workspace catalog.'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($lesson)
    {
        // Laravel has already performed the lookup by slug automatically!

        // Check enrollment
        $this->checkEnrollmentAccess($lesson->course_id);

        // Fetch sidebar
        $allLessons = Lesson::where('course_id', $lesson->course_id)
            ->orderBy('order', 'asc')
            ->get();

        return view('lessons', [
            'lesson'     => $lesson,
            'allLessons' => $allLessons
        ]);


    }
    private function checkEnrollmentAccess($courseId)
    {
        $hasAccess = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $courseId)
            ->where('is_active', true)
            ->exists();

        if (!$hasAccess) {
            abort(403, 'Access locked. Please enroll to view this curriculum workspace module.');
        }
    }
  /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
