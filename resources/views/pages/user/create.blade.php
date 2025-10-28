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
                            <div class="card-header bg-primary text-white">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-user-plus fa-2x me-3"></i>
                                    <div>
                                        <h4 class="mb-0">Form Tambah User</h4>
                                        <small class="opacity-75">Tambahkan user baru ke sistem</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <form action="{{ route('users.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
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

                                        <div class="col-md-6 mb-4">
                                            <label for="password" class="form-label required-field">Password</label>
                                            <div class="input-group">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" name="password" required>
                                                <span class="input-group-text password-toggle" id="togglePassword">
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <label for="password_confirmation"
                                                class="form-label required-field">Konfirmasi Password</label>
                                            <div class="input-group">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password_confirmation" name="password_confirmation"
                                                    placeholder="Ulangi password" required>
                                                <span class="input-group-text password-toggle"
                                                    id="togglePasswordConfirmation">
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                        <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                            <i class="fa fa-arrow-left me-2"></i>Kembali ke Daftar
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save me-2"></i>Simpan User
                                        </button>
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

    </div>

    {{-- START JS --}}
    @include('layouts.guest.js')
    {{-- END JS --}}


</body>

</html>
