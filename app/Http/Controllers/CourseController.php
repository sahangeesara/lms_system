<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    /**
     * Display a listing of the active courses.
     */
    public function index()
    {
        $courses = Course::where('status', 'published')->get();

        // Fetch an array of all course IDs the authenticated user has purchased
        $myEnrollments = [];
        if (Auth::check()) {
            $myEnrollments = Enrollment::where('user_id', Auth::id())
                ->where('is_active', true)
                ->pluck('course_id')
                ->toArray(); // Results in a clean array: [1, 5, 12]
        }

        return view('course', compact('courses', 'myEnrollments'));
    }
    /**
     * Store a newly created course in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title'         => ['required', 'string', 'max:255'],
                'description'   => ['required', 'string'],
                'price'         => ['required', 'numeric', 'min:0'],
                'image'         => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
                'duration'      => ['required', 'integer', 'min:1'],
                'instructor_id' => ['required', 'exists:users,id'],
                'slug'          => ['required', 'string', 'unique:courses,slug'],
                'status'        => ['nullable', 'string', 'in:draft,published'],
            ]);

            // Handle Image Upload File Stream
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/courses'), $imageName);
                $validatedData['image'] = 'uploads/courses/' . $imageName;
            }

            // Clean, dynamic Mass Assignment initialization
            $course = Course::create($validatedData);

            return redirect()->route('student.courses.create')
                ->with('success', "Course '{$course->title}' was successfully compiled into system records.");

        } catch (\Throwable $th) {
            Log::error('Course Storage Engine Pipeline Failure: ' . $th->getMessage(), [
                'exception' => $th,
                'payload'   => $request->except(['image'])
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to save course payload. ' . $th->getMessage()]);
        }
    }

    /**
     * Display the specified course model instance.
     */
    public function show($id)
    {
        $course = Course::with('lessons')->findOrFail($id);

        $myEnrollments = [];
        if (Auth::check()) {
            $myEnrollments = Enrollment::where('user_id', Auth::id())
                ->where('is_active', true)
                ->pluck('course_id')
                ->toArray();
        }

        return view('course', compact('course', 'myEnrollments'));
    }
    /**
     * Update the specified course payload safely.
     */
    public function update(Request $request, string $id)
    {
        try {
            $course = Course::findOrFail($id);

            $validatedData = $request->validate([
                'title'         => ['required', 'string', 'max:255'],
                'description'   => ['required', 'string'],
                'price'         => ['required', 'numeric', 'min:0'],
                'image'         => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
                'duration'      => ['required', 'integer', 'min:1'],
                'instructor_id' => ['required', 'exists:users,id'],
                // FIX: Ignores current course layout row to bypass unique key violation crash vectors
                'slug'          => ['required', 'string', Rule::unique('courses', 'slug')->ignore($course->id)],
                'status'        => ['nullable', 'string', 'in:draft,published'],
            ]);

            if ($request->hasFile('image')) {
                // Optional: Clean up old asset files inside public/uploads/courses here
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/courses'), $imageName);
                $validatedData['image'] = 'uploads/courses/' . $imageName;
            }

            $course->update($validatedData);

            return redirect()->back()
                ->with('success', "Course layout infrastructure changes saved successfully.");

        } catch (\Throwable $th) {
            Log::error('Course Record Matrix Structural Update Failure: ' . $th->getMessage(), [
                'id'        => $id,
                'exception' => $th
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to apply structural matrix updates. ' . $th->getMessage()]);
        }
    }

    /**
     * Deactivate / Soft Delete the specified target element resource.
     */
    public function destroy(string $id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->is_active = false;
            $course->save();

            return redirect()->back()
                ->with('success', "Course entity was safely detached from active operational views.");

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
