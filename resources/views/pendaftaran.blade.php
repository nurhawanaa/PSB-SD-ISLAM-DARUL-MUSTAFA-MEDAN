@extends('layouts.app')

@section('title', 'Pendaftaran Siswa Baru - ' . config('app.name'))

@section('content')
<div class="container pt-0 pb-4" style="margin-top:-2.5rem;">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient bg-primary text-white text-center rounded-top">
                    <h2 class="mb-1"><i class="bi bi-person-plus-fill me-2"></i>Pendaftaran Siswa Baru</h2>
                    <div class="d-flex flex-column align-items-center justify-content-center" style="gap:4px;">
                        <div class="d-flex align-items-center justify-content-center" style="gap:12px;">
                            <div style="background:linear-gradient(135deg,#fff,#e3e3e3);border-radius:50%;padding:6px;box-shadow:0 2px 8px #0002;display:flex;align-items:center;justify-content:center;">
                                <img src="{{ asset('logosekolah.png') }}" alt="logo" style="height:40px;width:40px;object-fit:contain;background:transparent;border-radius:50%;box-shadow:none;display:inline-block;">
                            </div>
                            <div class="text-center">
                                <span style="font-size:1.25em;font-weight:700;letter-spacing:0.5px;color:#fff;text-shadow:0 1px 4px #0003;">{{ config('app.name') }}</span><br>
                                <span class="text-white" style="font-size:0.95em;opacity:0.85;text-shadow:0 1px 4px #0002;">
                                    Jl. Pelajar Timur, Gg. Mawar, No. 26 B, Kel. Binjai, Kec. Medan Denai 20228, Kota Medan.<br>
                                    Telp: 081261514441 | Email: syafirarizkiarsyddm@gmail.com
                                </span>
                            </div>
                        </div>
                    </div>
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
                    <form id="dataDiriForm" method="POST" action="/pendaftaran/simpan" autocomplete="off" enctype="multipart/form-data">
                        <style>
                            .is-filled {
                                border: 2px solid #198754 !important;
                                background: #f6fff6;
                            }

                            .input-check {
                                position: absolute;
                                right: 10px;
                                top: 50%;
                                transform: translateY(-50%);
                                color: #198754;
                                font-size: 1.2em;
                            }

                            .form-group-check {
                                position: relative;
                            }
                        </style>
                        @csrf
                        <div class="row gy-3 gx-2">
                            <!-- Bagian 1: Data Siswa -->
                            <div class="col-12 mb-2">
                                <h5 class="fw-bold text-primary mb-2"><i class="bi bi-person-badge me-2"></i>Data Siswa</h5>
                                <div class="small text-muted mb-2">Isi data sesuai dokumen resmi.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-person-fill me-1"></i>Nama Siswa</label>
                                <div class="form-group-check">
                                    <input type="text" name="nama" class="form-control" required placeholder="Nama lengkap siswa">
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-geo-alt-fill me-1"></i>Tempat/Tanggal Lahir</label>
                                <div class="input-group">
                                    <div class="form-group-check">
                                        <input type="text" name="tempat_lahir" class="form-control" required placeholder="Tempat lahir">
                                        <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                    </div>
                                    <div class="form-group-check">
                                        <input type="date" name="tanggal_lahir" class="form-control" required>
                                        <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold d-block"><i class="bi bi-gender-ambiguous me-1"></i>Jenis Kelamin</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jkL" value="Laki-laki" required>
                                    <label class="form-check-label" for="jkL"><i class="bi bi-gender-male me-1"></i>Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jkP" value="Perempuan" required>
                                    <label class="form-check-label" for="jkP"><i class="bi bi-gender-female me-1"></i>Perempuan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-credit-card-2-front me-1"></i>NIK</label>
                                <div class="form-group-check">
                                    <input type="text" name="nik" class="form-control" required placeholder="Nomor Induk Kependudukan">
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-book me-1"></i>Agama</label>
                                <div class="form-group-check">
                                    <input type="text" name="agama" class="form-control" required placeholder="Agama siswa">
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold"><i class="bi bi-house-door-fill me-1"></i>Alamat</label>
                                <div class="form-group-check">
                                    <textarea name="alamat" class="form-control" rows="2" required placeholder="Alamat lengkap siswa"></textarea>
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-arrow-up me-1"></i>Tinggi Badan (cm)</label>
                                <div class="form-group-check">
                                    <input type="number" name="tinggi_badan" class="form-control" required placeholder="Tinggi badan siswa">
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-arrow-down me-1"></i>Berat Badan (kg)</label>
                                <div class="form-group-check">
                                    <input type="number" name="berat_badan" class="form-control" required placeholder="Berat badan siswa">
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-people me-1"></i>Jumlah Saudara</label>
                                <div class="form-group-check">
                                    <input type="number" name="jumlah_saudara" class="form-control" required placeholder="Jumlah saudara kandung">
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <!-- Bagian 2: Data Orang Tua / Wali -->
                            <div class="col-12 mt-4 mb-2">
                                <h5 class="fw-bold text-success mb-2"><i class="bi bi-people-fill me-2"></i>Data Orang Tua / Wali</h5>
                                <div class="small text-muted mb-2">Isi data sesuai KTP dan KK.</div>
                            </div>
                            <!-- Data Ayah -->
                            <div class="col-12 mb-2">
                                <h6 class="fw-semibold text-secondary"><i class="bi bi-person-fill me-2"></i>Ayah</h6>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-person-fill me-1 text-primary"></i>Nama Ayah</label>
                                <div class="form-group-check">
                                    <input type="text" name="nama_ayah" class="form-control" required placeholder="Nama ayah">
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-geo-alt-fill me-1 text-success"></i>Tempat/Tanggal Lahir</label>
                                <div class="input-group">
                                    <div class="form-group-check">
                                        <input type="text" name="tempat_lahir_ayah" class="form-control" required placeholder="Tempat lahir">
                                        <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                    </div>
                                    <div class="form-group-check">
                                        <input type="date" name="tanggal_lahir_ayah" class="form-control" required>
                                        <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold"><i class="bi bi-book me-1 text-info"></i>Agama</label>
                                <div class="form-group-check">
                                    <input type="text" name="agama_ayah" class="form-control" required placeholder="Agama ayah">
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold"><i class="bi bi-mortarboard-fill me-1 text-warning"></i>Pendidikan</label>
                                <div class="form-group-check">
                                    <input type="text" name="pendidikan_ayah" class="form-control" required placeholder="Pendidikan terakhir ayah">
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold"><i class="bi bi-briefcase-fill me-1 text-secondary"></i>Pekerjaan</label>
                                <div class="form-group-check">
                                    <input type="text" name="pekerjaan_ayah" class="form-control" required placeholder="Pekerjaan ayah">
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold"><i class="bi bi-telephone-fill me-1 text-success"></i>No. Telp Ayah</label>
                                <div class="form-group-check">
                                    <input type="number" name="telp_ayah" class="form-control" required placeholder="Nomor telepon ayah">
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold"><i class="bi bi-house-door-fill me-1 text-danger"></i>Alamat</label>
                                <div class="form-group-check">
                                    <textarea name="alamat_ayah" class="form-control" rows="2" required placeholder="Alamat ayah"></textarea>
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <!-- Data Ibu -->
                            <div class="col-12 mb-2 mt-4">
                                <h6 class="fw-semibold text-secondary"><i class="bi bi-person-fill me-2"></i>Ibu</h6>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-person-fill me-1 text-primary"></i>Nama Ibu</label>
                                <div class="form-group-check">
                                    <input type="text" name="nama_ibu" class="form-control" required placeholder="Nama ibu">
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-geo-alt-fill me-1 text-success"></i>Tempat/Tanggal Lahir</label>
                                <div class="input-group">
                                    <div class="form-group-check">
                                        <input type="text" name="tempat_lahir_ibu" class="form-control" required placeholder="Tempat lahir">
                                        <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                    </div>
                                    <div class="form-group-check">
                                        <input type="date" name="tanggal_lahir_ibu" class="form-control" required>
                                        <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold"><i class="bi bi-book me-1 text-info"></i>Agama</label>
                                <div class="form-group-check">
                                    <input type="text" name="agama_ibu" class="form-control" required placeholder="Agama ibu">
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold"><i class="bi bi-mortarboard-fill me-1 text-warning"></i>Pendidikan</label>
                                <div class="form-group-check">
                                    <input type="text" name="pendidikan_ibu" class="form-control" required placeholder="Pendidikan terakhir ibu">
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold"><i class="bi bi-briefcase-fill me-1 text-secondary"></i>Pekerjaan</label>
                                <div class="form-group-check">
                                    <input type="text" name="pekerjaan_ibu" class="form-control" required placeholder="Pekerjaan ibu">
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold"><i class="bi bi-telephone-fill me-1 text-success"></i>No. Telp Ibu</label>
                                <div class="form-group-check">
                                    <input type="number" name="telp_ibu" class="form-control" required placeholder="Nomor telepon ibu">
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold"><i class="bi bi-house-door-fill me-1 text-danger"></i>Alamat</label>
                                <div class="form-group-check">
                                    <textarea name="alamat_ibu" class="form-control" rows="2" required placeholder="Alamat ibu"></textarea>
                                    <span class="input-check" style="display:none;"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <!-- Bagian Lampiran Berkas -->
                            <div class="col-12 mt-4 mb-2">
                                <h5 class="fw-bold text-info mb-2"><i class="bi bi-paperclip me-2"></i>Lampiran Berkas</h5>
                                <div class="small text-muted mb-2">Format JPG atau PNG. Maksimal 10MB.<br><span class="text-danger">*Catatan: Mohon kirim foto lampiran yang jelas dan mudah dibaca.</span></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-card-list me-1 text-primary"></i>Fotocopy Kartu Keluarga</label>
                                <input type="file" name="lampiran_kk" id="lampiran_kk" class="form-control" accept=".jpg,.jpeg,.png" required>
                                <div id="preview_kk" class="mt-2"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="bi bi-file-earmark-text me-1 text-info"></i>Fotocopy Akta Kelahiran</label>
                                <input type="file" name="lampiran_akta" id="lampiran_akta" class="form-control" accept=".jpg,.jpeg,.png" required>
                                <div id="preview_akta" class="mt-2"></div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <!-- Tanda Tangan Orang Tua Siswa -->
                            <div class="mb-4">
                                <h5 class="fw-bold text-danger mb-2"><i class="bi bi-pencil me-2"></i>Tanda Tangan Orang Tua/Wali</h5>
                                <div class="small text-muted mb-2">Tanda tangan digital wajib diisi.</div>
                                <canvas id="signature-pad" class="border rounded mx-auto d-block" width="300" height="60" style="background:#fff;max-width:100%;"></canvas>
                                <input type="hidden" name="signature" id="signature-input" required>
                                <button type="button" class="btn btn-sm btn-outline-secondary px-1 mt-2" onclick="clearSignature()">Bersihkan</button>
                            </div>
                            <small class="mb-2 d-block text-muted">
                                <i class="bi bi-info-circle-fill me-1"></i>Pastikan semua data telah diisi dengan benar sebelum mengirim pendaftaran.
                            </small>
                            <button type="submit" class="btn btn-success btn-lg w-100 shadow-sm" id="submitBtn">
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

@push('scripts')
<script>
    // Penanda input terisi
    document.querySelectorAll('.form-group-check input, .form-group-check textarea').forEach(function(input) {
        input.addEventListener('input', function() {
            const parent = input.parentElement;
            const check = parent.querySelector('.input-check');
            if (input.value.trim() !== '') {
                input.classList.add('is-filled');
                check.style.display = 'inline';
            } else {
                input.classList.remove('is-filled');
                check.style.display = 'none';
            }
        });
        // Initial state
        if (input.value.trim() !== '') {
            input.classList.add('is-filled');
            input.parentElement.querySelector('.input-check').style.display = 'inline';
        }
    });
    // Preview Lampiran KK
    document.getElementById('lampiran_kk').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('preview_kk');
        preview.innerHTML = '';
        if (file) {
            if (file.type.match('image.*')) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    preview.innerHTML = '<img src="' + evt.target.result + '" class="img-thumbnail" style="max-width:150px;max-height:150px;">';
                };
                reader.readAsDataURL(file);
            }
        }
    });
    // Preview Lampiran Akta
    document.getElementById('lampiran_akta').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('preview_akta');
        preview.innerHTML = '';
        if (file) {
            if (file.type.match('image.*')) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    preview.innerHTML = '<img src="' + evt.target.result + '" class="img-thumbnail" style="max-width:150px;max-height:150px;">';
                };
                reader.readAsDataURL(file);
            }
        }
    });
    // Signature Pad
    let canvas = document.getElementById('signature-pad');
    let signatureInput = document.getElementById('signature-input');
    let ctx = canvas.getContext('2d');
    let drawing = false;
    let lastPos = {
        x: 0,
        y: 0
    };

    function getPointerPos(canvas, evt) {
        let rect = canvas.getBoundingClientRect();
        let x, y;
        if (evt.touches && evt.touches.length) {
            x = evt.touches[0].clientX - rect.left;
            y = evt.touches[0].clientY - rect.top;
        } else {
            x = evt.clientX - rect.left;
            y = evt.clientY - rect.top;
        }
        return {
            x,
            y
        };
    }

    function clearSignature() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        signatureInput.value = '';
        checkFormValidity();
    }

    function saveSignature() {
        let dataURL = canvas.toDataURL();
        if (!isCanvasBlank(canvas)) {
            signatureInput.value = dataURL;
        } else {
            signatureInput.value = '';
        }
        checkFormValidity();
    }

    function isCanvasBlank(c) {
        const blank = document.createElement('canvas');
        blank.width = c.width;
        blank.height = c.height;
        return c.toDataURL() === blank.toDataURL();
    }

    // Desktop events
    canvas.addEventListener('mousedown', function(e) {
        drawing = true;
        lastPos = getPointerPos(canvas, e);
    });
    canvas.addEventListener('mouseup', function() {
        drawing = false;
        saveSignature();
    });
    canvas.addEventListener('mouseout', function() {
        drawing = false;
        saveSignature();
    });
    canvas.addEventListener('mousemove', function(e) {
        if (drawing) {
            let pos = getPointerPos(canvas, e);
            ctx.beginPath();
            ctx.moveTo(lastPos.x, lastPos.y);
            ctx.lineTo(pos.x, pos.y);
            ctx.strokeStyle = '#222';
            ctx.lineWidth = 2;
            ctx.stroke();
            lastPos = pos;
        }
    });
    // Mobile events
    canvas.addEventListener('touchstart', function(e) {
        e.preventDefault();
        drawing = true;
        lastPos = getPointerPos(canvas, e);
    });
    canvas.addEventListener('touchend', function(e) {
        e.preventDefault();
        drawing = false;
        saveSignature();
    });
    canvas.addEventListener('touchcancel', function(e) {
        e.preventDefault();
        drawing = false;
        saveSignature();
    });
    canvas.addEventListener('touchmove', function(e) {
        e.preventDefault();
        if (drawing) {
            let pos = getPointerPos(canvas, e);
            ctx.beginPath();
            ctx.moveTo(lastPos.x, lastPos.y);
            ctx.lineTo(pos.x, pos.y);
            ctx.strokeStyle = '#222';
            ctx.lineWidth = 2;
            ctx.stroke();
            lastPos = pos;
        }
    });

    // Disable submit button if form is incomplete
    const form = document.getElementById('dataDiriForm');
    const submitBtn = document.getElementById('submitBtn');

    function checkFormValidity() {
        let valid = form.checkValidity();
        if (!signatureInput.value) valid = false;
        submitBtn.disabled = !valid;
    }
    form.addEventListener('input', checkFormValidity);
    document.addEventListener('DOMContentLoaded', checkFormValidity);

    // SweetAlert2 konfirmasi sebelum submit
    document.getElementById('dataDiriForm').addEventListener('submit', function(e) {
        saveSignature();
        if (!signatureInput.value) {
            Swal.fire({
                icon: 'warning',
                title: 'Tanda Tangan Wajib!',
                text: 'Tanda tangan orang tua/wali wajib diisi!',
                confirmButtonText: 'OK'
            });
            e.preventDefault();
            return;
        }
        e.preventDefault();
        Swal.fire({
            title: 'Konfirmasi Pendaftaran',
            text: 'Apakah Anda yakin ingin mengirim data pendaftaran ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Kirim!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
    // SweetAlert2 CDN
    if (typeof Swal === 'undefined') {
        var script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
        script.defer = true;
        document.head.appendChild(script);
    }
</script>
@endpush