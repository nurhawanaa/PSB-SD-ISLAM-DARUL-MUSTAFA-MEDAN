@extends('layouts.app')

@section('title', 'Seleksi Siswa - ' . config('app.name'))

@section('content')
<div class="container pt-4 pb-4">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient bg-info text-white text-center rounded-top">
                    <h2 class="mb-1"><i class="bi bi-person-lines-fill me-2"></i>Seleksi Siswa Pendaftar</h2>
                    <span class="fw-light">{{ config('app.name') }}</span>
                </div>
                <div class="card-body p-4">
                    @if(count($siswa) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-info">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat, Tgl Lahir</th>
                                    <th>Alamat</th>
                                    <th>Orang Tua/Wali</th>
                                    <th>No. HP Ortu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
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
                                        <form method="POST" action="{{ route('admin.seleksi.update', $row->id) }}" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" name="status" value="lulus" class="btn btn-success btn-sm"><i class="bi bi-check2-circle"></i> Luluskan</button>
                                            <button type="submit" name="status" value="tidak lulus" class="btn btn-danger btn-sm"><i class="bi bi-x-circle"></i> Tidak Lulus</button>
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
</body>

</html>