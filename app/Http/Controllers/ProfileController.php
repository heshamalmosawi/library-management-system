<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function showProfileForm()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => [
                'nullable',
                'string',
                'max:25',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'email' => [
                'nullable',
                'string',
                'email',
                'max:30',
                'unique:users,email,' . $user->id,
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]{3,10}\.[a-zA-Z]{2,4}$/',
            ],
            'contact_no' => [
                'nullable',
                'string',
                'digits:8',
                'unique:users,contact_no,' . $user->id,
                'regex:/^(3|6|1)/',
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'max:20',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[_#@$%\*\-])(?=.*[0-9])[A-Za-z0-9_#@%\*\-]+$/',
            ],
        ]);

        // Update only the fields that are filled
        if ($request->filled('name')) {
            $user->name = $request->name;
        }
        if ($request->filled('email')) {
            $user->email = $request->email;
        }
        if ($request->filled('contact_no')) {
            $user->contact_no = $request->contact_no;
        }
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully');
    }
}

