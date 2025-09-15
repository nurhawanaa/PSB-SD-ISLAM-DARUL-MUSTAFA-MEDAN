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
            $query->where('nama', 'like', "%$search%");
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
