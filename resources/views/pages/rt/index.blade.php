@extends('layouts.guest.app')

@section('content')
<div class="container-xxl py-4">
    <div class="container px-lg-4">

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Header Halaman --}}
        <div class="page-header mb-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="page-title">DAFTAR RUKUN TETANGGA (RT)</h1>
                    <p class="page-subtitle">Data Pemerintahan Desa - Unit Terkecil</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('rt.create') }}" class="btn btn-primary btn-add">
                        <i class="fa fa-plus me-2"></i>Tambah RT Baru
                    </a>
                </div>
            </div>
        </div>

        {{-- Content Section --}}
        <div class="content-section">
            <div class="section-header mb-4">
                <h3 class="section-title">Data RT</h3>
                <p class="section-subtitle">Kelola data ketua RT dan induk RW</p>
            </div>

            @if($rts->count() > 0)
                <div class="row g-4">
                    @foreach($rts as $rt)
                        <div class="col-lg-4 col-md-6">
                            {{-- Mulai Card Modern --}}
                            <div class="modern-card">

                                {{-- HEADER CARD: Nama Ketua RT --}}
                                <div class="card-header-section">
                                    <div class="card-icon">
                                        <i class="fa fa-user-tie"></i>
                                    </div>
                                    <div class="card-title-section">
                                        <h4 class="card-title text-capitalize">{{ $rt->ketua_rt }}</h4>
                                        <p class="card-subtitle">Ketua RT</p>
                                    </div>
                                </div>

                                <div class="card-divider"></div>

                                {{-- BODY CARD: Informasi Detail --}}
                                <div class="card-body-section">
                                    <div class="info-grid">

                                        {{-- Baris 1: Nomor RT --}}
                                        <div class="info-row">
                                            <span class="info-label">Nomor RT:</span>
                                            <span class="info-value fw-bold badge bg-light text-primary border">
                                                RT {{ $rt->no_rt }}
                                            </span>
                                        </div>

                                        {{-- Baris 2: Induk RW (Relasi) --}}
                                        <div class="info-row">
                                            <span class="info-label">Induk Wilayah:</span>
                                            <span class="info-value fw-bold text-dark">
                                                RW {{ $rt->rw->no_rw ?? '-' }}
                                            </span>
                                        </div>

                                        {{-- Baris 3: Tanggal Daftar --}}
                                        <div class="info-row">
                                            <span class="info-label">Terdaftar:</span>
                                            <span class="info-value">{{ $rt->created_at ? $rt->created_at->format('d M Y') : '-' }}</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- FOOTER CARD: Tombol Aksi --}}
                                <div class="card-footer-section">
                                    <div class="action-buttons">
                                        <a href="{{ route('rt.edit', $rt->id) }}" class="btn btn-outline-warning btn-sm">
                                            <i class="fa fa-edit me-1"></i>Edit
                                        </a>

                                        <form action="{{ route('rt.destroy', $rt->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Yakin hapus data Ketua RT {{ $rt->ketua_rt }} (RT {{ $rt->no_rt }})?')">
                                                <i class="fa fa-trash me-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            {{-- Selesai Card --}}
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Empty State (Jika Data Kosong) --}}
                <div class="empty-state text-center py-5">
                    <div class="empty-icon mb-4">
                        <i class="fa fa-users fa-4x text-muted"></i>
                    </div>
                    <h3 class="mb-3">Belum Ada Data RT</h3>
                    <p class="text-muted mb-4">Silakan tambah data RT terlebih dahulu</p>
                    <a href="{{ route('rt.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus me-2"></i>Tambah RT Pertama
                    </a>
                </div>
            @endif
        </div>

        {{-- Pagination --}}
          <div class="mt-4">
                    {{ $rts->links('pagination::bootstrap-5') }}
                </div>
    </div>
</div>
@endsection
