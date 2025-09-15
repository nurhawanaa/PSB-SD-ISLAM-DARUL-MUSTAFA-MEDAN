<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\PendaftaranController;

// Halaman verifikasi reCAPTCHA
Route::get('/pendaftaran/verifikasi', function () {
    if (Session::get('recaptcha_verified')) {
        return redirect()->route('pendaftaran.form');
    }
    return view('verifikasi');
})->name('pendaftaran.verifikasi');

// Proses verifikasi reCAPTCHA
Route::post('/pendaftaran/verify', function (Request $request) {
    $response = $request->input('g-recaptcha-response');
    $secret = env('RECAPTCHA_SECRET_KEY');
    $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $response);
    $captchaSuccess = json_decode($verify);
    if ($captchaSuccess && $captchaSuccess->success) {
        Session::put('recaptcha_verified', true);
        return redirect()->route('pendaftaran.form');
    } else {
        return redirect()->back()->withErrors(['captcha' => 'Verifikasi captcha gagal, silakan coba lagi.']);
    }
});

// Proteksi akses form pendaftaran
Route::get('/pendaftaran', function () {
    if (!Session::get('recaptcha_verified')) {
        return redirect()->route('pendaftaran.verifikasi');
    }
    return (new PendaftaranController())->showForm();
})->name('pendaftaran.form');

// Proses simpan data pendaftar
Route::post('/pendaftaran/simpan', [PendaftaranController::class, 'simpan']);
