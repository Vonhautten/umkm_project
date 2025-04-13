<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect('/admin/home');
            } elseif ($user->role === 'user') {
                return redirect('/user/home');
            } else {
                Auth::logout(); // kalau role tidak dikenali, logout
                return back()->with('error', 'Role tidak dikenali.');
            }
        }

        return back()->with('error', 'Email atau password salah.');
    }
}
