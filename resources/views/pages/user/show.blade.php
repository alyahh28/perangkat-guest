<!DOCTYPE html>
<html lang="en">

<head>
    {{-- START CSS --}}
    @include('layouts.guest.css')
    {{-- END CSS --}}
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        {{-- START HEADER --}}
        @include('layouts.guest.header')
        {{-- END HEADER --}}

        <div class="container-xxl py-5">
            <div class="container px-lg-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card form-card shadow border-0">
                            {{-- Header Card --}}
                            <div class="card-header bg-info text-white">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-id-card fa-2x me-3"></i>
                                        <div>
                                            <h4 class="mb-0 text-white">Detail User</h4>
                                            <small class="opacity-75">Informasi lengkap pengguna</small>
                                        </div>
                                    </div>
                                    {{-- Status Badge di Header --}}
                                    <span class="badge bg-white text-info fw-bold px-3 py-2 rounded-pill">
                                        {{ $user->role ?? 'User' }}
                                    </span>
                                </div>
                            </div>

                            <div class="card-body p-4">
                                {{-- Avatar / Icon Placeholder --}}
                                <div class="text-center mb-4">
                                    <div class="d-inline-block rounded-circle bg-light p-4 shadow-sm">
                                        <i class="fa fa-user fa-4x text-info"></i>
                                    </div>
                                    <h3 class="mt-3 mb-1">{{ $user->name }}</h3>
                                    <p class="text-muted">{{ $user->email }}</p>
                                </div>

                                <hr>

                                {{-- Informasi Detail --}}
                                <div class="row g-4 mt-2">
                                    {{-- Username --}}
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light rounded h-100">
                                            <small class="text-muted text-uppercase fw-bold d-block mb-1">Username</small>
                                            <span class="fs-5 text-dark fw-bold">{{ $user->username }}</span>
                                        </div>
                                    </div>

                                    {{-- Role --}}
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light rounded h-100">
                                            <small class="text-muted text-uppercase fw-bold d-block mb-1">Role Akses</small>
                                            <span class="fs-5 text-dark">{{ $user->role }}</span>
                                        </div>
                                    </div>

                                    {{-- Status Akun --}}
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light rounded h-100">
                                            <small class="text-muted text-uppercase fw-bold d-block mb-1">Status Akun</small>
                                            @if($user->activiti == 'Aktif')
                                                <span class="text-success fw-bold"><i class="fa fa-check-circle me-1"></i> Aktif</span>
                                            @else
                                                <span class="text-danger fw-bold"><i class="fa fa-times-circle me-1"></i> Tidak Aktif</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Tanggal Bergabung --}}
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light rounded h-100">
                                            <small class="text-muted text-uppercase fw-bold d-block mb-1">Tanggal Bergabung</small>
                                            <span class="text-dark">{{ $user->created_at->format('d F Y, H:i') }} WIB</span>
                                        </div>
                                    </div>

                                     {{-- Tanggal Update Terakhir --}}
                                     <div class="col-md-12">
                                        <div class="p-3 bg-light rounded h-100">
                                            <small class="text-muted text-uppercase fw-bold d-block mb-1">Terakhir Diupdate</small>
                                            <span class="text-dark">{{ $user->updated_at->format('d F Y, H:i') }} WIB</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Footer Actions --}}
                            <div class="card-footer bg-white p-4 border-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary px-4">
                                        <i class="fa fa-arrow-left me-2"></i>Kembali
                                    </a>

                                    <div class="d-flex gap-2">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning px-4 text-white">
                                            <i class="fa fa-edit me-2"></i>Edit
                                        </a>

                                        {{-- Tombol Hapus (Opsional di detail) --}}
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger px-4">
                                                <i class="fa fa-trash me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.guest.footer')
        </div>

    {{-- START JS --}}
    @include('layouts.guest.js')
    {{-- END JS --}}
</body>

</html>
