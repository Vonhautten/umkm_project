<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProdukController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [LoginController::class, 'authenticated']);

//============================ROUTE UNTUK ADMIN============================
Route::get('/admin/home', function () {
    if (Auth::check() && Auth::user()->role !== 'admin') {
        return redirect('/');
    }
    return view('admin.home');
})->middleware('auth');

Route::get('/admin/produk', [ProdukController::class, 'index'])->middleware('auth');
//========================================================================

// Route untuk User
Route::get('/user/home', function () {
    if (Auth::check() && Auth::user()->role !== 'user') {
        return redirect('/');
    }
    return view('user.home');
})->middleware('auth');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/signup', function () {
    return view('auth.signup');
})->name('signup');

Route::post('/signup', [SignupController::class, 'register'])->name('register');