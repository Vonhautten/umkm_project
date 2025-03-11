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

//============================ROUTE UNTUK LOGIN DAN SIGNUP============================
// Route untuk login dan signup
Route::post('/login', [LoginController::class, 'authenticated']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/signup', function () {
    return view('auth.signup');
})->name('signup');

Route::post('/signup', [SignupController::class, 'register'])->name('register');

//============================ROUTE UNTUK ADMIN============================
Route::get('/admin/home', function () {
    if (Auth::check() && Auth::user()->role !== 'admin') {
        return redirect('/');
    }
    return view('admin.home');
})->middleware('auth');

Route::get('/admin/produk', [ProdukController::class, 'index'])->middleware('auth');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/home', function () {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/');
        }
        return view('admin.home');
    });

    Route::get('/produk', [ProdukController::class, 'index'])->name('admin.produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('admin.produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('admin.produk.store');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('admin.produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('admin.produk.destroy');
});
//========================================================================

// Route untuk User
Route::get('/user/home', function () {
    if (Auth::check() && Auth::user()->role !== 'user') {
        return redirect('/');
    }
    return view('user.home');
})->middleware('auth');

Route::get('/user/produk', [ProdukController::class, 'indexuser'])->middleware('auth');

//========================================================================