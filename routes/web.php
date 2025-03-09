<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[AdminController::class,'index']);


Route::post('/login', [LoginController::class, 'authenticated']);

// Route untuk Admin
Route::get('/admin/dashboard', function () {
    if (Auth::check() && Auth::user()->role !== 'admin') {
        return redirect('/');
    }
    return view('home');
})->middleware('auth');

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
