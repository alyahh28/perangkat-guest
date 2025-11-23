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

        <!-- Filter dan Search Form -->
        <div class="table-responsive">
            <form method="GET" action="{{ route('jabatan-lembaga.index') }}" class="mb-3">
                <div class="row">
                    <!-- Filter Lembaga -->
                    <div class="col-md-2">
                        <select name="lembaga_id" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Lembaga</option>
                            @foreach($lembagaList as $lembaga)
                                <option value="{{ $lembaga->lembaga_id }}"
                                    {{ request('lembaga_id') == $lembaga->lembaga_id ? 'selected' : '' }}>
                                    {{ $lembaga->nama_lembaga }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter Level -->
                    <div class="col-md-2">
                        <select name="level" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Level</option>
                            @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}"
                                    {{ request('level') == $i ? 'selected' : '' }}>
                                    Level {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <!-- Search Input -->
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                value="{{ request('search') }}" placeholder="Cari nama jabatan atau lembaga..."
                                aria-label="Search">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>

                            <!-- Clear All Filters -->
                            @if (request()->has('search') || request()->has('lembaga_id') || request()->has('level'))
                                <a href="{{ route('jabatan-lembaga.index') }}" class="btn btn-outline-secondary">
                                    <i class="fa fa-times"></i> Clear All
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Content Section -->
        <div class="content-section">
            <div class="section-header mb-4">
                <h3 class="section-title">Daftar Jabatan</h3>
                <p class="section-subtitle">Kelola semua jabatan dalam lembaga desa</p>
            </div>

            @if ($jabatan->count() > 0)
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
                                            <span
                                                class="info-value">{{ $item->lembaga ? $item->lembaga->nama_lembaga : 'Tidak ada lembaga' }}</span>
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
                                            <span
                                                class="info-value">{{ $item->created_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer-section">
                                    <div class="action-buttons">
                                        <a href="{{ route('jabatan-lembaga.show', $item->jabatan_id) }}"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-eye me-1"></i>Detail
                                        </a>
                                        <a href="{{ route('jabatan-lembaga.edit', $item->jabatan_id) }}"
                                            class="btn btn-outline-warning btn-sm">
                                            <i class="fa fa-edit me-1"></i>Edit
                                        </a>
                                        <form action="{{ route('jabatan-lembaga.destroy', $item->jabatan_id) }}"
                                            method="POST" class="d-inline">
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

        <!-- Pagination -->
        <div class="mt-4">
            {{ $jabatan->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
{{-- end content --}}

<!-- Footer Start -->
@include('layouts.guest.footer')
<!-- Footer End -->

{{-- START JS --}}
@include('layouts.guest.js')
