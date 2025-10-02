<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Auth;

// Halaman verifikasi reCAPTCHA
Route::get('/pendaftaran/verifikasi', function () {
    if (Session::get('recaptcha_verified')) {
        return redirect()->route('pendaftaran.form');
    }
    return view('verifikasi');
})->name('pendaftaran.verifikasi');

// Proses verifikasi reCAPTCHA
Route::post('/pendaftaran/verify', [VerifikasiController::class, 'verify'])->name('pendaftaran.verify');

// Proteksi akses form pendaftaran
Route::get('/', function () {
    if (!Session::get('recaptcha_verified')) {
        return redirect()->route('pendaftaran.verifikasi');
    }
    return (new PendaftaranController())->showForm();
})->name('pendaftaran.form');

Route::get('/pendaftaran', function () {
    if (!Session::get('recaptcha_verified')) {
        return redirect()->route('pendaftaran.verifikasi');
    }
    return (new PendaftaranController())->showForm();
})->name('pendaftaran.form');

// Proses simpan data pendaftar
Route::post('/pendaftaran/simpan', [PendaftaranController::class, 'simpan']);

// Daftar siswa yang lulus
use App\Http\Controllers\DaftarLulusController;

Route::get('/pendaftaran/lulus', [DaftarLulusController::class, 'index'])->name('pendaftaran.lulus');


// Login
Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// ADMIN ROUTES
Route::prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');

    // Seleksi siswa
    Route::get('/seleksi', [AdminAuthController::class, 'seleksi'])->name('admin.seleksi');
    Route::put('/seleksi/{id}', [AdminAuthController::class, 'updateSeleksi'])->name('admin.seleksi.update');
    Route::delete('/seleksi/{id}', [AdminAuthController::class, 'destroy'])->name('admin.seleksi.delete');

    // Manajemen admin
    Route::get('/manage', [AdminAuthController::class, 'manage'])->name('admin.manage');
    Route::post('/store', [AdminAuthController::class, 'store'])->name('admin.store');
    Route::put('/update/{id}', [AdminAuthController::class, 'update'])->name('admin.update');
    Route::delete('/destroy/{id}', [AdminAuthController::class, 'destroyAdmin'])->name('admin.destroy');
    // Tambah admin baru
    Route::post('/store', [AdminAuthController::class, 'store'])->name('admin.store');

    // Logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});
