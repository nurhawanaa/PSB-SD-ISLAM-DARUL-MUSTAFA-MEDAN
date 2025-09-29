<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';
    protected $fillable = [
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
        // Ayah
        'nama_ayah',
        'tempat_lahir_ayah',
        'tanggal_lahir_ayah',
        'agama_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'telp_ayah',
        'alamat_ayah',
        // Ibu
        'nama_ibu',
        'tempat_lahir_ibu',
        'tanggal_lahir_ibu',
        'agama_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'telp_ibu',
        'alamat_ibu',
        'signature',
    ];
}
