@extends('layouts.app')

@section('title', 'Seleksi Siswa - ' . config('app.name'))

@section('navbar')

@section('content')
<div class="container-fluid pt-4 pb-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg border-0">
                <div class="card-header text-center">
                    <h2 class="mb-1 fw-semibold text-dark"><i class="bi bi-person-lines-fill me-2"></i>Seleksi Siswa Pendaftar</h2>
                    <span class="fw-light text-secondary small">{{ config('app.name') }}</span>
                </div>
                <div class="card-body p-4" style="overflow-x:auto;">
                    @if(session('error'))
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Seleksi',
                                text: "{{ addslashes(session('error')) }}",
                                confirmButtonColor: '#d33',
                            });
                        });
                    </script>
                    @endif
                    <form method="GET" class="mb-3 d-flex gap-2 justify-content-end flex-wrap align-items-center">
                        @csrf
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control border-0 shadow-none px-3" style="background:#f3f4f6;max-width:220px;" placeholder="Cari nama...">
                        <button type="submit" class="btn btn-sm btn-dark px-3">Cari</button>
                        <a href="?sort=nama_asc" class="btn btn-sm btn-outline-dark px-3">A-Z</a>
                        <a href="?sort=nama_desc" class="btn btn-sm btn-outline-dark px-3">Z-A</a>
                        <a href="?sort=usia_asc" class="btn btn-sm btn-outline-primary px-3">Usia Termuda</a>
                        <a href="?sort=usia_desc" class="btn btn-sm btn-outline-primary px-3">Usia Tertua</a>
                    </form>
                    @if(count($siswa) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle" style="background:#fff;">
                            <style>
                                .table-no-wrap td {
                                    white-space: nowrap;
                                }
                            </style>
                            <thead class="bg-primary text-white">
                                <tr class="text-center align-middle bg-primary text-white">
                                    <th class="fw-semibold" colspan="9">Data Siswa</th>
                                    <th class="fw-semibold" colspan="7">Data Ayah</th>
                                    <th class="fw-semibold" colspan="7">Data Ibu</th>
                                    <th class="fw-semibold" rowspan="2">Status</th>
                                    <th class="fw-semibold" rowspan="2">Aksi</th>
                                </tr>
                                <tr class="text-center align-middle small bg-primary text-white" style="opacity:0.95;">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Jenis Kelamin</th>
                                    <th>TTL</th>
                                    <th>Usia</th>
                                    <th>Agama</th>
                                    <th>Tinggi/Berat</th>
                                    <th>Saudara</th>
                                    <th>Nama</th>
                                    <th>TTL</th>
                                    <th>Agama</th>
                                    <th>Pendidikan</th>
                                    <th>Pekerjaan</th>
                                    <th>Telp</th>
                                    <th>Alamat</th>
                                    <th>Nama</th>
                                    <th>TTL</th>
                                    <th>Agama</th>
                                    <th>Pendidikan</th>
                                    <th>Pekerjaan</th>
                                    <th>Telp</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                            <tbody class="table-no-wrap">
                                @foreach($siswa as $i => $row)
                                <tr class="align-middle text-center">
                                    <td>{{ $i+1 }}</td>
                                    <td class="fw-bold text-primary">{{ $row->nama }}</td>
                                    <td>{{ $row->nik }}</td>
                                    <td>{{ $row->jenis_kelamin ?? '-' }}</td>
                                    <td>{{ $row->tempat_lahir }}, {{ \Carbon\Carbon::parse($row->tanggal_lahir)->format('d-m-Y') }}</td>
                                    <td>
                                        @php
                                            $usia = \Carbon\Carbon::parse($row->tanggal_lahir)->age;
                                        @endphp
                                        <span class="badge {{ $usia >= 6 ? 'bg-success' : 'bg-danger' }}">{{ $usia }} Tahun</span>
                                    </td>
                                    <td>{{ $row->agama }}</td>
                                    <td>{{ $row->tinggi_badan }} cm / {{ $row->berat_badan }} kg</td>
                                    <td>{{ $row->jumlah_saudara }}</td>
                                    <td class="text-start">{{ $row->nama_ayah }}</td>
                                    <td class="text-start">{{ $row->tempat_lahir_ayah }}, {{ \Carbon\Carbon::parse($row->tanggal_lahir_ayah)->format('d-m-Y') }}</td>
                                    <td>{{ $row->agama_ayah }}</td>
                                    <td>{{ $row->pendidikan_ayah }}</td>
                                    <td>{{ $row->pekerjaan_ayah }}</td>
                                    <td>{{ $row->telp_ayah }}</td>
                                    <td class="text-start">{{ $row->alamat_ayah }}</td>
                                    <td class="text-start">{{ $row->nama_ibu }}</td>
                                    <td class="text-start">{{ $row->tempat_lahir_ibu }}, {{ \Carbon\Carbon::parse($row->tanggal_lahir_ibu)->format('d-m-Y') }}</td>
                                    <td>{{ $row->agama_ibu }}</td>
                                    <td>{{ $row->pendidikan_ibu }}</td>
                                    <td>{{ $row->pekerjaan_ibu }}</td>
                                    <td>{{ $row->telp_ibu }}</td>
                                    <td class="text-start">{{ $row->alamat_ibu }}</td>
                                    <td>
                                        @if($row->status == 'lulus')
                                        <span class="badge bg-success">Lulus</span>
                                        @elseif($row->status == 'tidak lulus')
                                        <span class="badge bg-danger">Tidak Lulus</span>
                                        @else
                                        <span class="badge bg-warning text-dark">Belum Seleksi</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.seleksi.update', $row->id) }}" class="d-flex justify-content-center gap-2">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" name="status" value="lulus" class="btn btn-success btn-sm px-3"><i class="bi bi-check2-circle"></i> Luluskan</button>
                                            <button type="submit" name="status" value="tidak lulus" class="btn btn-danger btn-sm px-3"><i class="bi bi-x-circle"></i> Tidak Lulus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-info text-center">
                        <i class="bi bi-info-circle me-2"></i>Belum ada siswa yang mendaftar.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection