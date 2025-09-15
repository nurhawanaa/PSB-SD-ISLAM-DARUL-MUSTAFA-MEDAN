@extends('layouts.app')

@section('title', 'Daftar Siswa Lulus - ' . config('app.name'))

@section('content')
<div class="container pt-4 pb-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient bg-success text-white text-center rounded-top">
                    <h2 class="mb-1"><i class="bi bi-list-check me-2"></i>Daftar Siswa yang Lulus</h2>
                    <span class="fw-light">{{ config('app.name') }}</span>
                </div>
                <div class="card-body p-4">
                    @if(count($siswa) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-success">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
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
                                    <td>{{ $i+1 }}</td>
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
</body>

</html>