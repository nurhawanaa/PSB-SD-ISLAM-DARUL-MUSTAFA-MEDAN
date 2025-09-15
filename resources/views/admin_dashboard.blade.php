<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body style="background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%); min-height:100vh;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-gradient bg-primary text-white text-center rounded-top">
                        <h2 class="mb-1"><i class="bi bi-person-badge me-2"></i>Dashboard Admin</h2>
                        <span class="fw-light">{{ config('app.name') }}</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="card text-bg-info mb-3 shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><i class="bi bi-person-lines-fill me-2"></i>Total Pendaftar</h5>
                                        <h2>{{ $total_pendaftar }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-bg-success mb-3 shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><i class="bi bi-check2-circle me-2"></i>Siswa Lulus</h5>
                                        <h2>{{ $total_lulus }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-bg-warning mb-3 shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><i class="bi bi-hourglass-split me-2"></i>Belum Lulus</h5>
                                        <h2>{{ $total_belum_lulus }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <a href="{{ route('admin.logout') }}" class="btn btn-danger">
                                <i class="bi bi-box-arrow-right me-1"></i>Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>