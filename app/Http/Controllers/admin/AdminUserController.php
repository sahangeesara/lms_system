<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request->role, function ($query, $role) {
                $query->whereHas('roles', fn($q) => $q->where('name', $role));
            })
            ->get();

        return view('admin.user.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // 1. Validate incoming data matching your Breeze schema + roles
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role' => ['required', 'string', 'in:admin,instructor,student'], // Adjust role values to match your system
            ]);

            // 2. Create the User Record explicitly
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            $user->assignRole($validatedData['role']);

            event(new Registered($user));

            return redirect()->route('admin.users.store')
                ->with('success', "User account for {$user->name} created successfully.");

        } catch (\Throwable $th) {
            // Capture anomalies safely inside storage/logs/laravel.log
            Log::error('Admin User Management Creation Failure: ' . $th->getMessage(), [
                'exception' => $th,
                'payload' => $request->except(['password', 'password_confirmation'])
            ]);

            return redirect()->back()
                ->withInput($request->except(['password', 'password_confirmation']))
                ->withErrors(['error' => 'Failed to process user creation pipeline. ' . $th->getMessage()]);
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
            // 1. Find the specific user profile or throw a 404 if they don't exist
            $accountUser = User::with('roles')->findOrFail($id);

            // 2. Pass the exact variable name down to the edit blade layout
            return view('admin.user.edit', [
                'accountUser' => $accountUser, // This key name MUST match $accountUser in your blade file
                'title'       => "Edit User - {$accountUser->name}"
            ]);

        } catch (\Throwable $th) {
            Log::error('User Edit Profile Resolution Failure: ' . $th->getMessage(), [
                'id'        => $id,
                'exception' => $th
            ]);

            return redirect()->route('admin.users.index')
                ->withErrors(['error' => 'The requested user profile could not be found.']);
        }
    }    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role'     => 'required|in:Admin,Instructor,Student',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Update password only if the field was filled out
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Sync roles cleanly via Spatie
        $user->syncRoles([$validated['role']]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // 1. Corrected to static call logic
            $user = User::findOrFail($id);
            $user->is_active = false;
            $user->save();

            // 2. Bound matching singular variable keys to your View layout
            return view('admin.page.user', compact('user'));

        } catch (\Throwable $th) {
            // Captures the full error trace silently for background analysis
            Log::error("Failed to fetch user instance ID [{$id}] inside Controller: " . $th->getMessage(), [
                'exception' => $th
            ]);

            return response()->json([
                'message' => 'Failed to fetch users',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
