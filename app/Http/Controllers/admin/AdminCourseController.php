<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class AdminCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $courses = Course::query()
            ->when($request->search, fn($q, $s) => $q->where('title', 'like', "%{$s}%"))
            ->when($request->status, fn($q, $s) => $q->where('status', $s))
            ->when($request->instructor_id, fn($q, $id) => $q->where('instructor_id', $id))
            ->when($request->price_range, function ($query, $range) {
                // Split the string by '-' to get min and max
                [$min, $max] = explode('-', $range);
                return $query->whereBetween('price', [(float)$min, (float)$max]);
            })
            ->get();

        $instructors = User::whereHas('courses')->get(); // Or fetch all potential instructors

        return view('admin.course.index', compact('courses', 'instructors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            // Change 'instructor' to match your database value exactly 'Instructor'
            $instructors = User::role('Instructor')
                ->orderBy('name', 'asc')
                ->get();

            return view('admin.course.create', [
                'instructors' => $instructors,
                'title'       => 'Create New Course Blueprint'
            ]);

        } catch (\Throwable $th) {
            Log::error('Failed to populate instructor listing within form factory: ' . $th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Could not initialize instructor database records.']);
        }
    }


    /**
     * Store a newly created resource in storage.
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

            return redirect()->route('admin.courses.index')
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
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $course = Course::with('instructor')->findOrFail($id);

            // Fetch your instructor records right here inside your edit method too
            $instructors = User::role('Instructor')->orderBy('name', 'asc')->get();

            return view('admin.course.edit', [
                'course'      => $course,
                'instructors' => $instructors, // Pass it down to avoid undefined variable loops
                'title'       => "Course Details - {$course->title}"
            ]);
        } catch (\Throwable $th) {
            Log::error('Course Record Target Resolution Error: ' . $th->getMessage());
            return redirect()->route('admin.courses.index')->withErrors(['error' => 'Record not found.']);
        }
    }
    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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
