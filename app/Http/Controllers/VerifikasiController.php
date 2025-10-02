<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VerifikasiController extends Controller
{
    public function verify(Request $request)
    {
        $response = $request->input('g-recaptcha-response');
        $secret = env('RECAPTCHA_SECRET_KEY');
        $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $response);
        $captchaSuccess = json_decode($verify);
        if ($captchaSuccess && $captchaSuccess->success) {
            Session::put('recaptcha_verified', true);
            return redirect()->route('pendaftaran.form');
        } else {
            return redirect()->back()->withErrors(['captcha' => 'Verifikasi captcha gagal. Silakan ulangi proses verifikasi untuk melanjutkan.']);
        }
    }
}
