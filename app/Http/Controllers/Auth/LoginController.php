<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    /**
     * Display the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Get the email and password from the request
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user using the email and password fields
        $user = User::where('email', $credentials['email'])->first();

        // Check if the user exists and verify the password
        if ($user && Hash::check($credentials['password'], $user->hashed_pass)) {
            // Log in the user using the Auth facade
            Auth::login($user);

            // Redirect to the intended page or home if not intended
            return redirect()->intended('/');
        }

        // If authentication fails, return an error message
        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
