@extends('layouts.app')

@section('title', 'Dashboard Admin - ' . config('app.name'))

@section('content')
<div class="container-fluid pt-1 pb-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient bg-primary text-white text-center rounded-top">
                    <h2 class="mb-1"><i class="bi bi-person-badge me-2"></i>Dashboard Admin</h2>
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
</div>
@endsection