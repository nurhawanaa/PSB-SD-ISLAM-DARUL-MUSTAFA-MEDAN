<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: #f7f7f9;
            color: #222;
        }

        .container {
            max-width: 1000px;
        }

        .card {
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            border: 1px solid #e5e7eb;
        }

        .card-header {
            border-radius: 14px 14px 0 0;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            color: #222;
            font-weight: 600;
            font-size: 1.25rem;
        }

        .btn-primary,
        .btn-success {
            background: #222;
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            transition: background 0.2s;
        }

        .btn-primary:hover,
        .btn-success:hover {
            background: #444;
        }

        .form-control,
        textarea {
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            font-size: 1rem;
        }

        .form-label {
            font-weight: 500;
            color: #222;
            margin-bottom: 0.25rem;
        }

        .shadow-lg {
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06) !important;
        }

        .btn-lg {
            font-size: 1rem;
            padding: 0.6rem 1.2rem;
        }

        .card-body {
            background: #fff;
        }

        .alert {
            border-radius: 8px;
            font-size: 0.98rem;
        }

        .navbar {
            background: #fff !important;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .navbar-brand,
        .nav-link,
        .navbar-text {
            color: #222 !important;
            font-weight: 500;
        }

        .nav-link.active {
            color: #2563eb !important;
            font-weight: 600;
            background: #f3f4f6;
            border-radius: 6px;
        }

        .btn-outline-light {
            color: #222;
            border-color: #e5e7eb;
            background: #fff;
        }

        .btn-outline-light:hover {
            background: #f3f4f6;
            color: #2563eb;
        }

        .bi {
            vertical-align: middle;
        }

        @media (max-width: 600px) {
            .container {
                max-width: 100%;
                padding: 0 8px;
            }

            .card {
                border-radius: 8px;
            }

            .card-header {
                border-radius: 8px 8px 0 0;
                font-size: 1.1rem;
            }
        }
    </style>
    @stack('head')
</head>

<body style="background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%); min-height:100vh; padding-top:64px;">
    {{-- Navbar Admin --}}
    @hasSection('navbar')
    @yield('navbar')
    @elseif(Auth::guard('admin')->check())
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm position-fixed w-100 top-0" style="z-index:1040; padding:8px;">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @if(Route::currentRouteName() === 'admin.dashboard') active @endif" href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door me-1"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Route::currentRouteName() === 'admin.seleksi') active @endif" href="{{ route('admin.seleksi') }}"><i class="bi bi-person-check me-1"></i>Penyeleksian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Route::currentRouteName() === 'pendaftaran.lulus') active @endif" href="{{ route('pendaftaran.lulus') }}"><i class="bi bi-list-check me-1"></i>Daftar Lulus</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item mt-1">
                        <span class="navbar-text me-3"><i class="bi bi-person-circle me-1"></i>{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right me-1"></i>Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endif
    @yield('content')
    @stack('scripts')
</body>

</html>