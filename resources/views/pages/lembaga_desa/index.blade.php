@extends('layouts.guest.app')

@section('content')
    <div class="container-fluid py-5">
        <div class="container px-lg-5">
            {{-- Alert --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show wow fadeInUp" data-wow-delay="0.1s" role="alert">
                    <i class="fa fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Statistics Cards --}}
            <div class="row g-4 mb-5">
                <div class="col-xl-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card border-0 shadow-sm h-100 p-2">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fa fa-building text-white fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['total_lembaga'] ?? 0 }}</h4>
                                <small class="text-muted">Total Lembaga</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="card border-0 shadow-sm h-100 p-2">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-success rounded d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fa fa-users text-white fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['total_anggota'] ?? 0 }}</h4>
                                <small class="text-muted">Total Anggota</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card border-0 shadow-sm h-100 p-2">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-info rounded d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fa fa-sitemap text-white fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['total_jabatan'] ?? 0 }}</h4>
                                <small class="text-muted">Posisi Jabatan</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="card border-0 shadow-sm h-100 p-2">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-warning rounded d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fa fa-calendar-plus text-white fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['lembaga_baru'] ?? 0 }}</h4>
                                <small class="text-muted">Lembaga Baru (1 Bln)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Title Section --}}
            <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="position-relative d-inline text-primary ps-4">Kelembagaan Desa</h6>
                <h2 class="mt-2">Daftar Lembaga Desa</h2>
            </div>

            {{-- Filter & Action --}}
            <div class="row g-4 mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-8">
                    <form method="GET" action="{{ route('lembaga.index') }}">
                        <div class="input-group">
                             <span class="input-group-text bg-white border-end-0">
                                <i class="fa fa-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0"
                                   value="{{ request('search') }}" placeholder="Cari nama lembaga, deskripsi, atau kontak..."
                                   aria-label="Search">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                            @if (request()->has('search'))
                                <a href="{{ route('lembaga.index') }}" class="btn btn-outline-secondary">
                                    <i class="fa fa-times"></i> Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('lembaga.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus me-2"></i>Tambah Lembaga
                    </a>
                </div>
            </div>

            {{-- Data Grid --}}
            <div class="row g-4">
                @forelse ($lembaga as $item)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden">
                            {{-- Header --}}
                            {{-- Header --}}
                            @php
                                $placeholder = asset('assets/images/general/placeholder.png');
                                // Priority: 1. Main Logo, 2. First Gallery Image, 3. Placeholder
                                if ($item->logo) {
                                    $logoSrc = asset('storage/logos/' . $item->logo);
                                } elseif ($item->galeri && $item->galeri->isNotEmpty()) {
                                    // Make sure to access the file_name correctly from the first item
                                    $logoSrc = asset('storage/uploads/' . $item->galeri->first()->file_name);
                                } else {
                                    $logoSrc = $placeholder;
                                }
                            @endphp
                            <div class="position-relative" style="height: 200px;">
                                <img src="{{ $logoSrc }}"
                                     alt="{{ $item->nama_lembaga }}"
                                     class="card-img-top w-100 h-100"
                                     style="object-fit: cover;"
                                     onerror="this.onerror=null; this.src='{{ $placeholder }}';">
                            </div>

                            <div class="card-body text-center pt-3 pb-0">
                                <h5 class="mb-1 text-truncate" title="{{ $item->nama_lembaga }}">
                                    {{ $item->nama_lembaga }}
                                </h5>
                                <p class="text-muted small mb-3">ID: {{ $item->lembaga_id }}</p>
                            </div>

                            {{-- Details --}}
                            <div class="card-body border-top bg-light">
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted"><i class="fa fa-phone me-1"></i> Kontak</span>
                                    <span class="fw-bold text-truncate" style="max-width: 150px;">{{ $item->kontak ?? '-' }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted"><i class="fa fa-info-circle me-1"></i> Deskripsi</span>
                                    <span class="fw-bold text-truncate" style="max-width: 150px;" title="{{ $item->deskripsi }}">
                                         {{ Str::limit($item->deskripsi ?? '-', 20) }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted"><i class="fa fa-calendar me-1"></i> Dibuat</span>
                                    <span class="fw-bold">
                                        {{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="card-footer bg-white border-top p-3">
                                <div class="d-flex gap-2">
                                     <a href="{{ route('lembaga.show', $item->lembaga_id) }}" class="btn btn-sm btn-outline-primary flex-fill" title="Detail">
                                        <i class="fa fa-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('lembaga.edit', $item->lembaga_id) }}" class="btn btn-sm btn-outline-warning flex-fill" title="Edit">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('lembaga.destroy', $item->lembaga_id) }}" method="POST" class="flex-fill">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger w-100" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data {{ $item->nama_lembaga }}?')" title="Hapus">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="text-center bg-light rounded p-5">
                            <i class="fa fa-building fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Data Tidak Ditemukan</h4>
                            <p class="text-muted mb-4">Belum ada data lembaga yang tersedia atau pencarian tidak ditemukan.</p>
                            <a href="{{ route('lembaga.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus me-2"></i>Tambah Lembaga
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-5 wow fadeInUp" data-wow-delay="0.1s">
                {{ $lembaga->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
