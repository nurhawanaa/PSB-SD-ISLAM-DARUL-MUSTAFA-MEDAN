<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    public function showForm()
    {
        return view('pendaftaran');
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'ortu' => 'required',
            'hp_ortu' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Pendaftaran::create([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'ortu' => $request->ortu,
            'hp_ortu' => $request->hp_ortu,
        ]);

        return redirect('/pendaftaran')->with('success', 'Pendaftaran berhasil!');
    }
}
