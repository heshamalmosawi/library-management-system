<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    
    /**
     * Handle a login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
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
            return redirect()->intended('/main');
        }

        // Authentication failed, throw an exception
        throw ValidationException::withMessages([
            'name' => ['The provided credentials do not match our records.'],
        ]);
    }
}

