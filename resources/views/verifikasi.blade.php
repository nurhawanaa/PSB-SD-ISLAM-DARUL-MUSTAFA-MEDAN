@extends('layouts.app')

@section('title', 'Verifikasi Pendaftaran - ' . config('app.name'))
@push('head')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush

@section('content')
<div class="container pt-4 pb-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient bg-primary text-white text-center rounded-top">
                    <h2 class="mb-1"><i class="bi bi-shield-check me-2"></i>Verifikasi Pendaftaran</h2>
                    <span class="fw-light">{{ config('app.name') }}</span>
                </div>
                <div class="card-body p-4 text-center">
                    <p class="mb-4 text-secondary fs-5"><i class="bi bi-info-circle me-2"></i>Silakan centang kotak di bawah untuk verifikasi keamanan sebelum melanjutkan ke form pendaftaran.</p>
                    <form id="captchaForm" method="POST" action="/pendaftaran/verify">
                        @csrf
                        <div class="mb-4 text-center">
                            <div class="g-recaptcha d-inline-block" data-sitekey="{{ config('services.recaptcha.site_key') }}" data-callback="enableSubmit"></div>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg w-100 shadow-sm" id="btnLanjut" disabled>
                            <i class="bi bi-arrow-right-circle me-2"></i>Lanjut ke Form Pendaftaran
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function enableSubmit() {
        document.getElementById('btnLanjut').disabled = false;
    }
</script>
</body>

</html>