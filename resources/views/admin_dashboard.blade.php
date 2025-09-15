@extends('layouts.app')

@section('title', 'Dashboard Admin - ' . config('app.name'))

@section('content')
<div class="container-fluid pt-4 pb-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient bg-primary text-white text-center rounded-top">
                    <h2 class="mb-1"><i class="bi bi-person-badge me-2"></i>Dashboard Admin</h2>
                    <span class="fw-light">{{ config('app.name') }}</span>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card text-bg-info mb-3 shadow-sm">
                                <div class="card-body text-center text-dark">
                                    <h5 class="card-title"><i class="bi bi-person-lines-fill me-2"></i>Total Pendaftar</h5>
                                    <h2>{{ $total_pendaftar }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-bg-success mb-3 shadow-sm">
                                <div class="card-body text-center text-dark">
                                    <h5 class="card-title"><i class="bi bi-check2-circle me-2"></i>Siswa Lulus</h5>
                                    <h2>{{ $total_lulus }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-bg-warning mb-3 shadow-sm">
                                <div class="card-body text-center text-dark">
                                    <h5 class="card-title"><i class="bi bi-hourglass-split me-2"></i>Belum Lulus</h5>
                                    <h2>{{ $total_belum_lulus }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection