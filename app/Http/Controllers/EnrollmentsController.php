<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class EnrollmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch only the logged-in user's enrollments along with course info
        $enrollments = Enrollment::with('course')
            ->where('user_id', Auth::id())
            ->latest('enrolled_at')
            ->paginate(6);

        return view('enrollments', compact('enrollments'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function enrollments()
    {
        // Fetch enrollments and eager load parent course + sequential content models
        $enrollments = Enrollment::with(['course.lessons' => function($query) {
            $query->orderBy('order', 'asc');
        }])
            ->where('user_id', Auth::id())
            ->paginate(6);

        return view('enrollments', compact('enrollments'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => [
                'required',
                'exists:courses,id',
                // Enforce unique user+course compound index constraint gracefully
                Rule::unique('enrollments')->where(fn ($query) => $query->where('user_id', Auth::id()))
            ],
            'amount_paid' => 'required|numeric|min:0',
        ], [
            'course_id.unique' => 'You are already enrolled in this curriculum track!'
        ]);

        Enrollment::create([
            'user_id'     => Auth::id(),
            'course_id'   => $request->course_id,
            'amount_paid' => $request->amount_paid,
            'enrolled_at' => now(),
            'status'      => 'active',
            'is_active'   => true,
        ]);

        return redirect()->route('student.courses.index')->with('success', 'Successfully registered into your masterclass!');
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
