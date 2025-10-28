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
        <!-- Content Start -->
        <div class="container-xxl py-5">
            <div class="container px-lg-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-lg">
                            <div class="card-header bg-gradient-warning text-white py-4">
                                <div class="text-center">
                                    <i class="fa fa-user-edit fa-2x mb-3"></i>
                                    <h4 class="mb-0">Edit Data User</h4>
                                    <p class="mb-0 mt-2">Perbarui informasi pengguna sistem</p>
                                </div>
                            </div>
                            <div class="card-body p-5">
                                <form action="{{ route('user.update', $dataUser->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <label for="name" class="form-label fw-bold">Nama Lengkap *</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-warning text-white">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="name" name="name"
                                                    value="{{ old('name', $dataUser->name) }}"
                                                    placeholder="Masukkan nama lengkap" required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 mb-4">
                                            <label for="email" class="form-label fw-bold">Alamat Email *</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-warning text-white">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="email" name="email"
                                                    value="{{ old('email', $dataUser->email) }}"
                                                    placeholder="contoh: user@desa.id" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <label for="password" class="form-label fw-bold">Password Baru</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-warning text-white">
                                                    <i class="fa fa-lock"></i>
                                                </span>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" name="password"
                                                    placeholder="Kosongkan jika tidak diubah">
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <small class="text-muted mt-2 d-block">
                                                <i class="fa fa-info-circle me-1"></i>
                                                Isi hanya jika ingin mengubah password
                                            </small>
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <label for="password_confirmation" class="form-label fw-bold">Konfirmasi
                                                Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-warning text-white">
                                                    <i class="fa fa-lock"></i>
                                                </span>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password_confirmation" name="password_confirmation"
                                                    placeholder="Ulangi password baru">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Info Alert -->
                                    <div class="alert alert-warning border-warning">
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-exclamation-triangle me-3 fa-lg"></i>
                                            <div>
                                                <h6 class="alert-heading mb-1">Perhatian!</h6>
                                                <p class="mb-0 small">
                                                    Password hanya perlu diisi jika ingin mengubah password user.
                                                    Jika tidak, biarkan kolom password kosong.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                                        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary btn-lg">
                                            <i class="fa fa-arrow-left me-2"></i>Kembali ke Daftar
                                        </a>
                                        <button type="submit" class="btn btn-warning btn-lg px-4">
                                            <i class="fa fa-save me-2"></i>Update User
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- User Info Card -->
                        <div class="card border-0 shadow-sm mt-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fa fa-calendar text-warning me-3"></i>
                                            <div>
                                                <small class="text-muted d-block">Tanggal Dibuat</small>
                                                <strong>{{ $dataUser->created_at->format('d F Y') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fa fa-clock text-warning me-3"></i>
                                            <div>
                                                <small class="text-muted d-block">Terakhir Diupdate</small>
                                                <strong>{{ $dataUser->updated_at->format('d F Y') }}</strong>
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
        <!-- Content End -->
        <!-- Content End -->

        <!-- Footer Start -->
        @include('layouts.guest.footer')
        <!-- Footer End -->

         <!-- Back to Top -->
        <a href="https://faq.whatsapp.com/5913398998672934/?locale=en_US" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i
            </i><img src="{{ asset(path: 'assets-guest/img/IconWa.png') }}" alt="{{ __('') }}"></a>

    </div>

    {{-- START JS --}}
    @include('layouts.guest.js')
    {{-- END JS --}}
</body>

</html>
