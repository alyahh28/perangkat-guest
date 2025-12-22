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

        <div class="page-header mb-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="page-title">DAFTAR RUKUN WARGA (RW)</h1>
                    <p class="page-subtitle">Data Pemerintahan Desa - Struktur Wilayah</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('rw.create') }}" class="btn btn-primary btn-add">
                        <i class="fa fa-plus me-2"></i>Tambah RW Baru
                    </a>
                </div>
            </div>
        </div>

        <div class="content-section">
            <div class="section-header mb-4">
                <h3 class="section-title">Data RW</h3>
                <p class="section-subtitle">Kelola data ketua dan nomor RW</p>
            </div>

            @if($rws->count() > 0)
                <div class="row g-4">
                    @foreach($rws as $rw)
                        <div class="col-lg-4 col-md-6">
                            <div class="modern-card">
                                <div class="card-header-section">
                                    <div class="card-icon">
                                        <i class="fa fa-user-tie"></i> </div>
                                    <div class="card-title-section">
                                        {{-- PERUBAHAN 1: Nama Ketua RW sekarang ada di Judul Atas --}}
                                        <h4 class="card-title">{{ $rw->ketua_rw }}</h4>
                                        <p class="card-subtitle">Ketua RW</p>
                                    </div>
                                </div>

                                <div class="card-divider"></div>

                                <div class="card-body-section">
                                    <div class="info-grid">

                                        {{-- PERUBAHAN 2: Nomor RW sekarang ada di bagian Body (Bawah) --}}
                                        <div class="info-row">
                                            <span class="info-label">Nomor RW:</span>
                                            <span class="info-value fw-bold">RW {{ $rw->no_rw }}</span>
                                        </div>

                                        <div class="info-row">
                                            <span class="info-label">ID Sistem:</span>
                                            <span class="info-value">#{{ $rw->id }}</span>
                                        </div>

                                        <div class="info-row">
                                            <span class="info-label">Terdaftar:</span>
                                            <span class="info-value">{{ $rw->created_at ? $rw->created_at->format('d M Y') : '-' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer-section">
                                    <div class="action-buttons">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('rw.edit', $rw->id) }}" class="btn btn-outline-warning btn-sm">
                                            <i class="fa fa-edit me-1"></i>Edit
                                        </a>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('rw.destroy', $rw->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data RW {{ $rw->no_rw }}?')">
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
                        <i class="fa fa-users fa-4x text-muted"></i>
                    </div>
                    <h3 class="mb-3">Belum Ada Data RW</h3>
                    <p class="text-muted mb-4">Silakan tambah data RW terlebih dahulu</p>
                    <a href="{{ route('rw.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus me-2"></i>Tambah RW Pertama
                    </a>
                </div>
            @endif
        </div>

        <div class="mt-4">
            {{ $rws->links() }}
        </div>
    </div>
</div>
@endsection
