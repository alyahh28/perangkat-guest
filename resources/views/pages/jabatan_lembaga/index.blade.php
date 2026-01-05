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
                                <i class="fa fa-id-badge text-white fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['total_jabatan'] ?? 0 }}</h4>
                                <small class="text-muted">Total Jabatan</small>
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
                                <h4 class="mb-0 fw-bold">{{ $stats['jabatan_terisi'] ?? 0 }}</h4>
                                <small class="text-muted">Jabatan Terisi</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card border-0 shadow-sm h-100 p-2">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-info rounded d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fa fa-building text-white fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['total_lembaga'] ?? 0 }}</h4>
                                <small class="text-muted">Lembaga Desa</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="card border-0 shadow-sm h-100 p-2">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-warning rounded d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fa fa-star text-white fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['jabatan_level_1'] ?? 0 }}</h4>
                                <small class="text-muted">Jabatan Utama</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Title Section --}}
            <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="position-relative d-inline text-primary ps-4">Kelembagaan Desa</h6>
                <h2 class="mt-2">Jabatan Lembaga</h2>
            </div>

            {{-- Filter & Action --}}
            <div class="row g-4 mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-8">
                     <form method="GET" action="{{ route('jabatan-lembaga.index') }}">
                        <div class="row g-2">
                             {{-- Filter Lembaga --}}
                            <div class="col-md-3">
                                <select name="lembaga_id" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Lembaga</option>
                                    @foreach ($lembagaList as $lembaga)
                                        <option value="{{ $lembaga->lembaga_id }}" {{ request('lembaga_id') == $lembaga->lembaga_id ? 'selected' : '' }}>
                                            {{ $lembaga->nama_lembaga }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                             {{-- Filter Level --}}
                            <div class="col-md-3">
                                <select name="level" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Level</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ request('level') == $i ? 'selected' : '' }}>
                                            Level {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            
                            {{-- Search --}}
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                           value="{{ request('search') }}" placeholder="Cari nama jabatan..."
                                           aria-label="Search">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    @if (request()->has('search') || request()->has('lembaga_id') || request()->has('level'))
                                        <a href="{{ route('jabatan-lembaga.index') }}" class="btn btn-outline-secondary">
                                            <i class="fa fa-times"></i> Reset
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('jabatan-lembaga.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus me-2"></i>Tambah Jabatan
                    </a>
                </div>
            </div>

            {{-- Data Grid --}}
            <div class="row g-4">
                @forelse ($jabatan as $item)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden">
                            {{-- Header --}}
                            <div class="card-body text-center pt-4 pb-0">
                                <div class="rounded-circle shadow-sm mb-3 d-flex align-items-center justify-content-center bg-light text-primary mx-auto" 
                                     style="width: 100px; height: 100px; border: 3px solid #f8f9fa; font-size: 3rem;">
                                    <i class="fa fa-id-badge"></i>
                                </div>
                                
                                <h5 class="mb-1 text-truncate text-capitalize" title="{{ $item->nama_jabatan }}">
                                    {{ $item->nama_jabatan }}
                                </h5>
                                <p class="text-primary fw-bold mb-2 text-truncate">{{ $item->lembaga ? $item->lembaga->nama_lembaga : 'Umum' }}</p>

                                <span class="badge rounded-pill bg-secondary mb-3">
                                    Level {{ $item->level }}
                                </span>
                            </div>

                            {{-- Details --}}
                            <div class="card-body border-top bg-light">
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted"><i class="fa fa-hashtag me-1"></i> ID Jabatan</span>
                                    <span class="fw-bold">#{{ $item->jabatan_id }}</span>
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
                                     <a href="{{ route('jabatan-lembaga.show', $item->jabatan_id) }}" class="btn btn-sm btn-outline-primary flex-fill" title="Detail">
                                        <i class="fa fa-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('jabatan-lembaga.edit', $item->jabatan_id) }}" class="btn btn-sm btn-outline-warning flex-fill" title="Edit">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('jabatan-lembaga.destroy', $item->jabatan_id) }}" method="POST" class="flex-fill">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger w-100" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus jabatan ini?')" title="Hapus">
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
                            <i class="fa fa-id-badge fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum Ada Data Jabatan</h4>
                            <p class="text-muted mb-4">Silakan tambah data jabatan lembaga pertama Anda.</p>
                            <a href="{{ route('jabatan-lembaga.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus me-2"></i>Tambah Jabatan
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-5 wow fadeInUp" data-wow-delay="0.1s">
                {{ $jabatan->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
