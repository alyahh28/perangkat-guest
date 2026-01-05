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
                                <h4 class="mb-0 fw-bold">{{ $stats['total_warga'] ?? 0 }}</h4>
                                <small class="text-muted">Total Warga</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="card border-0 shadow-sm h-100 p-2">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-success rounded d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fa fa-male text-white fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['laki_laki'] ?? 0 }}</h4>
                                <small class="text-muted">Laki-laki</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card border-0 shadow-sm h-100 p-2">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-info rounded d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fa fa-female text-white fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['perempuan'] ?? 0 }}</h4>
                                <small class="text-muted">Perempuan</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="card border-0 shadow-sm h-100 p-2">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-warning rounded d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fa fa-home text-white fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['kepala_keluarga'] ?? 0 }}</h4>
                                <small class="text-muted">Kepala Keluarga</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Title Section --}}
            <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="position-relative d-inline text-primary ps-4">Data Kependudukan</h6>
                <h2 class="mt-2">Profil Warga Desa</h2>
            </div>

            {{-- Filter & Action --}}
            <div class="row g-4 mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-8">
                    <form method="GET" action="{{ route('warga.index') }}">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                           value="{{ request('search') }}" placeholder="Cari nama, NIK, atau pekerjaan..."
                                           aria-label="Search">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    @if(request()->has('search') || request()->has('jenis_kelamin'))
                                        <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary">
                                            <i class="fa fa-times"></i> Reset
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('warga.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus me-2"></i>Tambah Warga
                    </a>
                </div>
            </div>

            {{-- Data Grid --}}
            <div class="row g-4">
                @forelse ($dataWarga as $warga)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden">
                            {{-- Header --}}
                            <div class="card-body text-center pt-4 pb-0">
                                {{-- Icon User (Warga usually doesn't have custom photo field in this schema, using generic icon) --}}
                                <div class="rounded-circle shadow-sm mb-3 d-flex align-items-center justify-content-center bg-light text-primary mx-auto" 
                                     style="width: 100px; height: 100px; border: 3px solid #f8f9fa; font-size: 3rem;">
                                    <i class="fa fa-user"></i>
                                </div>
                                
                                <h5 class="mb-1 text-truncate" title="{{ $warga->nama }}">
                                    {{ $warga->nama }}
                                </h5>
                                <p class="text-primary fw-bold mb-2">{{ $warga->pekerjaan ?? '-' }}</p>

                                <span class="badge rounded-pill {{ $warga->jenis_kelamin == 'Laki-laki' ? 'bg-info' : 'bg-warning' }} mb-3">
                                    {{ $warga->jenis_kelamin }}
                                </span>
                            </div>

                            {{-- Details --}}
                            <div class="card-body border-top bg-light">
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted"><i class="fa fa-id-card me-1"></i> NIK</span>
                                    <span class="fw-bold">{{ $warga->no_ktp }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted"><i class="fa fa-phone me-1"></i> Kontak</span>
                                    <span class="fw-bold">{{ $warga->telp ?? '-' }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted"><i class="fa fa-map-marker-alt me-1"></i> Agama</span>
                                    <span class="fw-bold">{{ $warga->agama ?? '-' }}</span>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="card-footer bg-white border-top p-3">
                                <div class="d-flex gap-2">
                                    <a href="mailto:{{ $warga->email }}" class="btn btn-sm btn-outline-primary flex-fill" title="Email">
                                        <i class="fa fa-envelope"></i> Email
                                    </a>
                                    <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-sm btn-outline-warning flex-fill" title="Edit">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('warga.destroy', $warga->warga_id) }}" method="POST" class="flex-fill">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger w-100" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data warga ini?')" title="Hapus">
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
                            <i class="fa fa-users fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum Ada Data Warga</h4>
                            <p class="text-muted mb-4">Silakan tambah data warga desa terlebih dahulu.</p>
                            <a href="{{ route('warga.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus me-2"></i>Tambah Warga Pertama
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-5 wow fadeInUp" data-wow-delay="0.1s">
                {{ $dataWarga->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
