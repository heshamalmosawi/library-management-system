<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    
  
    public function login(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['name' => $validatedData['name'], 'password' => $validatedData['password']])) {
            // Authentication successful, redirect to the desired page
            return redirect('/')->with('success', 'Registration successful!');
        }

        // Authentication failed, throw an exception
        throw ValidationException::withMessages([
            'name' => ['The provided credentials do not match our records.'],
        ]);
    }
}
