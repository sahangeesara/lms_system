<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminLessonController extends Controller
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

            return view('admin.lessons.index', [
                'lessons' => $lessons, // FIXED: Changed key from 'lesson' to 'lessons'
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
        try {
            $courses = Course::orderBy('title', 'asc')->get();

            if ($courses->isEmpty()) {
                return redirect()->back()->withErrors([
                    'error' => 'No courses available. Please create a course before adding lessons.'
                ]);
            }

            // DOUBLE-CHECK: Ensure this folder path matches your view file perfectly
            return view('admin.lessons.create', [
                'courses' => $courses,
                'title'   => 'Create Lesson'
            ]);

        } catch (\Throwable $th) {
            Log::error('Failed to verify course availability for lesson creation: ' . $th->getMessage());
            return redirect()->back()->withErrors([
                'error' => 'Could not verify course availability.'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // 1. Validate strictly against your lessons table migration constraints
            $validatedData = $request->validate([
                'course_id' => ['required', 'exists:courses,id'],
                'title'     => ['required', 'string', 'max:255'],
                'slug'      => ['required', 'string', 'max:255', 'unique:lessons,slug'],
                'content'   => ['nullable', 'string'],
                'video_url' => ['nullable', 'url', 'max:255'],
                'order'     => ['required', 'integer', 'min:0'],
                'is_active' => ['nullable', 'boolean'], // FIXED: Re-introduced the visibility validation constraint
            ]);

            // 2. Handle boolean formatting for checkboxes (since unchecked checkboxes don't send data)
            $validatedData['is_active'] = $request->has('is_active');

            // 3. Handle text content transformation into valid structured JSON string format
            $validatedData['content'] = json_encode([
                'body' => $request->input('content') ?? ''
            ]);

            // 4. Create the Lesson record using the correct Model target
            $lesson = Lesson::create($validatedData);

            return redirect()->route('admin.lessons.index')
                ->with('success', "Lesson '{$lesson->title}' was successfully deployed to the curriculum ledger.");

        } catch (\Throwable $th) {
            Log::error('Lesson Storage Engine Pipeline Failure: ' . $th->getMessage(), [
                'exception' => $th,
                'payload'   => $request->all()
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to persist lesson payload. ' . $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            // 1. Fetch the target lesson with its current parent course relationship attached
            $lesson = Lesson::with('course')->findOrFail($id);

            // 2. Fetch all alternative target courses to populate the view's selection dropdown matrix
            $courses = Course::orderBy('title', 'asc')->get();

            // 3. Return the specific curriculum view with its mapped payload dependencies
            return view('admin.lessons.edit', [
                'lesson'  => $lesson,
                'courses' => $courses,
                'title'   => "Edit Lesson - {$lesson->title}"
            ]);

        } catch (\Throwable $th) {
            Log::error('Lesson Asset Edit Resolution Failure: ' . $th->getMessage(), [
                'id'        => $id,
                'exception' => $th
            ]);

            return redirect()->route('admin.lessons.index')
                ->withErrors(['error' => 'The targeted lesson record could not be found in system schemas.']);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // 1. Find the target model row instance explicitly
            $lesson = Lesson::findOrFail($id);

            // 2. Validate incoming dataset fields against the schema rule criteria sets
            $validatedData = $request->validate([
                'course_id' => ['required', 'exists:courses,id'],
                'title'     => ['required', 'string', 'max:255'],
                'slug'      => ['required', 'string', 'max:255', 'unique:lessons,slug,' . $lesson->id],
                'content'   => ['nullable', 'string'],
                'video_url' => ['nullable', 'url', 'max:255'],
                'order'     => ['required', 'integer', 'min:0'],
            ]);

            // 3. Parse and format stateful structural checkbox switches explicitly
            $validatedData['is_active'] = $request->has('is_active');

            // 4. Formulate raw textarea text string values cleanly into target JSON blocks
            $validatedData['content'] = json_encode([
                'body' => $request->input('content') ?? ''
            ]);

            // 5. Update database rows safely via model data assignment
            $lesson->update($validatedData);

            return redirect()->route('admin.lessons.index')
                ->with('success', "Lesson '{$lesson->title}' has been successfully modified within system data clusters.");

        } catch (\Throwable $th) {
            Log::error('Lesson Update Pipeline Engine Exception: ' . $th->getMessage(), [
                'id'        => $id,
                'exception' => $th,
                'payload'   => $request->all()
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to apply lesson modifications. ' . $th->getMessage()]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $course = Lesson::findOrFail($id);
            $course->is_active = false;
            $course->save();

            return redirect()->back()
                ->with('success', "Lesson entity was safely detached from active operational views.");

        } catch (\Throwable $th) {
            Log::error('Course State Transition Deactivation Drop Failure: ' . $th->getMessage(), [
                'id'        => $id,
                'exception' => $th
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'Deactivation routine execution dropped.']);
        }
    }
}
