<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Siswa Baru - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body style="background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%); min-height:100vh;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-gradient bg-primary text-white text-center rounded-top">
                        <h2 class="mb-1"><i class="bi bi-person-plus-fill me-2"></i>Pendaftaran Siswa Baru</h2>
                        <span class="fw-light">{{ config('app.name') }}</span>
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
                        <form id="dataDiriForm" method="POST" action="/pendaftaran/simpan" autocomplete="off">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="bi bi-person-fill me-1"></i>Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" required placeholder="Nama lengkap siswa">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="bi bi-geo-alt-fill me-1"></i>Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control" required placeholder="Tempat lahir siswa">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="bi bi-calendar-date me-1"></i>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
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
                                <div class="col-12">
                                    <label class="form-label fw-semibold"><i class="bi bi-house-door-fill me-1"></i>Alamat</label>
                                    <textarea name="alamat" class="form-control" rows="2" required placeholder="Alamat lengkap siswa"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="bi bi-people-fill me-1"></i>Nama Orang Tua/Wali</label>
                                    <input type="text" name="ortu" class="form-control" required placeholder="Nama orang tua/wali">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="bi bi-telephone-fill me-1"></i>No. HP Orang Tua/Wali</label>
                                    <input type="number" name="hp_ortu" class="form-control" required placeholder="08123456789">
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-success btn-lg w-100 shadow-sm">
                                        <i class="bi bi-send-plus me-2"></i>Kirim Pendaftaran
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>