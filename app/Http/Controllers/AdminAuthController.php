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

        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors(['login' => 'email atau password salah']);
    }

    public function dashboard()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }
        $total_pendaftar = \App\Models\Pendaftaran::count();
        $total_lulus = \App\Models\Pendaftaran::where('status', 'lulus')->count();
        $total_belum_lulus = \App\Models\Pendaftaran::where('status', '!=', 'lulus')->count();
        return view('admin_dashboard', compact('total_pendaftar', 'total_lulus', 'total_belum_lulus'));
    }

    public function seleksi()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }
        $siswa = \App\Models\Pendaftaran::all();
        return view('admin_seleksi', compact('siswa'));
    }

    public function updateSeleksi($id)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }
        $status = request('status');
        $siswa = \App\Models\Pendaftaran::findOrFail($id);
        $siswa->status = $status;
        $siswa->save();
        return redirect()->route('admin.seleksi');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
