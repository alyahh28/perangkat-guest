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
                                <i class="fa fa-users text-white fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['total_anggota'] ?? 0 }}</h4>
                                <small class="text-muted">Total Anggota</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="card border-0 shadow-sm h-100 p-2">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-success rounded d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fa fa-building text-white fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['total_lembaga'] ?? 0 }}</h4>
                                <small class="text-muted">Lembaga Desa</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card border-0 shadow-sm h-100 p-2">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-info rounded d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fa fa-id-badge text-white fs-4"></i>
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
                                <i class="fa fa-user-plus text-white fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['anggota_baru'] ?? 0 }}</h4>
                                <small class="text-muted">Anggota Baru (1 Bln)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Title Section --}}
            <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="position-relative d-inline text-primary ps-4">Kelembagaan Desa</h6>
                <h2 class="mt-2">Anggota Lembaga</h2>
            </div>

            {{-- Filter & Action --}}
            <div class="row g-4 mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-8">
                   <p class="mb-0 text-muted d-flex align-items-center h-100">
                        <i class="fa fa-info-circle me-2 text-primary"></i> Kelola data anggota dan struktur lembaga desa.
                   </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('anggota-lembaga.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus me-2"></i>Tambah Anggota
                    </a>
                </div>
            </div>

            {{-- Data Grid --}}
            <div class="row g-4">
                @forelse ($anggotas as $anggota)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden">
                            {{-- Header --}}
                            <div class="card-body text-center pt-4 pb-0">
                                @php
                                    // Use generic name for avatar or from Warga
                                    $nama = $anggota->warga->nama ?? 'Anggota';
                                    $imgSrc = 'https://ui-avatars.com/api/?name='.urlencode($nama).'&background=random&size=128';
                                @endphp
                                
                                <img src="{{ $imgSrc }}"
                                     class="rounded-circle shadow-sm mb-3"
                                     alt="{{ $nama }}"
                                     style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #f8f9fa;">
                                
                                <h5 class="mb-1 text-truncate text-capitalize" title="{{ $nama }}">
                                    {{ $nama }}
                                </h5>
                                <p class="text-primary fw-bold mb-2">{{ $anggota->jabatan->nama_jabatan ?? 'Anggota' }}</p>

                                <span class="badge rounded-pill bg-success mb-3">
                                    {{ $anggota->lembaga->nama_lembaga ?? '-' }}
                                </span>
                            </div>

                            {{-- Details --}}
                            <div class="card-body border-top bg-light">
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted"><i class="fa fa-calendar-check me-1"></i> Mulai Menjabat</span>
                                    <span class="fw-bold">{{ $anggota->tgl_mulai ? \Carbon\Carbon::parse($anggota->tgl_mulai)->format('d M Y') : '-' }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted"><i class="fa fa-calendar me-1"></i> Terdaftar</span>
                                    <span class="fw-bold">
                                        {{ $anggota->created_at ? $anggota->created_at->format('d M Y') : '-' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="card-footer bg-white border-top p-3">
                                <div class="d-flex gap-2">
                                     <a href="{{ route('anggota-lembaga.show', $anggota->anggota_id) }}" class="btn btn-sm btn-outline-primary flex-fill" title="Detail">
                                        <i class="fa fa-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('anggota-lembaga.edit', $anggota->anggota_id) }}" class="btn btn-sm btn-outline-warning flex-fill" title="Edit">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('anggota-lembaga.destroy', $anggota->anggota_id) }}" method="POST" class="flex-fill">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger w-100" 
                                            onclick="return confirm('Yakin hapus anggota {{ $nama }}?')" title="Hapus">
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
                            <i class="fa fa-id-card fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum Ada Data Anggota</h4>
                            <p class="text-muted mb-4">Silakan tambah data anggota lembaga pertama Anda.</p>
                            <a href="{{ route('anggota-lembaga.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus me-2"></i>Tambah Anggota Pertama
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-5 wow fadeInUp" data-wow-delay="0.1s">
                {{ $anggotas->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
