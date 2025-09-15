@extends('layouts.app')

@section('title', 'Daftar Siswa Lulus - ' . config('app.name'))

@section('navbar')

@section('content')
<div class="container-fluid pt-4 pb-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg border-0">
                <div class="card-header text-center">
                    <h2 class="mb-1 fw-semibold text-dark"><i class="bi bi-list-check me-2"></i>Daftar Siswa yang Lulus</h2>
                    <span class="fw-light text-secondary small">{{ config('app.name') }}</span>
                </div>
                <div class="card-body p-4">
                    <form method="GET" class="mb-3 d-flex align-items-center gap-2 justify-content-end flex-wrap">
                        @csrf
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control border-0 shadow-none px-3" style="background:#f3f4f6;max-width:220px;" placeholder="Cari nama...">
                        <button type="submit" class="btn btn-sm btn-dark px-3">Cari</button>
                        <a href="?sort=nama_asc" class="btn btn-sm btn-outline-dark px-3">A-Z</a>
                        <a href="?sort=nama_desc" class="btn btn-sm btn-outline-dark px-3">Z-A</a>
                    </form>
                    @if(count($siswa) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-success">
                                <tr class="text-dark text-center align-middle">
                                    <th>No</th>
                                    <th>Nama
                                        <a href="?sort=nama_asc" class="ms-1 text-decoration-none"><i class="bi bi-arrow-down-up"></i></a>
                                    </th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat, Tgl Lahir</th>
                                    <th>Alamat</th>
                                    <th>Orang Tua/Wali</th>
                                    <th>No. HP Ortu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswa as $i => $row)
                                <tr>
                                    <td class="text-center align-middle">{{ $i+1 }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>{{ $row->jenis_kelamin }}</td>
                                    <td>{{ $row->tempat_lahir }}, {{ \Carbon\Carbon::parse($row->tanggal_lahir)->format('d-m-Y') }}</td>
                                    <td>{{ $row->alamat }}</td>
                                    <td>{{ $row->ortu }}</td>
                                    <td>{{ $row->hp_ortu }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-info text-center">
                        <i class="bi bi-info-circle me-2"></i>Belum ada siswa yang lulus.
                    </div>
                    @endif
                    @if(!auth()->guard('admin')->check())
                    <div class="mt-3 text-end">
                        <a href="{{ url('/pendaftaran') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left-circle me-1"></i>Kembali ke Pendaftaran
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>