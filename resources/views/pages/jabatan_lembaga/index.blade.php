{{-- start css --}}
@include('layouts.guest.css')
{{-- end css --}}

{{-- start header --}}
@include('layouts.guest.header')
{{-- end header --}}

{{-- start content --}}
<div class="container-xxl py-4">
    <div class="container px-lg-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Header Section -->
        <div class="page-header mb-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="page-title">JABATAN LEMBAGA</h1>
                    <p class="page-subtitle">Portal Desa Mandiri - Midsipant dengan Sepenuh Hati</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('jabatan-lembaga.create') }}" class="btn btn-primary btn-add">
                        <i class="fa fa-plus me-2"></i>Tambah Jabatan Baru
                    </a>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="content-section">
            <div class="section-header mb-4">
                <h3 class="section-title">Daftar Jabatan</h3>
                <p class="section-subtitle">Kelola semua jabatan dalam lembaga desa</p>
            </div>

            @if($jabatan->count() > 0)
                <div class="row g-4">
                    @foreach ($jabatan as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="modern-card">
                                <div class="card-header-section">
                                    <div class="card-icon">
                                        <i class="fa fa-user-tie"></i>
                                    </div>
                                    <div class="card-title-section">
                                        <h4 class="card-title">{{ $item->nama_jabatan }}</h4>
                                        <p class="card-subtitle">Level {{ $item->level }}</p>
                                    </div>
                                </div>

                                <div class="card-divider"></div>

                                <div class="card-body-section">
                                    <div class="info-grid">
                                        <div class="info-row">
                                            <span class="info-label">Lembaga:</span>
                                            <span class="info-value">{{ $item->lembaga->nama_lembaga }}</span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label">ID Jabatan:</span>
                                            <span class="info-value">#{{ $item->jabatan_id }}</span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label">Level:</span>
                                            <span class="info-value">
                                                <span class="level-badge level-{{ $item->level }}">
                                                    Level {{ $item->level }}
                                                </span>
                                            </span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label">Dibuat:</span>
                                            <span class="info-value">{{ $item->created_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer-section">
                                    <div class="action-buttons">
                                        <a href="{{ route('jabatan-lembaga.show', $item->jabatan_id) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-eye me-1"></i>Detail
                                        </a>
                                        <a href="{{ route('jabatan-lembaga.edit', $item->jabatan_id) }}" class="btn btn-outline-warning btn-sm">
                                            <i class="fa fa-edit me-1"></i>Edit
                                        </a>
                                        <form action="{{ route('jabatan-lembaga.destroy', $item->jabatan_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus jabatan ini?')">
                                                <i class="fa fa-trash me-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state text-center py-5">
                    <div class="empty-icon mb-4">
                        <i class="fa fa-user-tie fa-4x text-muted"></i>
                    </div>
                    <h3 class="mb-3">Belum Ada Data Jabatan</h3>
                    <p class="text-muted mb-4">Silakan tambah data jabatan lembaga terlebih dahulu</p>
                    <a href="{{ route('jabatan-lembaga.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus me-2"></i>Tambah Jabatan Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
{{-- end content --}}

<!-- Footer Start -->
@include('layouts.guest.footer')
<!-- Footer End -->

{{-- START JS --}}
@include('layouts.guest.js')


