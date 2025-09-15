@extends('layouts.app')

@section('title', 'Login Admin - ' . config('app.name'))

@section('content')
<div class="container pt-4 pb-4">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient bg-primary text-white text-center rounded-top">
                    <h2 class="mb-1"><i class="bi bi-person-lock me-2"></i>Login Admin</h2>
                    <span class="fw-light">{{ config('app.name') }}</span>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach($errors->all() as $error)
                        <div><i class="bi bi-exclamation-triangle me-2"></i>{{ $error }}</div>
                        @endforeach
                    </div>
                    @endif
                    <form method="POST" action="{{ route('admin.login.submit') }}" autocomplete="on">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><i class="bi bi-person-fill me-1"></i>Email</label>
                            <input type="email" name="email" class="form-control" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><i class="bi bi-key-fill me-1"></i>Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="adminPassword" required>
                                <button type="button" class="btn btn-outline-secondary" tabindex="-1" onclick="toggleAdminPassword()">
                                    <i class="bi bi-eye" id="adminPasswordIcon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-success btn-lg shadow-sm">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleAdminPassword() {
        const input = document.getElementById('adminPassword');
        const icon = document.getElementById('adminPasswordIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>
@endsection