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
                        <select name="status" class="form-select form-select-sm border-0 shadow-none px-3" style="background:#f3f4f6;max-width:180px;" onchange="this.form.submit()">
                            <option value="">- Semua Status -</option>
                            <option value="belum seleksi" {{ request('status') == 'belum seleksi' ? 'selected' : '' }}>Belum Seleksi</option>
                            <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                            <option value="tidak lulus" {{ request('status') == 'tidak lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                        </select>
                    </form>
                    @if(count($siswa) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle table-no-wrap" style="background:#fff;">
                            <style>
                                .table-no-wrap td {
                                    white-space: nowrap;
                                }

                                .table-no-wrap th,
                                .table-no-wrap td {
                                    border-right: 2px solid #e3e3e3;
                                }

                                .table-no-wrap th:last-child,
                                .table-no-wrap td:last-child {
                                    border-right: none;
                                }

                                .table-no-wrap tbody tr:hover {
                                    background: #f0f8ff;
                                }

                                .table-no-wrap .text-start {
                                    text-align: left !important;
                                    font-size: 0.95em;
                                }
                            </style>
                            <thead class="bg-primary text-white">
                                <tr class="text-center align-middle bg-primary text-white">
                                    <th class="fw-semibold" colspan="9">Data Siswa</th>
                                    <th class="fw-semibold" colspan="7">Data Ayah</th>
                                    <th class="fw-semibold" colspan="7">Data Ibu</th>
                                    <th class="fw-semibold" rowspan="2">Lampiran KK</th>
                                    <th class="fw-semibold" rowspan="2">Lampiran Akta</th>
                                    <th class="fw-semibold" rowspan="2">Tanda Tangan Ortu</th>
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
                                        @if(!empty($row->lampiran_kk))
                                        <a href="#" class="preview-img" data-img="{{ asset('storage/lampiran_kk/' . $row->lampiran_kk) }}" data-title="Lampiran KK">
                                            <img src="{{ asset('storage/lampiran_kk/' . $row->lampiran_kk) }}" alt="KK" style="max-width:80px;max-height:80px;cursor:pointer;" title="Klik untuk lihat KK">
                                        </a>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($row->lampiran_akta))
                                        <a href="#" class="preview-img" data-img="{{ asset('storage/lampiran_akta/' . $row->lampiran_akta) }}" data-title="Lampiran Akta">
                                            <img src="{{ asset('storage/lampiran_akta/' . $row->lampiran_akta) }}" alt="Akta" style="max-width:80px;max-height:80px;cursor:pointer;" title="Klik untuk lihat Akta">
                                        </a>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->signature)
                                        <img src="{{ $row->signature }}" alt="Tanda Tangan" style="max-width:80px;max-height:80px;" title="Tanda Tangan Ortu">
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
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
                                        <div class="d-flex justify-content-center gap-2 mb-2">
                                            <form method="POST" action="{{ route('admin.seleksi.update', $row->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" name="status" value="lulus" class="btn btn-success btn-sm px-3"><i class="bi bi-check2-circle"></i> Luluskan</button>
                                                <button type="submit" name="status" value="tidak lulus" class="btn btn-danger btn-sm px-3"><i class="bi bi-x-circle"></i> Tidak Lulus</button>
                                            </form>
                                            @if($row->status == 'lulus' || $row->status == 'tidak lulus')
                                            <form method="POST" action="{{ route('admin.seleksi.delete', $row->id) }}" class="form-hapus-data">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger btn-sm px-3 btn-hapus-data"><i class="bi bi-trash"></i> Hapus</button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal preview image
        document.body.insertAdjacentHTML('beforeend', `
            <div id="imgModal" style="display:none;position:fixed;z-index:9999;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.7);justify-content:center;align-items:center;">
                <div style="position:relative;background:#fff;padding:20px;border-radius:10px;max-width:90vw;max-height:90vh;box-shadow:0 0 20px #0008;text-align:center;">
                    <span id="imgModalTitle" style="font-weight:bold;display:block;margin-bottom:10px;"></span>
                    <img id="imgModalImg" src="" alt="Preview" style="max-width:80vw;max-height:70vh;border-radius:8px;box-shadow:0 0 8px #0004;">
                    <br>
                    <a id="imgModalDownload" href="#" download style="margin-top:10px;display:inline-block;" class="btn btn-primary"><i class="bi bi-download"></i> Unduh Gambar</a>
                    <button id="imgModalClose" class="btn btn-danger" style="margin-top:10px;margin-left:10px;">Tutup</button>
                </div>
            </div>
        `);

        document.querySelectorAll('.preview-img').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                var imgUrl = link.getAttribute('data-img');
                var imgTitle = link.getAttribute('data-title');
                document.getElementById('imgModalImg').src = imgUrl;
                document.getElementById('imgModalTitle').textContent = imgTitle;
                document.getElementById('imgModalDownload').href = imgUrl;
                document.getElementById('imgModal').style.display = 'flex';
            });
        });
        document.getElementById('imgModalClose').onclick = function() {
            document.getElementById('imgModal').style.display = 'none';
            document.getElementById('imgModalImg').src = '';
        };

        // SweetAlert2 hapus data
        document.querySelectorAll('.btn-hapus-data').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const form = btn.closest('form');
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Yakin ingin menghapus data ini? Data yang dihapus tidak dapat dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection