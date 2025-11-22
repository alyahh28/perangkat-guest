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
                    <h1 class="page-title">PERANGKAT & LEMBAGA</h1>
                    <p class="page-subtitle">Portal Desa Mandiri - Midsipant dengan Sepenuh Hati</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('lembaga.create') }}" class="btn btn-primary btn-add">
                        <i class="fa fa-plus me-2"></i>Tambah Lembaga Baru
                    </a>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <form method="GET" action="{{ route('warga.index') }}" onchange="this.form.submit()" class="mb-3">
                <div class="row">
                    <div class="col-md-2">
                        <select name="gender" class="form-select">
                            <option value="">All Status</option>
                            <option value="Aktif" {{ request('Status') == 'Aktif' ? 'selected' : '' }}>
                                Aktif
                            </option>
                            <option value="Tidak Aktif" {{ request('Status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak
                                Aktif
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" id="exampleInputIconRight"
                                value="{{ request('search') }}" placeholder="Search" aria-label="Search">
                            <button type="submit" class="input-group-text" id="basic-addon2">
                                <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <!-- Content Section -->
        <div class="content-section">
            <div class="section-header mb-4">
                <h3 class="section-title">Daftar Lembaga</h3>
                <p class="section-subtitle">Kelola semua lembaga desa</p>
            </div>

            @if ($lembaga->count() > 0)
                <div class="row g-4">
                    @foreach ($lembaga as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="modern-card">
                                <div class="card-header-section">
                                    <div class="card-icon">
                                        <i class="fa fa-building"></i>
                                    </div>
                                    <div class="card-title-section">
                                        <h4 class="card-title">{{ $item->nama_lembaga }}</h4>
                                        <p class="card-subtitle">ID Lembaga {{ $item->lembaga_id }}</p>
                                    </div>
                                </div>

                                <div class="card-divider"></div>

                                <div class="card-body-section">
                                    <div class="info-grid">
                                        <div class="info-row">
                                            <span class="info-label">Kontak:</span>
                                            <span class="info-value">{{ $item->kontak ?? '-' }}</span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label">Deskripsi:</span>
                                            <span
                                                class="info-value">{{ $item->deskripsi ? Str::limit($item->deskripsi, 50) : 'Tidak ada deskripsi' }}</span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label">Dibuat:</span>
                                            <span class="info-value">{{ $item->created_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer-section">
                                    <div class="action-buttons">
                                        <a href="{{ route('lembaga.show', $item->lembaga_id) }}"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-eye me-1"></i>Detail
                                        </a>
                                        <a href="{{ route('lembaga.edit', $item->lembaga_id) }}"
                                            class="btn btn-outline-warning btn-sm">
                                            <i class="fa fa-edit me-1"></i>Edit
                                        </a>
                                        <form action="{{ route('lembaga.destroy', $item->lembaga_id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus lembaga ini?')">
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
                        <i class="fa fa-building fa-4x text-muted"></i>
                    </div>
                    <h3 class="mb-3">Belum Ada Data Lembaga Desa</h3>
                    <p class="text-muted mb-4">Silakan tambah data lembaga desa terlebih dahulu</p>
                    <a href="{{ route('lembaga.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus me-2"></i>Tambah Lembaga Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
    <div class="mt-3">
        {{ $lembaga->links('pagination::bootstrap-5') }}
    </div>
</div>
{{-- end content --}}

<!-- Footer Start -->
@include('layouts.guest.footer')
<!-- Footer End -->

{{-- START JS --}}
@include('layouts.guest.js')
