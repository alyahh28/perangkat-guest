
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

        <!-- Filter dan Search Form -->
        <div class="table-responsive">
            <form method="GET" action="{{ route('lembaga.index') }}" class="mb-3">
                <div class="row">
                    <!-- Search Input -->
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                value="{{ request('search') }}" placeholder="Cari nama lembaga, deskripsi, atau kontak..."
                                aria-label="Search">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>

                            <!-- Clear All Filters -->
                            @if (request()->has('search'))
                                <a href="{{ route('lembaga.index') }}" class="btn btn-outline-secondary">
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
                                        <!-- Tampilkan logo jika ada -->
                                        @if($item->logo)
                                            <img src="{{ asset('storage/logos/' . $item->logo) }}"
                                                 alt="Logo {{ $item->nama_lembaga }}"
                                                 class="logo-img"
                                                 onerror="this.onerror=null; this.src='{{ asset('storage/logos/default-logo.png') }}'; this.classList.add('default-logo')">
                                        @else
                                            <div class="default-logo-icon">
                                                <i class="fa fa-building"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-title-section">
                                        <h4 class="card-title">{{ $item->nama_lembaga }}</h4>
                                        <p class="card-subtitle">ID Lembaga {{ $item->lembaga_id }}</p>
                                    </div>
                                </div>

                                <div class="card-divider"></div>

                                <div class="card-body-section">
                                    <div class="info-grid">
                                        @if($item->logo)
                                        <div class="info-row">
                                            <span class="info-label">Logo:</span>
                                            <span class="info-value">
                                                <a href="{{ asset('storage/logos/' . $item->logo) }}" target="_blank" class="text-primary">
                                                    <i class="fa fa-image me-1"></i>Lihat Logo
                                                </a>
                                            </span>
                                        </div>
                                        @endif
                                        <div class="info-row">
                                            <span class="info-label">Kontak:</span>
                                            <span class="info-value">{{ $item->kontak ?? '-' }}</span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label">Deskripsi:</span>
                                            <span class="info-value">{{ $item->deskripsi ? Str::limit($item->deskripsi, 50) : 'Tidak ada deskripsi' }}</span>
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

        <!-- Pagination -->
        <div class="mt-4">
            {{ $lembaga->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
{{-- end content --}}

<!-- Footer Start -->
@include('layouts.guest.footer')
<!-- Footer End -->

{{-- START JS --}}
@include('layouts.guest.js')

<style>
    .modern-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
        border: 1px solid #e9ecef;
    }

    .modern-card:hover {
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        transform: translateY(-2px);
    }

    .card-header-section {
        display: flex;
        align-items: center;
        padding: 20px 20px 10px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .card-icon {
        margin-right: 15px;
        flex-shrink: 0;
    }

    .card-icon img.logo-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #dee2e6;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        background: white;
    }

    .card-icon img.default-logo {
        padding: 10px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .default-logo-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .card-title-section {
        flex: 1;
        min-width: 0;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-subtitle {
        font-size: 0.85rem;
        color: #6c757d;
        margin: 0;
    }

    .card-divider {
        height: 1px;
        background: linear-gradient(to right, transparent, #dee2e6, transparent);
        margin: 0 20px;
    }

    .card-body-section {
        padding: 15px 20px;
    }

    .info-grid {
        display: grid;
        gap: 8px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 4px 0;
    }

    .info-label {
        font-weight: 500;
        color: #495057;
        font-size: 0.85rem;
        min-width: 80px;
    }

    .info-value {
        color: #6c757d;
        font-size: 0.85rem;
        text-align: right;
        flex: 1;
        margin-left: 10px;
        word-break: break-word;
    }

    .card-footer-section {
        padding: 15px 20px 20px;
        border-top: 1px solid #f1f1f1;
        background: #f8f9fa;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .action-buttons .btn {
        font-size: 0.8rem;
        padding: 5px 10px;
        border-radius: 6px;
    }

    /* Empty State */
    .empty-state {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 60px 20px;
    }

    .empty-icon {
        color: #adb5bd;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .card-header-section {
            padding: 15px 15px 8px;
        }

        .card-body-section,
        .card-footer-section {
            padding: 12px 15px 15px;
        }

        .card-icon img.logo-img,
        .default-logo-icon {
            width: 50px;
            height: 50px;
            font-size: 20px;
        }

        .card-title {
            font-size: 1rem;
        }

        .action-buttons {
            justify-content: center;
        }

        .action-buttons .btn {
            flex: 1;
            min-width: 70px;
            text-align: center;
        }
    }

    @media (max-width: 576px) {
        .card-header-section {
            flex-direction: column;
            text-align: center;
        }

        .card-icon {
            margin-right: 0;
            margin-bottom: 10px;
        }

        .info-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .info-value {
            text-align: left;
            margin-left: 0;
            margin-top: 2px;
        }
    }
</style>

