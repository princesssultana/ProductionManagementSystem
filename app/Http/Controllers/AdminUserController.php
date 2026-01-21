<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of admin users
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('pages.admin-user.index', compact('users'));
    }

    /**
     * Show the form for creating a new admin user
     */
    public function create()
    {
        return view('pages.admin-user.create');
    }

    /**
     * Store a newly created admin user in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin-users.index')
            ->with('success', 'Admin user created successfully!');
    }

    /**
     * Display the specified admin user
     */
    public function show(User $adminUser)
    {
        return view('pages.admin-user.show', compact('adminUser'));
    }

    /**
     * Show the form for editing the specified admin user
     */
    public function edit(User $adminUser)
    {
        return view('pages.admin-user.edit', compact('adminUser'));
    }

    /**
     * Update the specified admin user in database
     */
    public function update(Request $request, User $adminUser)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $adminUser->id,
            'role' => 'required|in:admin,user',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $adminUser->name = $validated['name'];
        $adminUser->email = $validated['email'];
        $adminUser->role = $validated['role'];

        if ($request->filled('password')) {
            $adminUser->password = Hash::make($validated['password']);
        }

        $adminUser->save();

        return redirect()->route('admin-users.index')
            ->with('success', 'Admin user updated successfully!');
    }

    /**
     * Remove the specified admin user from database
     */
    public function destroy(User $adminUser)
    {
        $adminUser->delete();

        return redirect()->route('admin-users.index')
            ->with('success', 'Admin user deleted successfully!');
    }
}
