<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa Lulus - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body style="background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%); min-height:100vh;">
    <div class="container py-5">
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
                        <div class="mt-3 text-end">
                            <a href="{{ url('/pendaftaran') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-circle me-1"></i>Kembali ke Pendaftaran
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>