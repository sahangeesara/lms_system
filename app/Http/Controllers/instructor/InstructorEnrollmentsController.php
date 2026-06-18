<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InstructorEnrollmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Get all courses belonging to the authenticated instructor
        $courses = Course::where('instructor_id', auth()->id())
            ->with(['lessons' => function($query) {
                $query->orderBy('order', 'asc');
            }])
            ->get();

        // 2. Extract the IDs of these courses to filter enrollments
        $courseIds = $courses->pluck('id');

        // 3. Get enrollments only for this instructor's courses
        $enrollments = Enrollment::whereIn('course_id', $courseIds)
            ->with(['user', 'course'])
            ->latest()
            ->paginate(10);

        return view('instructor.enrollments.index', compact('courses', 'enrollments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        $courses = Course::where('status', 'published')->orderBy('title')->get();
        return view('instructor.enrollments.create', compact('users', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => [
                'required', 'exists:users,id',
                // Prevents breaking the unique compound index migration rule
                Rule::unique('enrollments')->where(fn ($query) => $query->where('course_id', $request->course_id))
            ],
            'course_id' => 'required|exists:courses,id',
            'amount_paid' => 'required|numeric|min:0',
            'status' => 'required|in:active,completed,suspended',
            'is_active' => 'boolean',
            'payment_id' => 'nullable|integer'
        ], [
            'user_id.unique' => 'This user is already enrolled in the selected course.'
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['enrolled_at'] = now();

        if ($validated['status'] === 'completed') {
            $validated['completed_at'] = now();
        } elseif ($validated['status'] === 'suspended') {
            $validated['suspended_at'] = now();
        }

        Enrollment::create($validated);

        return redirect()->route('instructor.enrollments.index')->with('success', 'Student enrolled successfully.');
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
        $enrollment = Enrollment::findOrFail($id);
        $users = User::orderBy('name')->get();
        $courses = Course::orderBy('title')->get();
        return view('instructor.enrollments.edit', compact('enrollment', 'users', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $enrollment = Enrollment::findOrFail($id);

        $validated = $request->validate([
            'user_id' => [
                'required', 'exists:users,id',
                Rule::unique('enrollments')
                    ->where(fn ($query) => $query->where('course_id', $request->course_id))
                    ->ignore($enrollment->id)
            ],
            'course_id' => 'required|exists:courses,id',
            'amount_paid' => 'required|numeric|min:0',
            'status' => 'required|in:active,completed,suspended',
            'is_active' => 'boolean',
            'payment_id' => 'nullable|integer'
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Manage status transitions & conditional dates safely
        if ($validated['status'] === 'completed' && !$enrollment->completed_at) {
            $validated['completed_at'] = now();
            $validated['suspended_at'] = null;
        } elseif ($validated['status'] === 'suspended' && !$enrollment->suspended_at) {
            $validated['suspended_at'] = now();
            $validated['completed_at'] = null;
        } elseif ($validated['status'] === 'active') {
            $validated['completed_at'] = null;
            $validated['suspended_at'] = null;
        }

        $enrollment->update($validated);

        return redirect()->route('instructor.enrollments.index')->with('success', 'Enrollment modified successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();

        return redirect()->route('instructor.enrollments.index')->with('success', 'Enrollment dropped successfully.');
    }
}
