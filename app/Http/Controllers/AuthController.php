<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login process
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Check if the user exists and if the password matches
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Check if the user is an admin
            if ($user->is_admin) {
                Auth::login($user); // Log the admin in
                return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
            } else {
                Auth::login($user); // Log the regular user in
                return redirect()->route('user.dashboard'); // Redirect to user dashboard
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Log the user out
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login'); // Redirect to login page after logout
    }

    // Admin Dashboard
    public function dashboard()
    {
        return view('admin.dashboard'); // Return the admin dashboard view
    }

    // User Dashboard (can be used for regular users as well)
    public function userDashboard()
    {
        return view('user.dashboard'); // Return the user dashboard view
    }
}
