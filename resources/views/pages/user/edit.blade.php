<!DOCTYPE html>
<html lang="en">

<head>
    {{-- START CSS --}}
    @include('layouts.guest.css')
    {{-- END CSS --}}


</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        {{-- START HEADER --}}
        <!-- Navbar & Hero Start -->
        @include('layouts.guest.header')
        <!-- Navbar & Hero End -->
        {{-- END HEADER --}}

        <!-- Content Start -->
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
                                <!-- User Info Card -->
                                <div class="card user-info-card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <small class="text-muted">Email</small>
                                                <p class="mb-0 fw-bold">{{ $dataUser->email }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted">Tanggal Dibuat</small>
                                                <p class="mb-0 fw-bold">{{ $dataUser->created_at->format('d/m/Y H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('users.update', $dataUser->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
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

                                        <div class="col-md-6 mb-4">
                                            <label for="password" class="form-label">Password Baru</label>
                                            <div class="input-group">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" name="password"
                                                    placeholder="Kosongkan jika tidak ingin mengubah">
                                                <span class="input-group-text password-toggle" id="togglePassword">
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <label for="password_confirmation" class="form-label">Konfirmasi Password
                                                Baru</label>
                                            <div class="input-group">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password_confirmation" name="password_confirmation"
                                                    placeholder="Kosongkan jika tidak ingin mengubah">
                                                <span class="input-group-text password-toggle"
                                                    id="togglePasswordConfirmation">
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
                                                    Jika tidak, biarkan kolom password kosong.
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
        <!-- Content End -->

        <!-- Footer Start -->
        @include('layouts.guest.footer')
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="https://faq.whatsapp.com/5913398998672934/?locale=en_US" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i
            </i><img src="{{ asset(path: 'assets-guest/img/IconWa.png') }}" alt="{{ __('') }}"></a>


    {{-- START JS --}}
    @include('layouts.guest.js')
    {{-- END JS --}}


</body>

</html>
