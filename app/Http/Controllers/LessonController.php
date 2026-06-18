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
        // 1. Handle Mock Lessons
        if (str_starts_with($lesson, 'no-lessons-')) {
            $courseId = str_replace('no-lessons-', '', $lesson);
            $course = Course::findOrFail($courseId);
            $this->checkEnrollmentAccess($course->id);

            $body = trim(__('The instruction material for this course is currently under assembly. Please check back later!'));

            $mockLesson = new Lesson([
                'title' => __('Curriculum Workspace Pending'),
                'order' => 0,
                'video_url' => null,
                'content' => json_encode(['body' => $body])
            ]);
            $mockLesson->course = $course;

            // Fetch empty or limited sidebar for pending courses
            $allLessons = collect([]);

            return view('lessons', ['lesson' => $mockLesson, 'allLessons' => $allLessons]);
        }

        // 2. Standard Lesson Lookup
        $lessonData = Lesson::with('course')->where('slug', $lesson)->firstOrFail();
        $this->checkEnrollmentAccess($lessonData->course_id);

        // Sanitize content
        if (!empty($lessonData->content)) {
            $decoded = json_decode($lessonData->content, true);
            if (is_array($decoded) && isset($decoded['body'])) {
                $decoded['body'] = trim($decoded['body']);
                $lessonData->content = json_encode($decoded);
            }
        }

        // Fetch sidebar lessons for the current course
        $allLessons = Lesson::where('course_id', $lessonData->course_id)
            ->orderBy('order', 'asc')
            ->get();

        return view('lessons', [
            'lesson'     => $lessonData,
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
