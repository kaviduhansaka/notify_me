<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required', // ⚠️ In real use, hash the password
            'phone_number' => 'required',
            'email' => 'required|email',
        ]);

        $result = Register::registerUser($data);

        if (isset($result['error'])) {
            return back()->withErrors(['error' => $result['error']])->withInput();
        }

        return redirect()->back()->with('success', 'Registration successful!');
    }
}
