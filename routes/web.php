<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;

// Halaman daftar pelanggan
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
Route::post('/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

// Halaman User (Ganti resource dengan manual)
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Mahasiswa
Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);

// About
Route::get('/about', function () {
    return view('halaman-about');
});

// Mata kuliah
Route::get('/matakuliah/show/{param1}', [MatakuliahController::class, 'show']);
Route::get('/matakuliah', [MatakuliahController::class, 'index']);
Route::get('/matakuliah/show/{param1?}', [MatakuliahController::class, 'show']);

// Home
Route::get('/home', [HomeController::class, 'index']);

// Question
Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');