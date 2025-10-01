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
                    <div class="d-flex flex-column align-items-center justify-content-center" style="gap:4px;">
                        <div class="d-flex align-items-center justify-content-center" style="gap:12px;">
                            <div style="background:linear-gradient(135deg,#fff,#e3e3e3);border-radius:50%;padding:6px;box-shadow:0 2px 8px #0002;display:flex;align-items:center;justify-content:center;">
                                <img src="{{ asset('logosekolah.png') }}" alt="logo" style="height:40px;width:40px;object-fit:contain;background:transparent;border-radius:50%;box-shadow:none;display:inline-block;">
                            </div>
                            <div class="text-center">
                                <span style="font-size:1.25em;font-weight:700;letter-spacing:0.5px;color:#000;text-shadow:0 1px 4px #0003;">{{ config('app.name') }}</span><br>
                                <span class="text-black" style="font-size:0.95em;opacity:0.85;text-shadow:0 1px 4px #0002;">
                                    Jl. Pelajar Timur, Gg. Mawar, No. 26 B, Kel. Binjai, Kec. Medan Denai 20228, Kota Medan.<br>
                                    Telp: 081261514441 | Email: syafirarizkiarsyddm@gmail.com
                                </span>
                            </div>
                        </div>
                    </div>
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
                        <table class="table table-bordered table-hover align-middle table-no-wrap" style="background:#fff;">
                            <style>
                                .table-no-wrap td {
                                    white-space: nowrap;
                                }
                                .table-no-wrap tbody tr:hover {
                                    background: #f0f8ff;
                                }
                            </style>
                            <thead class="bg-success text-white">
                                <tr class="text-center align-middle bg-success text-white">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>TTL</th>
                                    <th>Usia</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="table-no-wrap">
                                @foreach($siswa as $i => $row)
                                <tr class="align-middle text-center">
                                    <td>{{ $i+1 }}</td>
                                    <td class="fw-bold text-success">{{ $row->nama }}</td>
                                    <td>{{ $row->jenis_kelamin ?? '-' }}</td>
                                    <td>{{ $row->tempat_lahir }}, {{ \Carbon\Carbon::parse($row->tanggal_lahir)->format('d-m-Y') }}</td>
                                    <td>
                                        @php
                                            $usia = \Carbon\Carbon::parse($row->tanggal_lahir)->age;
                                        @endphp
                                        <span class="badge {{ $usia >= 7 ? 'bg-success' : 'bg-danger' }}">{{ $usia }} Tahun</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Lulus</span>
                                    </td>
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
                    <div class="alert alert-warning mt-3 small text-center">
                        <i class="bi bi-shield-lock me-1"></i>Data yang ditampilkan hanya data siswa demi menjaga privasi keluarga dan dokumen.
                    </div>
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
@endsection