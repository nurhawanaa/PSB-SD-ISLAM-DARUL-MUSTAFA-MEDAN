<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin_login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['admin_logged_in' => true, 'admin_id' => $admin->id]);
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors(['login' => 'email atau password salah']);
    }

    public function dashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        $total_pendaftar = \App\Models\Pendaftaran::count();
        $total_lulus = \App\Models\Pendaftaran::where('status', 'lulus')->count();
        $total_belum_lulus = \App\Models\Pendaftaran::where('status', '!=', 'lulus')->count();
        return view('admin_dashboard', compact('total_pendaftar', 'total_lulus', 'total_belum_lulus'));
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_id']);
        return redirect()->route('admin.login');
    }
}
