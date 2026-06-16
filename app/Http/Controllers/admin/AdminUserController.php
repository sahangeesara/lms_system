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
    public function index()
    {
        try {
            // 1. Fetch all users from your application database mapping
            $users = User::with('roles')->get();

            info(print_r($users, true));
            // 2. Point to your user management view instead of the courses view
            return view('admin.user.index', compact('users'));

        } catch (\Throwable $th) {
            // Log the structural error cleanly inside storage/logs/laravel.log
            Log::error('Failed to load user management index view: ' . $th->getMessage(), [
                'exception' => $th
            ]);

            return response()->json([
                'message' => 'Failed to fetch users',
                'error' => $th->getMessage()
            ], 500);
        }
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
        try {
            // 1. Corrected to static call logic
            $user = User::findOrFail($id);

            // 2. Bound matching singular variable keys to your View layout
            return view('admin.user.edit', compact('user'));

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


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
            $user = User::findOrFail($id);
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->password = Hash::make($validatedData['password']);
            $user->save();


            $user->assignRole($validatedData['role']);

            // OR if using a custom native tracking column (e.g., users.role):
            // $user->role = $validatedData['role'];
            $user->save();

            // 4. Fire standard Breeze activation events (sends welcome/verification emails)
            event(new Registered($user));

            // 5. Redirect back to your management view with a clean success notification alert
            return redirect()->route('users.index')
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
