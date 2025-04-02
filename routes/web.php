<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;

Route::get('/', function () {
    return view('welcome');
});

//============================ROUTE UNTUK LOGIN DAN SIGNUP============================
// Route untuk login dan signup
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/signup', function () {
    return view('auth.signup');
})->name('signup');

Route::post('/signup', [SignupController::class, 'register'])->name('register');

//============================ROUTE UNTUK ADMIN============================
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak.');
        }
        return view('admin.home');
    })->name('admin.home');

    Route::get('/produk', [ProdukController::class, 'index'])->name('admin.produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('admin.produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('admin.produk.store');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('admin.produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('admin.produk.destroy');

    Route::get('/about', [AboutController::class, 'index'])->name('admin.about');
});

//============================ROUTE UNTUK USER============================
Route::prefix('user')->middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        if (Auth::user()->role !== 'user') {
            return redirect('/')->with('error', 'Akses ditolak.');
        }
        return view('user.home');
    })->name('user.home');

    Route::get('/produk', [ProdukController::class, 'indexuser'])->name('user.produk');

    // Keranjang hanya untuk user
    Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambahKeKeranjang'])->name('keranjang.tambah');
    Route::get('/keranjang', [KeranjangController::class, 'lihatKeranjang'])->name('keranjang.lihat');
    Route::post('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');
    Route::post('/keranjang/beli/{id}', [KeranjangController::class, 'beli'])->name('keranjang.beli');

    // Pesanan hanya untuk user
    Route::get('/pesanan', [PesananController::class, 'lihatPesanan'])->name('pesanan.lihat');
    Route::post('/pesanan/{id}', [PesananController::class, 'store'])->name('pesanan.store');


    Route::get('/about', [AboutController::class, 'index'])->name('user.about');
});
