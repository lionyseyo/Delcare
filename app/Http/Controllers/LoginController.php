<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Please fill out this field.',
            'password.required' => 'Please fill out this field.',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            $user = Auth::user();
            if ($user->role == 'user') {
                return redirect()->route('user');
            }
        } elseif (Auth::guard('admin')->attempt($infologin)) {
            $admin = Auth::guard('admin')->user();
            if ($admin->role == 'duktek') {
                return redirect()->route('dashboard');
            } elseif ($admin->role == 'maintenance') {
                return redirect()->route('dashboard');
            }
        } else {
            return redirect()->back()->withErrors('Username dan password yang dimasukkan tidak sesuai')->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login'); // Pastikan ini mengarah ke halaman login
    }
        
}
