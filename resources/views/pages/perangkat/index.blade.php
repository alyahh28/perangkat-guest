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
                                <i class="fa fa-user-tie text-white fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['total_perangkat'] ?? 0 }}</h4>
                                <small class="text-muted">Total Perangkat</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="card border-0 shadow-sm h-100 p-2">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-success rounded d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fa fa-user-check text-white fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['perangkat_aktif'] ?? 0 }}</h4>
                                <small class="text-muted">Perangkat Aktif</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card border-0 shadow-sm h-100 p-2">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-danger rounded d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fa fa-user-times text-white fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['perangkat_nonaktif'] ?? 0 }}</h4>
                                <small class="text-muted">Non-Aktif</small>
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
                                <h4 class="mb-0 fw-bold">{{ $stats['perangkat_baru'] ?? 0 }}</h4>
                                <small class="text-muted">Perangkat Baru (1 Bln)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Title Section --}}
            <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="position-relative d-inline text-primary ps-4">Pemerintahan Desa</h6>
                <h2 class="mt-2">Perangkat Desa</h2>
            </div>

            {{-- Filter & Action --}}
            <div class="row g-4 mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-8">
                    <form method="GET" action="{{ route('perangkat.index') }}">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Status</option>
                                    <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ request('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                           value="{{ request('search') }}" placeholder="Cari nama, jabatan, atau NIP..."
                                           aria-label="Search">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    @if (request()->has('search') || request()->has('status'))
                                        <a href="{{ route('perangkat.index') }}" class="btn btn-outline-secondary">
                                            <i class="fa fa-times"></i> Reset
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('perangkat.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus me-2"></i>Tambah Perangkat
                    </a>
                </div>
            </div>

            {{-- Data Grid --}}
            <div class="row g-4">
                @forelse ($dataPerangkat as $perangkat)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden">
                            {{-- Header --}}
                            <div class="card-body text-center pt-4 pb-0">
                                @php
                                    $imgSrc = $perangkat->foto ? asset('storage/' . $perangkat->foto) : asset('assets-guest/img/no-image.jpg');
                                    $isNonAktif = $perangkat->periode_selesai && \Carbon\Carbon::parse($perangkat->periode_selesai)->isPast();
                                @endphp
                                
                                <img src="{{ $imgSrc }}"
                                     class="rounded-circle shadow-sm mb-3"
                                     alt="{{ $perangkat->warga->nama }}"
                                     onerror="this.onerror=null;this.src='{{ asset('assets-guest/img/no-image.jpg') }}';"
                                     style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #f8f9fa;">
                                
                                <h5 class="mb-1 text-truncate" title="{{ $perangkat->warga->nama }}">
                                    {{ $perangkat->warga->nama }}
                                </h5>
                                <p class="text-primary fw-bold mb-2">{{ $perangkat->jabatan }}</p>

                                <span class="badge rounded-pill {{ $isNonAktif ? 'bg-danger' : 'bg-success' }} mb-3">
                                    {{ $isNonAktif ? 'Tidak Aktif' : 'Aktif' }}
                                </span>
                            </div>

                            {{-- Details --}}
                            <div class="card-body border-top bg-light">
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted"><i class="fa fa-id-card me-1"></i> NIP</span>
                                    <span class="fw-bold">{{ $perangkat->nip ?? '-' }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted"><i class="fa fa-phone me-1"></i> Kontak</span>
                                    <span class="fw-bold">{{ $perangkat->kontak ?? '-' }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted"><i class="fa fa-calendar me-1"></i> Periode</span>
                                    <span class="fw-bold">
                                        {{ \Carbon\Carbon::parse($perangkat->periode_mulai)->format('Y') }} - 
                                        {{ $perangkat->periode_selesai ? \Carbon\Carbon::parse($perangkat->periode_selesai)->format('Y') : 'Sek.' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="card-footer bg-white border-top p-3">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('perangkat.show', $perangkat->perangkat_id) }}" class="btn btn-sm btn-outline-primary flex-fill" title="Detail">
                                        <i class="fa fa-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('perangkat.edit', $perangkat->perangkat_id) }}" class="btn btn-sm btn-outline-warning flex-fill" title="Edit">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('perangkat.destroy', $perangkat->perangkat_id) }}" method="POST" class="flex-fill">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger w-100" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data perangkat ini?')" title="Hapus">
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
                            <i class="fa fa-user-tie fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum Ada Data Perangkat Desa</h4>
                            <p class="text-muted mb-4">Silakan tambah data perangkat desa terlebih dahulu untuk melihat daftar di sini.</p>
                            <a href="{{ route('perangkat.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus me-2"></i>Tambah Perangkat Pertama
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-5 wow fadeInUp" data-wow-delay="0.1s">
                {{ $dataPerangkat->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
