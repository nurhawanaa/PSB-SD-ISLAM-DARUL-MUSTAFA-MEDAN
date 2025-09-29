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
                    <form method="GET" class="mb-3 d-flex gap-2 justify-content-end flex-wrap align-items-center">
                        @csrf
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control border-0 shadow-none px-3" style="background:#f3f4f6;max-width:220px;" placeholder="Cari nama...">
                        <button type="submit" class="btn btn-sm btn-dark px-3">Cari</button>
                        <a href="?sort=nama_asc" class="btn btn-sm btn-outline-dark px-3">A-Z</a>
                        <a href="?sort=nama_desc" class="btn btn-sm btn-outline-dark px-3">Z-A</a>
                    </form>
                    @if(count($siswa) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle" style="background:#fff;">
                            <thead style="background:#f3f4f6;">
                                <tr class="text-dark text-center align-middle">
                                    <th class="fw-semibold">No</th>
                                    <th class="fw-semibold">Nama
                                        <a href="?sort=nama_asc" class="ms-1 text-decoration-none"><i class="bi bi-arrow-down-up"></i></a>
                                    </th>
                                    <th class="fw-semibold">Jenis Kelamin</th>
                                    <th class="fw-semibold">Tempat, Tgl Lahir</th>
                                    <th class="fw-semibold">Alamat</th>
                                    <th class="fw-semibold">Orang Tua/Wali</th>
                                    <th class="fw-semibold">No. HP Ortu</th>
                                    <th class="fw-semibold">Status</th>
                                    <th class="fw-semibold">Aksi</th>
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