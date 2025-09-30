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

    public function seleksi(Request $request)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }
        $query = \App\Models\Pendaftaran::query();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                // Pencarian usia
                if (is_numeric($search)) {
                    $q->orWhereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) = ?', [$search]);
                }
                $q->where('nama', 'like', "%$search%")
                    ->orWhere('nik', 'like', "%$search%")
                    ->orWhere('jenis_kelamin', 'like', "%$search%")
                    ->orWhere('tempat_lahir', 'like', "%$search%")
                    ->orWhere('agama', 'like', "%$search%")
                    ->orWhere('alamat', 'like', "%$search%")
                    ->orWhere('nama_ayah', 'like', "%$search%")
                    ->orWhere('nama_ibu', 'like', "%$search%")
                    ->orWhere('pendidikan_ayah', 'like', "%$search%")
                    ->orWhere('pendidikan_ibu', 'like', "%$search%")
                    ->orWhere('pekerjaan_ayah', 'like', "%$search%")
                    ->orWhere('pekerjaan_ibu', 'like', "%$search%")
                    ->orWhere('telp_ayah', 'like', "%$search%")
                    ->orWhere('telp_ibu', 'like', "%$search%")
                    ->orWhere('alamat_ayah', 'like', "%$search%")
                    ->orWhere('alamat_ibu', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%");
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status == 'belum seleksi') {
                $query->where(function($q) {
                    $q->whereNull('status')->orWhere('status', '')->orWhere('status', 'belum seleksi');
                });
            } else {
                $query->where('status', $status);
            }
        }

        if ($request->input('sort') === 'nama_asc') {
            $query->orderBy('nama', 'asc');
        } elseif ($request->input('sort') === 'nama_desc') {
            $query->orderBy('nama', 'desc');
        } elseif ($request->input('sort') === 'usia_asc') {
            $query->orderByRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) asc');
        } elseif ($request->input('sort') === 'usia_desc') {
            $query->orderByRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) desc');
        }
        $siswa = $query->get();
        return view('admin_seleksi', compact('siswa'));
    }

    public function updateSeleksi($id)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }
        $status = request('status');
        $siswa = \App\Models\Pendaftaran::findOrFail($id);
        // Hitung usia dari tanggal lahir
        $tanggal_lahir = $siswa->tanggal_lahir;
        $umur = \Carbon\Carbon::parse($tanggal_lahir)->age;
        if ($status === 'lulus' && $umur < 6) {
            return redirect()->route('admin.seleksi')->with('error', 'Usia siswa kurang dari 6 tahun, tidak dapat diluluskan.');
        }
        $siswa->status = $status;
        $siswa->save();
        return redirect()->route('admin.seleksi');
    }

    public function destroy($id)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }
        $siswa = \App\Models\Pendaftaran::findOrFail($id);
        // Hapus file gambar jika ada
        if (!empty($siswa->lampiran_kk)) {
            $kkPath = public_path('storage/lampiran_kk/' . $siswa->lampiran_kk);
            if (file_exists($kkPath)) {
                @unlink($kkPath);
            }
        }
        if (!empty($siswa->lampiran_akta)) {
            $aktaPath = public_path('storage/lampiran_akta/' . $siswa->lampiran_akta);
            if (file_exists($aktaPath)) {
                @unlink($aktaPath);
            }
        }
        $siswa->delete();
        return redirect()->route('admin.seleksi')->with('success', 'Data berhasil dihapus.');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
