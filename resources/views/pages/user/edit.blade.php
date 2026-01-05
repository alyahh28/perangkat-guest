@extends('layouts.guest.app')

@section('content')
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card form-card shadow">
                        <div class="card-header bg-warning text-white">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-user-edit fa-2x me-3"></i>
                                <div>
                                    <h4 class="mb-0">Form Edit User</h4>
                                    <small class="opacity-75">Edit data user {{ $dataUser->name }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="card user-info-card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <small class="text-muted">Email</small>
                                            <p class="mb-0 fw-bold">{{ $dataUser->email }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="text-muted">Tanggal Dibuat</small>
                                            <p class="mb-0 fw-bold">{{ $dataUser->created_at ? $dataUser->created_at->format('d/m/Y H:i') : '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('users.update', $dataUser->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    {{-- NAMA LENGKAP --}}
                                    <div class="col-12 mb-4">
                                        <label for="name" class="form-label required-field">Nama Lengkap</label>
                                        <input type="text"
                                            class="form-control @error('name') is-invalid @enderror" id="name"
                                            name="name" value="{{ old('name', $dataUser->name) }}"
                                            placeholder="Masukkan nama lengkap user" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- EMAIL --}}
                                    <div class="col-12 mb-4">
                                        <label for="email" class="form-label required-field">Alamat Email</label>
                                        <input type="email"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            name="email" value="{{ old('email', $dataUser->email) }}"
                                            placeholder="contoh@email.com" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- USERNAME --}}
                                    <div class="col-12 mb-4">
                                        <label for="username" class="form-label required-field">Username</label>
                                        <input type="text"
                                            class="form-control @error('username') is-invalid @enderror"
                                            id="username" name="username"
                                            value="{{ old('username', $dataUser->username) }}"
                                            placeholder="Masukkan username" required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- ROLE PENGGUNA --}}
                                    <div class="col-12 mb-4">
                                        <label class="form-label">Role Pengguna</label>
                                        <select name="role"
                                            class="form-control @error('role') is-invalid @enderror">
                                            <option value="User"
                                                {{ old('role', $dataUser->role) == 'User' ? 'selected' : '' }}>User
                                            </option>
                                            <option value="Warga"
                                                {{ old('role', $dataUser->role) == 'Warga' ? 'selected' : '' }}>
                                                Warga</option>
                                            <option value="Admin"
                                                {{ old('role', $dataUser->role) == 'Admin' ? 'selected' : '' }}>
                                                Admin</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- PASSWORD --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="password" class="form-label">Password Baru</label>
                                        <div class="input-group">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password"
                                                placeholder="Kosongkan jika tidak ingin mengubah">
                                            <span class="input-group-text password-toggle" id="togglePassword"
                                                style="cursor: pointer;">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- KONFIRMASI PASSWORD --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password
                                            Baru</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation"
                                                placeholder="Kosongkan jika tidak ingin mengubah">
                                            <span class="input-group-text password-toggle"
                                                id="togglePasswordConfirmation" style="cursor: pointer;">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="alert alert-info">
                                            <small>
                                                <i class="fa fa-info-circle me-2"></i>
                                                <strong>Informasi:</strong> Password hanya perlu diisi jika ingin
                                                mengubah password.
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                        <i class="fa fa-arrow-left me-2"></i>Kembali ke Daftar
                                    </a>
                                    <div>
                                        <button type="reset" class="btn btn-outline-secondary me-2">
                                            <i class="fa fa-undo me-2"></i>Reset
                                        </button>
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fa fa-save me-2"></i>Update User
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script untuk Toggle Password
        document.getElementById('togglePassword').addEventListener('click', function(e) {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });

        document.getElementById('togglePasswordConfirmation').addEventListener('click', function(e) {
            const password = document.getElementById('password_confirmation');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
@endsection
