<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class DaftarLulusController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftaran::where('status', 'lulus');
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
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
                  ->orWhere('alamat_ibu', 'like', "%$search%");
            });
        }
        if ($request->input('sort') === 'nama_asc') {
            $query->orderBy('nama', 'asc');
        } elseif ($request->input('sort') === 'nama_desc') {
            $query->orderBy('nama', 'desc');
        }
        $siswa = $query->get();
        return view('daftar_lulus', compact('siswa'));
    }
}
