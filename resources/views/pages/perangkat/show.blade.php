<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.guest.css')
</head>

<body>
    <div class="container-xxl bg-white p-0">
        @include('layouts.guest.header')

        <div class="container-xxl py-5">
            <div class="container px-lg-5">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card border-0 shadow-lg overflow-hidden">
                            <div class="card-header bg-primary text-white p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 text-white">Detail Perangkat Desa</h4>
                                    <span class="badge bg-white text-primary">
                                        {{ $perangkat->jabatan }}
                                    </span>
                                </div>
                            </div>

                            <div class="card-body p-5">
                                <div class="row">
                                    {{-- Kolom Kiri: Foto Profil --}}
                                    <div class="col-md-4 text-center mb-4 mb-md-0">
                                        @if($perangkat->foto)
                                            <img src="{{ asset('storage/' . $perangkat->foto) }}"
                                                alt="{{ $perangkat->warga->nama }}"
                                                class="img-fluid rounded-3 shadow-sm mb-3"
                                                style="max-height: 300px; width: 100%; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center mx-auto mb-3"
                                                 style="height: 250px; width: 100%;">
                                                <i class="fa fa-user-tie fa-5x text-secondary"></i>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Kolom Kanan: Informasi Utama --}}
                                    <div class="col-md-8">
                                        <h2 class="fw-bold mb-1">{{ $perangkat->warga->nama }}</h2>
                                        <p class="text-muted mb-4">NIP: {{ $perangkat->nip ?? '-' }}</p>

                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <div class="p-3 bg-light rounded h-100">
                                                    <small class="text-muted d-block text-uppercase fw-bold">Kontak</small>
                                                    <span class="fs-5">{{ $perangkat->kontak }}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="p-3 bg-light rounded h-100">
                                                    <small class="text-muted d-block text-uppercase fw-bold">Masa Jabatan</small>
                                                    <span class="fs-6 d-block">Mulai: {{ \Carbon\Carbon::parse($perangkat->periode_mulai)->format('d M Y') }}</span>
                                                    <span class="fs-6 d-block">Selesai: {{ $perangkat->periode_selesai ? \Carbon\Carbon::parse($perangkat->periode_selesai)->format('d M Y') : 'Sekarang' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="p-3 bg-light rounded">
                                                    <small class="text-muted d-block text-uppercase fw-bold">Status</small>
                                                    @if($perangkat->periode_selesai && \Carbon\Carbon::parse($perangkat->periode_selesai)->isPast())
                                                        <span class="badge bg-danger">Tidak Aktif</span>
                                                    @else
                                                        <span class="badge bg-success">Aktif Menjabat</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Bagian Galeri / Media (Jika ada relasi media) --}}
                                {{-- Cek apakah relasi media ada dan memiliki data --}}
                                @if($perangkat->media && $perangkat->media->count() > 0)
                                    <hr class="my-5">
                                    <h5 class="mb-4"><i class="fa fa-images me-2 text-primary"></i>Galeri Foto</h5>
                                    <div class="row g-3">
                                        @foreach($perangkat->media as $media)
                                            <div class="col-6 col-md-3">
                                                <a href="{{ asset('storage/uploads/' . $media->file_name) }}" target="_blank">
                                                    <img src="{{ asset('storage/uploads/' . $media->file_name) }}"
                                                         alt="{{ $media->caption ?? 'Foto Kegiatan' }}"
                                                         class="img-fluid rounded shadow-sm hover-zoom"
                                                         style="height: 120px; width: 100%; object-fit: cover;">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="card-footer bg-light p-4">
                                <a href="{{ route('perangkat.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.guest.footer')
    </div>

    @include('layouts.guest.js')
</body>
</html>
