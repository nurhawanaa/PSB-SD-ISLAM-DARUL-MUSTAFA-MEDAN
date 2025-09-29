<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->longText('signature')->nullable();
            $table->id();
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nik');
            $table->string('agama');
            $table->text('alamat');
            $table->integer('tinggi_badan');
            $table->integer('berat_badan');
            $table->integer('jumlah_saudara');
            // Ayah
            $table->string('nama_ayah');
            $table->string('tempat_lahir_ayah');
            $table->date('tanggal_lahir_ayah');
            $table->string('agama_ayah');
            $table->string('pendidikan_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('telp_ayah');
            $table->text('alamat_ayah');
            // Ibu
            $table->string('nama_ibu');
            $table->string('tempat_lahir_ibu');
            $table->date('tanggal_lahir_ibu');
            $table->string('agama_ibu');
            $table->string('pendidikan_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('telp_ibu');
            $table->text('alamat_ibu');
            // Lampiran KK & Akta
            $table->string('lampiran_kk')->nullable();
            $table->string('lampiran_akta')->nullable();
            // Status
            $table->string('status')->nullable()->default('belum lulus');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
