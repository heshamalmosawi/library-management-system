<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function ShowRegistrationForm(){
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:25',
                'regex:/^[a-zA-Z\s]+$/', // Only allows letters and spaces
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:30',
                'unique:users',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]{3,10}\.[a-zA-Z]{2,4}$/', // Email format
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[_#@$%\*\-])(?=.*[0-9])[A-Za-z0-9_#@%\*\-]+$/', // At least one uppercase, one lowercase, one digit, one special character
            ],
            'phone' => [
                'required',
                'string',
                'digits:8',
                'unique:users',
                'regex:/^(3|6|1)/', // Phone number starts with 3, 6, or 1
            ],
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

    public function ShowRegistrationFormstaff(){
        return view('addstaff');
    }

    public function RegisterStaff(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:25',
                'regex:/^[a-zA-Z\s]+$/', // Only allows letters and spaces
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:30',
                'unique:users',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]{3,10}\.[a-zA-Z]{2,4}$/', // Email format
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[_#@$%\*\-])(?=.*[0-9])[A-Za-z0-9_#@%\*\-]+$/', // At least one uppercase, one lowercase, one digit, one special character
            ],
            'phone' => [
                'required',
                'string',
                'digits:8',
                'unique:users',
                'regex:/^(3|6|1)/', // Phone number starts with 3, 6, or 1
            ],
        ]);
        
        
        $staff = new Staff();
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->hashed_pass = Hash::make($request->password);
        $staff->contact_no = $request->phone;
        $staff->save();

        // You may also want to log the user in after registration

        return redirect('/')->with('success', 'Add Staff successful!');
    }

    public function addAdmin(){
        $staff = new Staff();
        $staff->name = "Sayed Hesham";
        $staff->email = "heshamo12@gmail.com";
        $staff->hashed_pass = Hash::make("Hesham12345-");
        $staff->contact_no = 37733995;
        $staff->save();
    }
}
