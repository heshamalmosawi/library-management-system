<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Staff;
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
            session(['id' => $user->user_id,'name'=>$user->name, 'userType'=>"student",'is_admin'=>false]);
            return redirect('/')->with('success', 'Login successful');
        }
        $staffUser = Staff::where('email', $credentials['email'])->first();
        if ($staffUser && Hash::check($credentials['password'], $staffUser->hashed_pass)){
            Auth::login($staffUser);
            if ($staffUser->is_admin)
            {
                session(['id' => $staffUser->staff_id,'name'=>$staffUser->name, 'userType'=>"staff",'is_admin'=>true]);
            }else
            {
                session(['id' => $staffUser->staff_id,'name'=>$staffUser->name, 'userType'=>"staff",'is_admin'=>false]);
            }
           
            return redirect('/')->with('success', 'Login successful');
        }
        // If authentication fails, return an error message
        throw ValidationException::withMessages([
            'email' => 'Email address or Password not found. Please try again.',
        ]);
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->flush();
        return redirect('/')->with('success', 'Log out successful!');
    }
}
