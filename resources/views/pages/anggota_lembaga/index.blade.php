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
                    <h1 class="page-title">DAFTAR ANGGOTA LEMBAGA</h1>
                    <p class="page-subtitle">Data Personil & Struktur Kelembagaan Desa</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('anggota-lembaga.create') }}" class="btn btn-primary btn-add">
                        <i class="fa fa-plus me-2"></i>Tambah Anggota
                    </a>
                </div>
            </div>
        </div>

        {{-- Content Section --}}
        <div class="content-section">
            <div class="section-header mb-4">
                <h3 class="section-title">Personil Lembaga</h3>
                <p class="section-subtitle">Daftar nama dan jabatan anggota lembaga desa</p>
            </div>

            @if($anggotas->count() > 0)
                <div class="row g-4">
                    @foreach($anggotas as $anggota)
                        <div class="col-lg-4 col-md-6">
                            {{-- Mulai Card Modern --}}
                            <div class="modern-card">

                                {{-- HEADER CARD: Foto & Nama --}}
                                <div class="card-header-section">
                                    <div class="card-icon p-0 overflow-hidden" style="display: flex; justify-content: center; align-items: center;">
                                        {{-- Logika Menampilkan Foto --}}
                                        @if($anggota->foto)
                                            <img src="{{ asset('storage/' . $anggota->foto) }}"
                                                 alt="Foto"
                                                 style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($anggota->nama) }}&background=random&size=128"
                                                 alt="Avatar"
                                                 style="width: 100%; height: 100%; object-fit: cover;">
                                        @endif
                                    </div>
                                    <div class="card-title-section">
                                        <h4 class="card-title text-capitalize">{{ $anggota->nama }}</h4>
                                        {{-- Subtitle menampilkan Jabatan --}}
                                        <p class="card-subtitle">
                                            {{ $anggota->jabatan->nama_jabatan ?? 'Anggota' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="card-divider"></div>

                                {{-- BODY CARD: Informasi Detail --}}
                                <div class="card-body-section">
                                    <div class="info-grid">

                                        {{-- Baris 1: Lembaga --}}
                                        <div class="info-row">
                                            <span class="info-label">Lembaga:</span>
                                            <span class="info-value fw-bold text-primary">
                                                {{ $anggota->lembaga->nama_lembaga ?? '-' }}
                                            </span>
                                        </div>

                                        {{-- Baris 2: Nomor Anggota --}}
                                        <div class="info-row">
                                            <span class="info-label">No. Anggota:</span>
                                            <span class="info-value text-dark">
                                                {{ $anggota->nomor_anggota ?? '-' }}
                                            </span>
                                        </div>

                                        {{-- Baris 3: Tanggal Daftar --}}
                                        <div class="info-row">
                                            <span class="info-label">Terdaftar:</span>
                                            <span class="info-value">
                                                {{ $anggota->created_at ? $anggota->created_at->format('d M Y') : '-' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- FOOTER CARD: Tombol Aksi --}}
                                <div class="card-footer-section">
                                    <div class="action-buttons">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('anggota-lembaga.edit', $anggota->id) }}" class="btn btn-outline-warning btn-sm">
                                            <i class="fa fa-edit me-1"></i>Edit
                                        </a>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('anggota-lembaga.destroy', $anggota->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Yakin hapus anggota {{ $anggota->nama }}?')">
                                                <i class="fa fa-trash me-1"></i>Hapus
                                            </button>
                                        </form>

                                         <div class="action-buttons">
                                        <a href="{{ route('anggota-lembaga.show', $anggota->id) }}"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-eye me-1"></i>Detail
                                        </a>
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
                        <i class="fa fa-id-card fa-4x text-muted"></i>
                    </div>
                    <h3 class="mb-3">Belum Ada Data Anggota</h3>
                    <p class="text-muted mb-4">Silakan tambah data anggota lembaga terlebih dahulu</p>
                    <a href="{{ route('anggota-lembaga.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus me-2"></i>Tambah Anggota Pertama
                    </a>
                </div>
            @endif
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $anggotas->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
