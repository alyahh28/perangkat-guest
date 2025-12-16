{{-- start css --}}
@include('layouts.guest.css')
{{-- Custom CSS untuk Halaman Ini --}}
<style>
    /* Card Styles */
    .modern-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        overflow: hidden;
        height: 100%;
        border: 1px solid #e9ecef;
        display: flex;
        flex-direction: column;
    }

    .modern-card:hover {
        box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        transform: translateY(-5px);
        border-color: #dee2e6;
    }

    /* Header Section inside Card */
    .card-header-section {
        display: flex;
        align-items: center;
        padding: 20px;
        background: linear-gradient(to right, #f8f9fa, #ffffff);
        border-bottom: 1px solid #f0f0f0;
    }

    .card-icon {
        flex-shrink: 0;
        margin-right: 15px;
    }

    /* Logo Styling */
    .logo-img {
        width: 60px;
        height: 60px;
        object-fit: cover; /* Mencegah gambar gepeng */
        border-radius: 12px;
        border: 1px solid #dee2e6;
        background: #fff;
    }

    .default-logo-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
    }

    /* Title & Text */
    .card-title-section {
        flex: 1;
        overflow: hidden;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-subtitle {
        font-size: 0.8rem;
        color: #718096;
        margin: 0;
        display: flex;
        align-items: center;
    }

    /* Body Section */
    .card-body-section {
        padding: 20px;
        flex: 1; /* Agar footer selalu di bawah */
    }

    .info-grid {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.9rem;
        border-bottom: 1px dashed #f0f0f0;
        padding-bottom: 8px;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #4a5568;
    }

    .info-value {
        color: #718096;
        text-align: right;
        max-width: 60%;
    }

    /* Footer & Buttons */
    .card-footer-section {
        padding: 15px 20px;
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }

    .action-buttons {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr; /* 3 Tombol sejajar */
        gap: 8px;
    }

    .btn-action {
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 12px;
        font-size: 0.85rem;
    }

    /* Empty State */
    .empty-state {
        background: #fff;
        border-radius: 16px;
        padding: 60px 20px;
        border: 2px dashed #cbd5e0;
    }
</style>
{{-- end css --}}

{{-- start header --}}
@include('layouts.guest.header')
{{-- end header --}}

{{-- start content --}}
<div class="container-xxl py-5">
    <div class="container px-lg-4">

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
                <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5">
            <div class="mb-3 mb-md-0">
                <h1 class="fw-bold text-dark">PERANGKAT & LEMBAGA</h1>
                <p class="text-muted mb-0">Portal Desa Mandiri - Melayani dengan Sepenuh Hati</p>
            </div>
            <a href="{{ route('lembaga.create') }}" class="btn btn-primary shadow-sm px-4 py-2 rounded-pill">
                <i class="fa fa-plus me-2"></i>Tambah Lembaga
            </a>
        </div>

        <div class="card border-0 shadow-sm mb-5 rounded-3">
            <div class="card-body p-2">
                <form method="GET" action="{{ route('lembaga.index') }}">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-0 ps-3">
                            <i class="fa fa-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-0 shadow-none"
                            value="{{ request('search') }}"
                            placeholder="Cari nama lembaga, deskripsi, atau kontak..."
                            aria-label="Search">

                        <button type="submit" class="btn btn-primary px-4 rounded-end">Cari</button>

                        @if (request()->has('search'))
                            <a href="{{ route('lembaga.index') }}" class="btn btn-light border-start text-danger" title="Reset">
                                <i class="fa fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="mb-4">
            <h3 class="fw-bold text-secondary border-start border-4 border-primary ps-3">Daftar Lembaga</h3>
        </div>

        <div class="row g-4">
            {{-- Menggunakan @forelse untuk menangani loop sekaligus kondisi kosong --}}
            @forelse ($lembaga as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="modern-card">
                        {{-- Card Header --}}
                        <div class="card-header-section">
                            <div class="card-icon">
                                @if($item->logo)
                                    {{-- Pastikan path storage/logos/ benar --}}
                                    <img src="{{ asset('storage/logos/' . $item->logo) }}"
                                         alt="{{ $item->nama_lembaga }}"
                                         class="logo-img"
                                         onerror="this.onerror=null; this.src='{{ asset('assets/img/default-logo.png') }}'; this.parentElement.innerHTML='<div class=\'default-logo-icon\'><i class=\'fa fa-building\'></i></div>'">
                                @else
                                    <div class="default-logo-icon">
                                        <i class="fa fa-building"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="card-title-section">
                                <h4 class="card-title" title="{{ $item->nama_lembaga }}">{{ $item->nama_lembaga }}</h4>
                                <p class="card-subtitle"><i class="fa fa-hashtag me-1 text-xs"></i> ID: {{ $item->lembaga_id }}</p>
                            </div>
                        </div>

                        {{-- Card Body --}}
                        <div class="card-body-section">
                            <div class="info-grid">
                                <div class="info-row">
                                    <span class="info-label">Kontak</span>
                                    <span class="info-value text-truncate">{{ $item->kontak ?? '-' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Deskripsi</span>
                                    <span class="info-value text-truncate" title="{{ $item->deskripsi }}">
                                        {{ Str::limit($item->deskripsi ?? 'Tidak ada deskripsi', 30) }}
                                    </span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Tanggal Dibuat</span>
                                    <span class="info-value">{{ $item->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Card Footer / Actions --}}
                        <div class="card-footer-section">
                            <div class="action-buttons">
                                <a href="{{ route('lembaga.show', $item->lembaga_id) }}" class="btn btn-outline-primary btn-sm btn-action">
                                    <i class="fa fa-eye me-1"></i> Detail
                                </a>
                                <a href="{{ route('lembaga.edit', $item->lembaga_id) }}" class="btn btn-outline-warning btn-sm btn-action">
                                    <i class="fa fa-edit me-1"></i> Edit
                                </a>
                                <form action="{{ route('lembaga.destroy', $item->lembaga_id) }}" method="POST" class="d-grid">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-action"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data {{ $item->nama_lembaga }}?')">
                                        <i class="fa fa-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Tampilan Kosong (Empty State) --}}
                <div class="col-12">
                    <div class="empty-state text-center">
                        <div class="mb-4">
                            <i class="fa fa-folder-open fa-4x text-muted opacity-50"></i>
                        </div>
                        <h4 class="text-dark fw-bold">Data Tidak Ditemukan</h4>
                        <p class="text-muted mb-4">Belum ada data lembaga yang tersedia atau pencarian tidak ditemukan.</p>
                        @if(request('search'))
                            <a href="{{ route('lembaga.index') }}" class="btn btn-outline-secondary">
                                <i class="fa fa-arrow-left me-2"></i>Kembali ke Semua Data
                            </a>
                        @else
                            <a href="{{ route('lembaga.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus me-2"></i>Tambah Data Baru
                            </a>
                        @endif
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $lembaga->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
{{-- end content --}}

@include('layouts.guest.footer')
{{-- START JS --}}
@include('layouts.guest.js')
