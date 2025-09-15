<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body style="background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%); min-height:100vh;">
    <div class="container py-5">
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
                        <form method="POST" action="{{ route('admin.login.submit') }}" autocomplete="off">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold"><i class="bi bi-person-fill me-1"></i>Email</label>
                                <input type="text" name="email" class="form-control" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold"><i class="bi bi-key-fill me-1"></i>Password</label>
                                <input type="password" name="password" class="form-control" required>
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
</body>

</html>