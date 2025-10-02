@extends('layouts.app')

@section('title', 'Manajemen Akun Admin - ' . config('app.name'))
@section('navbar_title', 'Manajemen Admin')
@section('navbar_icon', 'bi-people-fill')

@section('content')
<div class="container-fluid pt-1 pb-4">
    <div class="card shadow-lg border-0 mb-4">
        <div class="card-header bg-gradient bg-info text-black d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="bi bi-people-fill me-2"></i>Manajemen Akun Admin</h4>
            <button type="button" class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalTambahAdmin">
                <i class="bi bi-person-plus"></i> Tambah Admin
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditAdmin{{ $admin->id }}"><i class="bi bi-pencil"></i></button>
                                <form method="POST" action="{{ route('admin.destroy', $admin->id) }}" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus admin ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <!-- Modal Edit Admin -->
                        <div class="modal fade" id="modalEditAdmin{{ $admin->id }}" tabindex="-1" aria-labelledby="modalEditAdminLabel{{ $admin->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning text-white">
                                        <h5 class="modal-title" id="modalEditAdminLabel{{ $admin->id }}"><i class="bi bi-pencil me-2"></i>Edit Admin</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('admin.update', $admin->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="name{{ $admin->id }}" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="name{{ $admin->id }}" name="name" value="{{ $admin->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email{{ $admin->id }}" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email{{ $admin->id }}" name="email" value="{{ $admin->email }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password{{ $admin->id }}" class="form-label">Password (isi jika ingin ganti)</label>
                                                <input type="password" class="form-control" id="password{{ $admin->id }}" name="password">
                                            </div>
                                            <button type="submit" class="btn btn-warning w-100">Simpan Perubahan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada admin terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Admin -->
    <div class="modal fade" id="modalTambahAdmin" tabindex="-1" aria-labelledby="modalTambahAdminLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalTambahAdminLabel"><i class="bi bi-person-plus me-2"></i>Tambah Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-1"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('admin.store') }}" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold"><i class="bi bi-person-fill me-1"></i>Nama Lengkap</label>
                            <input type="text" class="form-control shadow-sm" id="name" name="name" placeholder="Nama Admin" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold"><i class="bi bi-envelope-fill me-1"></i>Email</label>
                            <input type="email" class="form-control shadow-sm" id="email" name="email" placeholder="Email Admin" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold"><i class="bi bi-key-fill me-1"></i>Password</label>
                            <input type="password" class="form-control shadow-sm" id="password" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-info w-100 fw-bold d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-person-plus"></i> Tambah Admin
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection