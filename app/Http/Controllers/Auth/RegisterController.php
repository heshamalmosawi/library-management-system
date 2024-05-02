<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function ShowRegistrationForm(){
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:25',
            'email' => 'required|string|email|max:20|unique:users',
            'password' => 'required|string|min:8',
            'phone'    => 'required|string|digits:8|unique:users',
        ]);
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->hashed_pass = Hash::make($request->password);
        $user->contact_no = $request->phone;
        $user->save();

        // You may also want to log the user in after registration

        return redirect('/')->with('success', 'Registration successful!');
    }

}
