<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
class InstructorLessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // This query fetches lessons where the related course's instructor_id
            // matches the currently authenticated user's ID.
            $lessons = Lesson::whereHas('course', function ($query) {
                $query->where('instructor_id', auth()->id());
            })
                ->with('course') // Eager load the course to avoid N+1 queries
                ->orderBy('course_id', 'asc')
                ->orderBy('order', 'asc')
                ->get();

            return view('instructor.lessons.index', [
                'lessons' => $lessons,
                'title'   => 'Curriculum Lessons Ledger'
            ]);

        } catch (\Throwable $th) {
            Log::error('Failed to fetch lessons inside index(): ' . $th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to load curriculum workspace catalog.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $courses = Course::where('instructor_id', auth()->id())
                ->where('is_active', true)
                ->orderBy('title', 'asc')->get();

            if ($courses->isEmpty()) {
                return redirect()->back()->withErrors([
                    'error' => 'No courses available. Please create a course before adding lessons.'
                ]);
            }

            // DOUBLE-CHECK: Ensure this folder path matches your view file perfectly
            return view('instructor.lessons.create', [
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

            return redirect()->route('instructor.lessons.index')
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
            return view('instructor.lessons.edit', [
                'lesson'  => $lesson,
                'courses' => $courses,
                'title'   => "Edit Lesson - {$lesson->title}"
            ]);

        } catch (\Throwable $th) {
            Log::error('Lesson Asset Edit Resolution Failure: ' . $th->getMessage(), [
                'id'        => $id,
                'exception' => $th
            ]);

            return redirect()->route('instructor.lessons.index')
                ->withErrors(['error' => 'The targeted lesson record could not be found in system schemas.']);
        }
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $lesson = Lesson::findOrFail($id);

        try {
            $validatedData = $request->validate([
                'course_id' => ['required', 'exists:courses,id'],
                'title'     => ['required', 'string', 'max:255'],
                'slug'      => ['required', 'string', 'max:255', 'unique:lessons,slug,' . $lesson->id],
                'content'   => ['nullable', 'string'],
                'video_url' => ['nullable', 'url', 'max:255'],
                'order'     => ['required', 'integer', 'min:0'],
            ]);

            $validatedData['is_active'] = $request->has('is_active');

            // Sanitize content and wrap in JSON structure
            $cleanContent = trim($request->input('content', ''));
            $validatedData['content'] = json_encode(['body' => $cleanContent]);

            DB::transaction(function () use ($lesson, $validatedData) {
                $lesson->update($validatedData);
            });

            return redirect()->route('instructor.lessons.index')
                ->with('success', "Lesson '{$lesson->title}' has been successfully updated.");

        } catch (ValidationException $e) {
            // This will now show you EXACTLY which field failed
            Log::error('Validation Failed: ', $e->errors());
            return redirect()->back()->withErrors($e->errors())->withInput();

        } catch (\Throwable $th) {
            Log::error('General Update Failure: ' . $th->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to apply modifications.']);
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
