<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi email dan password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();
        
        if ($user && $user->password === $request->password) {
        Auth::login($user, $request->remember);
        $request->session()->regenerate();
        return redirect('/dashboard');
    }

        
        // Pesan error jika email atau password tidak sesuai
        return back()->with('failed', 'Email atau password salah.');
    }
    public function logout(){
        Auth::logout(Auth::user());
        return redirect ('/login');
    }
}