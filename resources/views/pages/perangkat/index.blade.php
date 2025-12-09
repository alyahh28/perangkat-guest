<!DOCTYPE html>
<html lang="en">

<head>
    {{-- START CSS --}}
    @include('layouts.guest.css')
    {{-- END CSS --}}
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        {{-- START HEADER --}}
        @include('layouts.guest.header')
        {{-- END HEADER --}}

        <div class="container-xxl py-5">
            <div class="container px-lg-5">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div>
                        <h2 class="mb-1" style="color: #2c3e50; font-weight: 800;">Perangkat Desa</h2>
                        <p class="text-muted mb-0">Struktur pemerintahan desa</p>
                    </div>
                    <a href="{{ route('perangkat.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus me-2"></i>Tambah Perangkat Baru
                    </a>
                </div>

                <div class="table-responsive">
                    <form method="GET" action="{{ route('perangkat.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-2">
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Status</option>
                                    <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>
                                        Aktif
                                    </option>
                                    <option value="Tidak Aktif"
                                        {{ request('status') == 'Tidak Aktif' ? 'selected' : '' }}>
                                        Tidak Aktif
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        value="{{ request('search') }}" placeholder="Cari nama, jabatan, atau NIP..."
                                        aria-label="Search">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </button>

                                    @if (request()->has('search') || request()->has('status'))
                                        <a href="{{ route('perangkat.index') }}" class="btn btn-outline-secondary">
                                            <i class="fa fa-times"></i> Clear All
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="perangkat-grid">
                    @forelse ($dataPerangkat as $perangkat)
                        <div class="perangkat-card">
                            <div class="card-header">
                                <div class="header-content">
                                    @if ($perangkat->foto)
                                        <img src="{{ asset('storage/' . $perangkat->foto) }}" class="foto-perangkat"
                                            alt="{{ $perangkat->warga->nama }}"
                                            style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                                    @else
                                        <div class="avatar"
                                            style="width: 60px; height: 60px; border-radius: 50%; background: #007bff; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 20px;">
                                            {{ strtoupper(substr($perangkat->warga->nama, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div style="margin-left: 15px;">
                                        <div class="nama" style="font-weight: bold; font-size: 18px;">
                                            <i class="fa fa-user-tie me-2"></i>{{ $perangkat->warga->nama }}
                                        </div>
                                        <div class="jabatan" style="color: #6c757d; font-size: 14px;">
                                            {{ $perangkat->jabatan }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body" style="padding: 20px;">
                                <div class="info-item"
                                    style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                    <span class="info-label" style="color: #6c757d;">NIP</span>
                                    <span class="info-value" style="font-weight: 500;">
                                        <i class="fa fa-id-card me-2"></i>
                                        {{ $perangkat->nip ?? '-' }}
                                    </span>
                                </div>

                                <div class="info-item"
                                    style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                    <span class="info-label" style="color: #6c757d;">Kontak</span>
                                    <span class="info-value" style="font-weight: 500;">
                                        <i class="fa fa-phone me-2"></i>
                                        {{ $perangkat->kontak ?? '-' }}
                                    </span>
                                </div>

                                <div class="info-item"
                                    style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                    <span class="info-label" style="color: #6c757d;">Periode Mulai</span>
                                    <span class="info-value" style="font-weight: 500;">
                                        <i class="fa fa-calendar me-2"></i>
                                        {{ \Carbon\Carbon::parse($perangkat->periode_mulai)->format('d M Y') }}
                                    </span>
                                </div>

                                <div class="info-item"
                                    style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                    <span class="info-label" style="color: #6c757d;">Periode Selesai</span>
                                    <span class="info-value" style="font-weight: 500;">
                                        <i class="fa fa-calendar me-2"></i>
                                        {{ $perangkat->periode_selesai ? \Carbon\Carbon::parse($perangkat->periode_selesai)->format('d M Y') : 'Sekarang' }}
                                    </span>
                                </div>

                                <div class="info-item"
                                    style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                    <span class="info-label" style="color: #6c757d;">Status</span>
                                    <span class="info-value">
                                        <span
                                            class="status-badge {{ $perangkat->periode_selesai && \Carbon\Carbon::parse($perangkat->periode_selesai)->isPast() ? 'status-nonaktif' : 'status-aktif' }}"
                                            style="padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; background: {{ $perangkat->periode_selesai && \Carbon\Carbon::parse($perangkat->periode_selesai)->isPast() ? '#dc3545' : '#28a745' }}; color: white;">
                                            <i class="fa fa-circle me-1" style="font-size: 0.5rem;"></i>
                                            {{ $perangkat->periode_selesai && \Carbon\Carbon::parse($perangkat->periode_selesai)->isPast() ? 'Tidak Aktif' : 'Aktif' }}
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="card-footer" style="padding: 15px; background: #f8f9fa;">
                                <div class="d-flex justify-content-between gap-2">
                                    {{-- PERBAIKAN: Menggunakan tag <a> agar langsung masuk ke halaman show --}}
                                    <a href="{{ route('perangkat.show', $perangkat->perangkat_id) }}" class="btn btn-primary flex-fill">
                                        <i class="fa fa-eye me-2"></i>Detail
                                    </a>

                                    <a href="{{ route('perangkat.edit', $perangkat->perangkat_id) }}"
                                        class="btn btn-warning flex-fill" style="color: white;">
                                        <i class="fa fa-edit me-2"></i>Edit
                                    </a>
                                    <form action="{{ route('perangkat.destroy', $perangkat->perangkat_id) }}"
                                        method="POST" style="display: inline; flex: 1;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data perangkat ini?')">
                                            <i class="fa fa-trash me-2"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="empty-state text-center py-5">
                                <i class="fa fa-user-tie fa-3x text-muted mb-3"></i>
                                <h3 class="mb-3" style="color: #495057;">Belum Ada Data Perangkat Desa</h3>
                                <p class="mb-4">Silakan tambah data perangkat desa terlebih dahulu</p>
                                <a href="{{ route('perangkat.create') }}" class="btn btn-primary btn-lg">
                                    <i class="fa fa-plus me-2"></i>Tambah Perangkat Pertama
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $dataPerangkat->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
        @include('layouts.guest.footer')
        </div>

    {{-- START JS --}}
    @include('layouts.guest.js')
</body>

</html>
