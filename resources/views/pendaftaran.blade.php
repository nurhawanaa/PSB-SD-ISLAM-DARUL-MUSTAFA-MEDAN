@extends('layouts.app')

@section('title', 'Pendaftaran Siswa Baru - ' . config('app.name'))

@section('content')
<div class="container pt-0 pb-4" style="margin-top:-2.5rem;">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient bg-primary text-white text-center rounded-top">
                    <h2 class="mb-1"><i class="bi bi-person-plus-fill me-2"></i>Pendaftaran Siswa Baru</h2>
                    <span class="fw-light">{{ config('app.name') }}</span>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    </div>
                    @endif
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="col-12 mt-2 mb-4">
                        <a href="{{ route('pendaftaran.lulus') }}" class="btn btn-primary w-100 shadow-sm">
                            <i class="bi bi-list-check me-2"></i>Lihat Daftar Siswa yang Lulus
                        </a>
                    </div>
                    <form id="dataDiriForm" method="POST" action="/pendaftaran/simpan" autocomplete="off">
                        @csrf
                        <div class="row g-3">
                            <!-- Bagian 1: Data Siswa -->
                            <div class="col-12 mb-2">
                                <h5 class="fw-bold text-primary"><i class="bi bi-person-badge me-2"></i>Data Siswa</h5>
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-person-fill me-1"></i>Nama Siswa</label>
                                <input type="text" name="nama" class="form-control" required placeholder="Nama lengkap siswa">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-geo-alt-fill me-1"></i>Tempat/Tanggal Lahir</label>
                                <div class="input-group">
                                    <input type="text" name="tempat_lahir" class="form-control" required placeholder="Tempat lahir">
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-credit-card-2-front me-1"></i>NIK</label>
                                <input type="text" name="nik" class="form-control" required placeholder="Nomor Induk Kependudukan">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-book me-1"></i>Agama</label>
                                <input type="text" name="agama" class="form-control" required placeholder="Agama siswa">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold"><i class="bi bi-house-door-fill me-1"></i>Alamat</label>
                                <textarea name="alamat" class="form-control" rows="2" required placeholder="Alamat lengkap siswa"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-arrow-up me-1"></i>Tinggi Badan (cm)</label>
                                <input type="number" name="tinggi_badan" class="form-control" required placeholder="Tinggi badan siswa">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-arrow-down me-1"></i>Berat Badan (kg)</label>
                                <input type="number" name="berat_badan" class="form-control" required placeholder="Berat badan siswa">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-people me-1"></i>Jumlah Saudara</label>
                                <input type="number" name="jumlah_saudara" class="form-control" required placeholder="Jumlah saudara kandung">
                            </div>
                            <!-- Bagian 2: Data Orang Tua / Wali -->
                            <div class="col-12 mt-4 mb-2">
                                <h5 class="fw-bold text-success"><i class="bi bi-people-fill me-2"></i>Data Orang Tua / Wali</h5>
                                <hr>
                            </div>
                            <!-- Data Ayah -->
                            <div class="col-12 mb-2">
                                <h6 class="fw-semibold text-secondary"><i class="bi bi-person-fill me-2"></i>Ayah</h6>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Ayah</label>
                                <input type="text" name="nama_ayah" class="form-control" required placeholder="Nama ayah">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tempat/Tanggal Lahir</label>
                                <div class="input-group">
                                    <input type="text" name="tempat_lahir_ayah" class="form-control" required placeholder="Tempat lahir">
                                    <input type="date" name="tanggal_lahir_ayah" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Agama</label>
                                <input type="text" name="agama_ayah" class="form-control" required placeholder="Agama ayah">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Pendidikan</label>
                                <input type="text" name="pendidikan_ayah" class="form-control" required placeholder="Pendidikan terakhir ayah">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Pekerjaan</label>
                                <input type="text" name="pekerjaan_ayah" class="form-control" required placeholder="Pekerjaan ayah">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">No. Telp Ayah</label>
                                <input type="text" name="telp_ayah" class="form-control" required placeholder="Nomor telepon ayah">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Alamat</label>
                                <textarea name="alamat_ayah" class="form-control" rows="2" required placeholder="Alamat ayah"></textarea>
                            </div>
                            <!-- Data Ibu -->
                            <div class="col-12 mb-2 mt-4">
                                <h6 class="fw-semibold text-secondary"><i class="bi bi-person-fill me-2"></i>Ibu</h6>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Ibu</label>
                                <input type="text" name="nama_ibu" class="form-control" required placeholder="Nama ibu">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tempat/Tanggal Lahir</label>
                                <div class="input-group">
                                    <input type="text" name="tempat_lahir_ibu" class="form-control" required placeholder="Tempat lahir">
                                    <input type="date" name="tanggal_lahir_ibu" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Agama</label>
                                <input type="text" name="agama_ibu" class="form-control" required placeholder="Agama ibu">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Pendidikan</label>
                                <input type="text" name="pendidikan_ibu" class="form-control" required placeholder="Pendidikan terakhir ibu">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Pekerjaan</label>
                                <input type="text" name="pekerjaan_ibu" class="form-control" required placeholder="Pekerjaan ibu">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">No. Telp Ibu</label>
                                <input type="text" name="telp_ibu" class="form-control" required placeholder="Nomor telepon ibu">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Alamat</label>
                                <textarea name="alamat_ibu" class="form-control" rows="2" required placeholder="Alamat ibu"></textarea>
                            </div>
                            <!-- Bagian Lampiran Berkas -->
                            <div class="col-12 mt-4 mb-2">
                                <h5 class="fw-bold text-info"><i class="bi bi-paperclip me-2"></i>Lampiran Berkas</h5>
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Fotocopy Kartu Keluarga</label>
                                <input type="file" name="lampiran_kk" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Fotocopy Akta Kelahiran</label>
                                <input type="file" name="lampiran_akta" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success btn-lg w-100 shadow-sm">
                                <i class="bi bi-send-plus me-2"></i>Kirim Pendaftaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection