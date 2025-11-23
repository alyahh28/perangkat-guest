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
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="position-relative d-inline text-primary ps-4">Data Kependudukan</h6>
                    <h2 class="mt-2">Profil Warga Desa</h2>
                    <p class="mb-0">Data lengkap warga desa kami yang aktif dan produktif</p>
                </div>

                <div class="table-responsive">
                    <form method="GET" action="{{ route('warga.index') }}" class="mb-3">
                        <div class="row">
                            <!-- Filter Jenis Kelamin -->
                            <div class="col-md-2">
                                <select name="jenis_kelamin" class="form-select">
                                    <option value="">Semua Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <!-- Search Input -->
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        value="{{ request('search') }}" placeholder="Cari nama, NIK, atau pekerjaan..."
                                        aria-label="Search">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    @if(request()->has('search') || request()->has('jenis_kelamin'))
                                    <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary">
                                        <i class="fa fa-times"></i> Clear
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Widget Data Warga -->
                <div class="row g-4">
                    @forelse ($dataWarga as $warga)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-primary text-white py-3">
                                    <h6 class="mb-0 text-center">{{ $warga->nama }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width: 80px; height: 80px;">
                                            <i class="fa fa-user text-white fa-2x"></i>
                                        </div>
                                    </div>

                                    <div class="warga-info">
                                        <div class="d-flex justify-content-between border-bottom py-2">
                                            <span class="text-muted">NIK</span>
                                            <span class="fw-bold">{{ $warga->no_ktp }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom py-2">
                                            <span class="text-muted">Jenis Kelamin</span>
                                            <span class="fw-bold">{{ $warga->jenis_kelamin }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom py-2">
                                            <span class="text-muted">Agama</span>
                                            <span class="fw-bold">{{ $warga->agama }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom py-2">
                                            <span class="text-muted">Pekerjaan</span>
                                            <span class="fw-bold">{{ $warga->pekerjaan }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between py-2">
                                            <span class="text-muted">Kontak</span>
                                            <span class="fw-bold">{{ $warga->telp }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-0 text-center">
                                    <a href="mailto:{{ $warga->email }}"
                                        class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fa fa-envelope me-1"></i>Email
                                    </a>
                                    <a href="{{ route('warga.edit', $warga->warga_id) }}"
                                        class="btn btn-sm btn-outline-warning me-2">
                                        <i class="fa fa-edit me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('warga.destroy', $warga->warga_id) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fa fa-trash me-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body py-5">
                                    <i class="fa fa-users fa-3x text-muted mb-3"></i>
                                    <h4 class="text-muted">Belum Ada Data Warga</h4>
                                    <p class="text-muted">Silakan tambah data warga terlebih dahulu</p>
                                    <a href="{{ route('warga.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus me-2"></i>Tambah Warga Pertama
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $dataWarga->links('pagination::bootstrap-5') }}
                </div>

                <!-- Tombol Tambah -->
                <div class="text-center mt-5">
                    <a href="{{ route('warga.create') }}" class="btn btn-primary btn-lg">
                        <i class="fa fa-plus me-2"></i>Tambah Data Warga Baru
                    </a>
                </div>
            </div>
        </div>
        <!-- Content End -->

        <!-- Footer Start -->
        @include('layouts.guest.footer')
        <!-- Footer End -->
    </div>

    {{-- START JS --}}
    @include('layouts.guest.js')
    {{-- END JS --}}
</body>
</html>
