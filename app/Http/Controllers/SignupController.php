<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SignupController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:tbl_user,email',
            'telepon' => 'nullable|string|max:15',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default user
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
