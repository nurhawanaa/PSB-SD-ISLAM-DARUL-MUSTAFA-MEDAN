@extends('layouts.app')

@section('title', 'Seleksi Siswa - ' . config('app.name'))
@section('navbar_title', 'Seleksi Siswa')
@section('navbar_icon', 'bi-person-check')
@section('navbar')

@section('content')
<style>
    @media print {
        @page {
            size: Legal;
            margin: 1cm;
        }

        body,
        html {
            width: 8.5in;
            height: 14in;
            background: #fff !important;
        }

        .card,
        .card-header,
        .card-body,
        .container-fluid,
        .row,
        .col-12 {
            box-shadow: none !important;
            border: none !important;
            background: #fff !important;
        }

        .btn,
        .navbar,
        .form-control,
        .form-select,
        .form-group,
        .d-flex,
        .mb-3,
        .shadow-lg,
        .shadow-sm,
        .alert,
        .swal2-container {
            display: none !important;
        }

        .table {
            font-size: 12pt;
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #222 !important;
            padding: 6px 8px !important;
        }

        /* Optional: header/footer for print */
        .print-header {
            display: block !important;
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 1.2em;
        }
    }
</style>
<div class="container-fluid pt-4 pb-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg border-0">
                <div class="card-header text-center">
                    <h2 class="mb-1 fw-semibold text-dark"><i class="bi bi-person-lines-fill me-2"></i>Seleksi Siswa Pendaftar</h2>
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
                    <div class="mb-3 d-flex gap-2 flex-wrap" style="z-index:10;position:relative;">
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="printSeleksiTable()"><i class="bi bi-printer"></i> Print</button>
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="exportSeleksiToWord()"><i class="bi bi-file-earmark-word"></i> Export Word</button>
                        <button type="button" class="btn btn-outline-success btn-sm" onclick="exportSeleksiToExcel()"><i class="bi bi-file-earmark-excel"></i> Export Excel</button>
                    </div>
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
                    <div class="table-responsive">
                        <table id="seleksiTable" class="table table-bordered table-hover align-middle table-no-wrap" style="background:#fff;">
                            <thead class="bg-primary text-white">
                                <tr class="text-center align-middle bg-primary text-white">
                                    <th class="fw-semibold" colspan="10">Data Siswa</th>
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
                                    <th>Alamat</th>
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
                                    <td>{{ $row->alamat }}</td>
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
                                            <img src="{{ asset('storage/lampiran_kk/' . $row->lampiran_kk) }}" alt="KK" style="max-width:48px;max-height:48px;cursor:pointer;" title="Klik untuk lihat KK">
                                        </a>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($row->lampiran_akta))
                                        <a href="#" class="preview-img" data-img="{{ asset('storage/lampiran_akta/' . $row->lampiran_akta) }}" data-title="Lampiran Akta">
                                            <img src="{{ asset('storage/lampiran_akta/' . $row->lampiran_akta) }}" alt="Akta" style="max-width:48px;max-height:48px;cursor:pointer;" title="Klik untuk lihat Akta">
                                        </a>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->signature)
                                        <img src="{{ $row->signature }}" alt="Tanda Tangan" style="max-width:48px;max-height:48px;" title="Tanda Tangan Ortu">
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
                                            <button type="button" class="btn btn-outline-info btn-sm px-3 btn-cetak-data"><i class="bi bi-printer"></i> Cetak Data</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html-docx-js/1.0.4/html-docx.min.js"></script>
<script>
    // Utility: clone table without last column (Aksi)
    function getSeleksiTableWithoutAksi() {
        var table = document.getElementById('seleksiTable');
        var clone = table.cloneNode(true);
        // Remove last column from thead
        var theadRows = clone.tHead ? Array.from(clone.tHead.rows) : Array.from(clone.querySelectorAll('thead tr'));
        theadRows.forEach(function(row) {
            if (row.cells.length > 0) {
                row.deleteCell(row.cells.length - 1);
            }
        });
        // Remove last column from tbody
        var tbodyRows = clone.tBodies.length > 0 ? Array.from(clone.tBodies[0].rows) : Array.from(clone.querySelectorAll('tbody tr'));
        tbodyRows.forEach(function(row) {
            if (row.cells.length > 0) {
                row.deleteCell(row.cells.length - 1);
            }
        });
        return clone;
    }

    function getKopSuratHTML() {
        return `
        <div style="text-align:center;margin-bottom:18px;">
            <div style="display:inline-flex;align-items:center;gap:14px;">
                <img src='{{ asset('logosekolah.png') }}' alt='logo' style='height:48px;width:48px;object-fit:contain;background:transparent;border-radius:50%;box-shadow:none;'>
                <div style="text-align:left;">
                    <span style="font-size:1.4rem;font-weight:700;letter-spacing:0.5px;">${document.querySelector('[data-kop-nama]')?.textContent || 'SD ISLAM DARUL MUSTAFA MEDAN'}</span><br>
                    <span style="font-size:1rem;opacity:0.85;">
                        Jl. Pelajar Timur, Gg. Mawar, No. 26 B, Kel. Binjai, Kec. Medan Denai 20228, Kota Medan.<br>
                        Telp: 081261514441 | Email: syafirarizkiarsyddm@gmail.com
                    </span>
                </div>
            </div>
            <hr style="margin-top:10px;margin-bottom:0;border-top:2px solid #222;">
        </div>
        `;
    }

    function printSeleksiTable() {
        var table = getSeleksiTableWithoutAksi();
        // Pastikan header 'Alamat' pada Data Ibu selalu ada di export
        var thead = table.querySelector('thead');
        if (thead && thead.rows.length > 1) {
            var row2 = thead.rows[1];
            if (row2.cells.length === 23) {
                var th = document.createElement('th');
                th.textContent = 'Alamat';
                row2.appendChild(th);
            }
        }
        var kop = getKopSuratHTML();
        var win = window.open('', '', 'width=1200,height=700');
        win.document.write('<html><head><title>Print Data Seleksi</title>');
        win.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">');
        win.document.write('</head><body>');
        win.document.write(kop);
        win.document.write('<h4 style="text-align:center;margin-bottom:18px;">Data Seleksi Siswa</h4>');
        win.document.write(table.outerHTML);
        win.document.write('</body></html>');
        win.document.close();
        win.focus();
        setTimeout(function() {
            win.print();
            win.close();
        }, 500);
    }

    function exportSeleksiToWord() {
        var table = getSeleksiTableWithoutAksi();
        var kop = getKopSuratHTML();
        var style = `
            <style>
                body { font-family: 'Arial', sans-serif; font-size: 12pt; color: #222; }
                .kop-surat { margin-bottom: 18px; }
                h3, h4 { text-align: center; margin-bottom: 18px; }
                table { border-collapse: collapse; width: 100%; margin-bottom: 18px; }
                th, td { border: 1px solid #222; padding: 6px 8px; font-size: 11pt; }
                th { background: #e3e3e3; font-weight: bold; }
                tr:nth-child(even) { background: #f9f9f9; }
                .badge { display: inline-block; padding: 2px 8px; border-radius: 6px; font-size: 10pt; }
                .bg-success { background: #198754; color: #fff; }
                .bg-danger { background: #dc3545; color: #fff; }
                .bg-warning { background: #ffc107; color: #222; }
            </style>
        `;
        var html = '<html><head><meta charset="utf-8"><title>Data Seleksi Siswa</title>' + style + '</head><body>';
        html += '<div class="kop-surat">' + kop + '</div>';
        html += '<h3>DATA SISWA TAHUN PELAJARAN 2025 / 2026</h3>';
        html += table.outerHTML;
        html += '</body></html>';
        var blob = new Blob([html], {
            type: 'application/msword'
        });
        var url = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'data-seleksi.doc';
        document.body.appendChild(a);
        a.click();
        setTimeout(function() {
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }, 1000);
    }

    function exportSeleksiToExcel() {
        // Kop surat
        var kop = [
            ["SD ISLAM DARUL MUSTAFA MEDAN"],
            ["Jl. Pelajar Timur, Gg. Mawar, No. 26 B, Kel. Binjai, Kec. Medan Denai 20228, Kota Medan."],
            ["Telp: 081261514441 | Email: syafirarizkiarsyddm@gmail.com"],
            []
        ];

        // Ambil header tabel: buat dua baris header seperti di website
        var table = getSeleksiTableWithoutAksi();
        var thead = table.querySelector('thead');
        var headerRow1 = [];
        var headerRow2 = [];
        if (thead && thead.rows.length > 1) {
            var row1 = thead.rows[0]; // baris pertama (grup)
            var row2 = thead.rows[1]; // baris kedua (detail)
            // Baris pertama: ulangi label sesuai colspan
            Array.from(row1.cells).forEach(function(cell) {
                var colspan = cell.colSpan || 1;
                var label = cell.innerText.trim();
                for (var i = 0; i < colspan; i++) {
                    headerRow1.push(label);
                }
            });
            // Baris kedua: ambil semua label detail
            Array.from(row2.cells).forEach(function(cell) {
                headerRow2.push(cell.innerText.trim());
            });
            // Jika jumlah kolom baris kedua < baris pertama, tambahkan cell kosong
            while (headerRow2.length < headerRow1.length) {
                headerRow2.push('');
            }
            // Perbaiki header 'Alamat' pada Data Ibu jika kosong
            // Cari posisi kolom terakhir dari grup 'Data Ibu'
            var lastDataIbuIdx = -1;
            for (var i = 0; i < headerRow1.length; i++) {
                if (headerRow1[i] === 'Data Ibu') {
                    lastDataIbuIdx = i;
                }
            }
            if (lastDataIbuIdx !== -1 && headerRow2[lastDataIbuIdx] === '') {
                headerRow2[lastDataIbuIdx] = 'Alamat';
            }
        }

        // Ambil data siswa
        var tbody = table.querySelector('tbody');
        var dataRows = [];
        if (tbody) {
            Array.from(tbody.rows).forEach(function(row) {
                var cells = Array.from(row.cells).map(function(cell) {
                    // Jika ada img, ambil src
                    var img = cell.querySelector('img');
                    if (img) {
                        return img.alt ? img.alt : img.src;
                    }
                    return cell.innerText.trim();
                });
                dataRows.push(cells);
            });
        }

        // Gabungkan semua: kop surat, dua baris header, data
        var aoa = kop.concat([headerRow1, headerRow2]).concat(dataRows);
        var ws = XLSX.utils.aoa_to_sheet(aoa);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Data Seleksi");
        XLSX.writeFile(wb, 'data-seleksi.xlsx');
    }

    // Data kop surat untuk JS
    document.addEventListener('DOMContentLoaded', function() {
        // Cetak satu data pendaftar
        document.querySelectorAll('.btn-cetak-data').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                var tr = btn.closest('tr');
                var cells = tr.querySelectorAll('td');
                // Format data lebih rapi dan profesional
                var html = `
                <div style="font-family:Arial,sans-serif;font-size:12pt;max-width:700px;margin:40px auto 20px auto;">
                    <div style="text-align:center;margin-bottom:18px;">
                        <img src='{{ asset('logosekolah.png') }}' alt='logo' style='height:48px;width:48px;object-fit:contain;background:transparent;border-radius:50%;box-shadow:none;margin-bottom:8px;'>
                        <div style="font-size:1.3em;font-weight:700;letter-spacing:0.5px;">SD ISLAM DARUL MUSTAFA MEDAN</div>
                        <div style="font-size:1em;opacity:0.85;">Jl. Pelajar Timur, Gg. Mawar, No. 26 B, Kel. Binjai, Kec. Medan Denai 20228, Kota Medan.<br>Telp: 081261514441 | Email: syafirarizkiarsyddm@gmail.com</div>
                        <hr style="margin-top:10px;margin-bottom:0;border-top:2px solid #222;">
                    </div>
                    <h2 style="text-align:center;margin-bottom:18px;">Data Pendaftar Siswa</h2>
                    <table style="width:100%;border-collapse:collapse;border:1px solid #222;box-shadow:0 2px 8px #0001;">
                        <tr><th colspan="2" style="background:#e3e3e3;text-align:left;padding:8px 12px;font-size:1.05em;border-bottom:1px solid #bbb;">Data Siswa</th></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Nama</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[1]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">NIK</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[2]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Jenis Kelamin</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[3]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Tempat/Tgl Lahir</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[4]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Usia</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[5]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Agama</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[6]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Tinggi/Berat</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[7]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Saudara</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[8]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Alamat</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[9]?.innerText || ''}</td></tr>
                        <tr><th colspan="2" style="background:#e3e3e3;text-align:left;padding:8px 12px;font-size:1.05em;border-bottom:1px solid #bbb;">Data Ayah</th></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Nama Ayah</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[10]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Tempat/Tgl Lahir</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[11]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Agama</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[12]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Pendidikan</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[13]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Pekerjaan</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[14]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Telp</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[15]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Alamat</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[16]?.innerText || ''}</td></tr>
                        <tr><th colspan="2" style="background:#e3e3e3;text-align:left;padding:8px 12px;font-size:1.05em;border-bottom:1px solid #bbb;">Data Ibu</th></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Nama Ibu</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[17]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Tempat/Tgl Lahir</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[18]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Agama</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[19]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Pendidikan</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[20]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Pekerjaan</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[21]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Telp</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[22]?.innerText || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Alamat</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[23]?.innerText || ''}</td></tr>
                        <tr><th colspan="2" style="background:#e3e3e3;text-align:left;padding:8px 12px;font-size:1.05em;border-bottom:1px solid #bbb;">Lampiran</th></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Fotocopy KK</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[24]?.innerHTML || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Fotocopy Akta</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[25]?.innerHTML || ''}</td></tr>
                        <tr><td style="padding:6px 10px;border-bottom:1px solid #eee;">Tanda Tangan Ortu</td><td style="padding:6px 10px;border-bottom:1px solid #eee;">${cells[26]?.innerHTML || ''}</td></tr>
                        <tr><th colspan="2" style="background:#e3e3e3;text-align:left;padding:8px 12px;font-size:1.05em;border-bottom:1px solid #bbb;">Status</th></tr>
                        <tr><td style="padding:6px 10px;">Status Seleksi</td><td style="padding:6px 10px;">${cells[27]?.innerText || ''}</td></tr>
                    </table>
                </div>`;
                var win = window.open('', '', 'width=900,height=700');
                win.document.write('<html><head><title>Cetak Data Pendaftar</title></head><body>' + html + '</body></html>');
                win.document.close();
                win.focus();
                setTimeout(function() {
                    win.print();
                }, 500);
            });
        });
        // Inject kop data for JS
        var kopNama = document.createElement('span');
        kopNama.setAttribute('data-kop-nama', '');
        kopNama.style.display = 'none';
        kopNama.textContent = "{{ config('app.name') }}";
        document.body.appendChild(kopNama);
        var kopTelp = document.createElement('span');
        kopTelp.setAttribute('data-kop-telp', '');
        kopTelp.style.display = 'none';
        kopTelp.textContent = "{{ config('app.phone') }}";
        document.body.appendChild(kopTelp);
        var kopEmail = document.createElement('span');
        kopEmail.setAttribute('data-kop-email', '');
        kopEmail.style.display = 'none';
        kopEmail.textContent = "{{ config('app.email') }}";
        document.body.appendChild(kopEmail);
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