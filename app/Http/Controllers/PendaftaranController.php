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
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'nik' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'tinggi_badan' => 'required|integer',
            'berat_badan' => 'required|integer',
            'jumlah_saudara' => 'required|integer',
            // Ayah
            'nama_ayah' => 'required',
            'tempat_lahir_ayah' => 'required',
            'tanggal_lahir_ayah' => 'required|date',
            'agama_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'telp_ayah' => 'required',
            'alamat_ayah' => 'required',
            // Ibu
            'nama_ibu' => 'required',
            'tempat_lahir_ibu' => 'required',
            'tanggal_lahir_ibu' => 'required|date',
            'agama_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'telp_ibu' => 'required',
            'alamat_ibu' => 'required',
            'signature' => 'required',
            'lampiran_kk' => 'nullable|file|mimes:jpg,jpeg,png|max:10240',
            'lampiran_akta' => 'nullable|file|mimes:jpg,jpeg,png|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Data pendaftaran tidak valid. Silakan periksa kembali dan lengkapi data yang diminta.');
        }

        $uploadError = null;

        $data = $request->only([
            'nama',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'nik',
            'agama',
            'alamat',
            'tinggi_badan',
            'berat_badan',
            'jumlah_saudara',
            'nama_ayah',
            'tempat_lahir_ayah',
            'tanggal_lahir_ayah',
            'agama_ayah',
            'pendidikan_ayah',
            'pekerjaan_ayah',
            'telp_ayah',
            'alamat_ayah',
            'nama_ibu',
            'tempat_lahir_ibu',
            'tanggal_lahir_ibu',
            'agama_ibu',
            'pendidikan_ibu',
            'pekerjaan_ibu',
            'telp_ibu',
            'alamat_ibu',
            'signature',
        ]);

        // Proses upload file lampiran KK
        if ($request->hasFile('lampiran_kk')) {
            $kk = $request->file('lampiran_kk');
            $kkName = $kk->hashName();
            $kk->storeAs('lampiran_kk', $kkName, 'public');
            $data['lampiran_kk'] = $kkName;
        }
        // Proses upload file lampiran Akta
        if ($request->hasFile('lampiran_akta')) {
            $akta = $request->file('lampiran_akta');
            $aktaName = $akta->hashName();
            $akta->storeAs('lampiran_akta', $aktaName, 'public');
            $data['lampiran_akta'] = $aktaName;
        }

        Pendaftaran::create($data);
        return redirect('/pendaftaran')->with('success', 'Pendaftaran berhasil!');
    }
}
