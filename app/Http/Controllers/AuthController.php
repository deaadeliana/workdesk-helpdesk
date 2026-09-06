<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => [
            'required',
            'email',
        ],

        'password' => [
            'required',
        ],
    ]);

    if (!Auth::attempt($credentials)) {
        return back()
            ->withErrors([
                'email' => 'Email atau password tidak sesuai.',
            ])
            ->onlyInput('email');
    }

    $request->session()->regenerate();

    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()
            ->route('admin.dashboard');
    }

    if ($user->role === 'employee') {
        return redirect()
            ->route('employee.dashboard');
    }

    if ($user->role === 'technician') {
    return redirect()->route('technician.dashboard');
    }

    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return back()->withErrors([
        'email' => 'Halaman untuk role tersebut belum tersedia.',
    ]);
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}