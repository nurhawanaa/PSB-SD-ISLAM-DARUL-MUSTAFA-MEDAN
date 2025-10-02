<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('logosekolah.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body,
        html {
            font-family: 'Poppins', Arial, sans-serif;
        }

        .navbar {
            background: #fff !important;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            width: 100vw;
            left: 0;
            font-size: 1rem;
            padding: 0 !important;
            min-height: 56px;
            transition: background 0.2s;
        }

        .navbar .container-fluid {
            max-width: 100vw;
            padding-left: 24px;
            padding-right: 24px;
            display: flex;
            align-items: center;
            min-height: 56px;
        }

        .navbar-nav {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 0.5rem;
            min-height: 56px;
        }

        .navbar-nav .nav-link,
        .navbar-brand,
        .navbar-text {
            font-size: 1rem !important;
            line-height: 56px !important;
            vertical-align: middle !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            color: #222 !important;
            font-weight: 500;
            display: flex !important;
            align-items: center !important;
        }

        .navbar-nav .nav-item {
            display: flex;
            align-items: center;
            min-height: 56px;
        }

        .nav-link.active {
            color: #2563eb !important;
            font-weight: 600;
            background: #f3f4f6;
            border-radius: 6px;
        }

        .navbar .btn.logout {
            line-height: 1.7;
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
            margin-top: 0 !important;
            vertical-align: middle;
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

        .bi {
            vertical-align: middle;
            align-self: center !important;
            font-size: 1.15em !important;
            margin-bottom: 0 !important;
        }

        @media (max-width: 600px) {

            .navbar,
            .navbar .container-fluid {
                font-size: 13px !important;
                padding-left: 8px !important;
                padding-right: 8px !important;
                min-height: 48px;
            }

            .navbar-nav {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 0.5rem;
                min-height: 48px;
            }

            .navbar-nav .nav-link,
            .navbar-brand,
            .navbar-text {
                font-size: 13px !important;
                line-height: 48px !important;
            }

            .navbar-nav .nav-item {
                min-height: 48px;
            }

            .navbar .btn.logout {
                line-height: 1.5;
                padding-top: 0.15rem;
                padding-bottom: 0.15rem;
            }

            * {
                font-size: 12px;
            }

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

            .logout {
                margin-top: 12px;
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
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm position-fixed w-100 top-0" style="z-index:1040; padding:8px; border-bottom:1px solid #e5e7eb;">
        <div class="container-fluid d-flex align-items-center" style="min-height:56px;">
            <div class="navbar-brand fw-bold text-dark d-flex align-items-center">
                <i class="bi @yield('navbar_icon', 'bi-speedometer2') me-2"></i>@yield('navbar_title', 'Admin Dashboard')
            </div>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link @if(Route::currentRouteName() === 'admin.dashboard') active @endif text-dark d-flex align-items-center" href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door me-1"></i>Dashboard</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link @if(Route::currentRouteName() === 'admin.seleksi') active @endif text-dark d-flex align-items-center" href="{{ route('admin.seleksi') }}"><i class="bi bi-person-check me-1"></i>Penyeleksian</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link @if(Route::currentRouteName() === 'pendaftaran.lulus') active @endif text-dark d-flex align-items-center" href="{{ route('pendaftaran.lulus') }}"><i class="bi bi-list-check me-1"></i>Daftar Lulus</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 flex-lg-row flex-row align-items-center gap-2">
                    <li class="nav-item d-flex align-items-center justify-content-center gap-2 mb-0">
                        <span class="navbar-text text-dark d-flex align-items-center"><i class="bi bi-person-circle me-1"></i>{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
                        <form method="POST" action="{{ route('admin.logout') }}" class="d-flex align-items-center m-0 p-2" style="height:100%;">
                            @csrf
                            <button type="submit" class="btn btn-outline-dark btn-sm logout d-flex align-items-center m-0 p-2" style="height:40px;"><i class="bi bi-box-arrow-right me-1"></i>Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endif
    @yield('content')
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var navbarCollapse = document.getElementById('adminNavbar');
            var bsCollapse = window.bootstrap ? window.bootstrap.Collapse : (window.Collapse || bootstrap.Collapse);
            if (navbarCollapse) {
                navbarCollapse.addEventListener('click', function(e) {
                    var target = e.target;
                    if (target.classList.contains('nav-link') && window.innerWidth < 992 && navbarCollapse.classList.contains('show')) {
                        var collapse = new bsCollapse(navbarCollapse, {
                            toggle: false
                        });
                        collapse.hide();
                    }
                });
            }
        });
    </script>
</body>

</html>