<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute untuk autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('admin.dashboard');
});

// Rute untuk user
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('landingpage');
    })->name('user.dashboard');
});

Route::resource('products', ProductController::class);

Route::get('/users', [UserController::class, 'index'])->name('users.index');


Route::get('/pesananku', [OrderController::class, 'index'])->name('pesananku'); // Menampilkan riwayat pesanan pengguna
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store'); // Menyimpan pemesanan
Route::get('/admin/pesanan', [OrderController::class, 'adminIndex'])->name('admin.orders'); // Menampilkan daftar pesanan untuk admin
Route::put('/orders/{id}/terima', [OrderController::class, 'updateStatus'])->name('orders.update'); // Admin menerima pesanan
Route::delete('/orders/{id}/tolak', [OrderController::class, 'rejectOrder'])->name('orders.reject'); // Admin menolak pesanan


