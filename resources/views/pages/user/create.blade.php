@extends('layouts.guest.app')

@section('content')
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card form-card shadow">
                        <div class="card-header bg-primary text-white">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-user-plus fa-2x me-3"></i>
                                <div>
                                    <h4 class="mb-0 text-white">Tambah User Baru</h4>
                                    <small class="opacity-75">Formulir pendaftaran pengguna sistem</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    {{-- NAMA LENGKAP --}}
                                    <div class="col-12 mb-4">
                                        <label for="name" class="form-label required-field">Nama Lengkap</label>
                                        <input type="text"
                                            class="form-control @error('name') is-invalid @enderror" id="name"
                                            name="name" value="{{ old('name') }}"
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
                                            name="email" value="{{ old('email') }}"
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
                                            value="{{ old('username') }}"
                                            placeholder="Masukkan username" required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- ROLE PENGGUNA --}}
                                    <div class="col-12 mb-4">
                                        <label class="form-label required-field">Role Pengguna</label>
                                        <select name="role"
                                            class="form-control @error('role') is-invalid @enderror" required>
                                            <option value="" disabled selected>Pilih Role...</option>
                                            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="Warga" {{ old('role') == 'Warga' ? 'selected' : '' }}>Warga</option>
                                            <option value="User"  {{ old('role') == 'User' ? 'selected' : '' }}>User</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- PASSWORD --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="password" class="form-label required-field">Password</label>
                                        <div class="input-group">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password"
                                                placeholder="Masukkan password" required>
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
                                        <label for="password_confirmation" class="form-label required-field">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation"
                                                placeholder="Ulangi password" required>
                                            <span class="input-group-text password-toggle"
                                                id="togglePasswordConfirmation" style="cursor: pointer;">
                                                <i class="fa fa-eye"></i>
                                            </span>
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
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save me-2"></i>Simpan User
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
