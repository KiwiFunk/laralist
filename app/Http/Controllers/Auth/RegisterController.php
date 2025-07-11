<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Import user model
use App\Models\User;

//Import authentication and hashing classes
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Redirect users to the registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle the registration request
    public function register(Request $request)
    {
        // Validate the form data before creating a new user
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user instance and save it to the database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),   //Use Hash facade to hash the password
        ]);

        // Automatically log in the user after registration
        Auth::login($user);

        // Then redirect to the tasks page
        return redirect('/projects');
    }
}