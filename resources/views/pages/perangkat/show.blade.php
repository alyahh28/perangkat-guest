@extends('layouts.guest.app')

@section('content')
    <style>
        .detail-label {
            color: #6c757d;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .detail-value {
            color: #2c3e50;
            font-weight: 500;
            font-size: 1rem;
        }

        .detail-row {
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .detail-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
    </style>

    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white p-4 border-bottom">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div>
                                    <h3 class="mb-1 fw-bold text-white">{{ $perangkat->warga->nama }}</h3>
                                    <span class="text-white" style="opacity: 0.9;">
                                        <i class="fa fa-briefcase me-2"></i>{{ $perangkat->jabatan }}
                                    </span>
                                </div>

                                {{-- Status Badge: Menggunakan bg-white text-primary agar kontras dengan header biru --}}
                                @if ($perangkat->periode_selesai && \Carbon\Carbon::parse($perangkat->periode_selesai)->isPast())
                                    <span class="badge bg-danger border border-white rounded-pill px-3 py-2">
                                        <i class="fa fa-times-circle me-1"></i> Tidak Aktif
                                    </span>
                                @else
                                    <span class="badge bg-white text-primary rounded-pill px-3 py-2 shadow-sm">
                                        <i class="fa fa-check-circle me-1"></i> Aktif Menjabat
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="row g-4">
                                {{-- KOLOM KIRI: FOTO PROFIL --}}
                                <div class="col-md-4 text-center">
                                    @php
                                        $placeholder = asset('assets/images/profile/placeholder.png');
                                        $detailImgSrc = $perangkat->foto
                                            ? asset('storage/' . $perangkat->foto)
                                            : $placeholder;
                                    @endphp

                                    <div class="position-relative d-inline-block w-100">
                                        <img src="{{ $detailImgSrc }}" alt="{{ $perangkat->warga->nama }}"
                                            class="img-fluid rounded shadow-sm"
                                            onerror="this.onerror=null;this.src='{{ $placeholder }}';"
                                            style="width: 100%; max-height: 400px; object-fit: cover; border: 1px solid #dee2e6;">
                                    </div>
                                </div>

                                {{-- KOLOM KANAN: INFORMASI DETAIL (GRID SYSTEM) --}}
                                <div class="col-md-8">
                                    <h5 class="mb-4 text-dark border-start border-4 border-primary ps-3">Informasi Pribadi &
                                        Jabatan</h5>

                                    <div class="row detail-row">
                                        <div class="col-sm-4 detail-label">Nomor Induk Pegawai (NIP)</div>
                                        <div class="col-sm-8 detail-value">{{ $perangkat->nip ?? '-' }}</div>
                                    </div>

                                    <div class="row detail-row">
                                        <div class="col-sm-4 detail-label">Kontak / Telepon</div>
                                        <div class="col-sm-8 detail-value">{{ $perangkat->kontak }}</div>
                                    </div>

                                    <div class="row detail-row">
                                        <div class="col-sm-4 detail-label">Mulai Menjabat</div>
                                        <div class="col-sm-8 detail-value">
                                            {{ \Carbon\Carbon::parse($perangkat->periode_mulai)->format('d F Y') }}</div>
                                    </div>

                                    <div class="row detail-row">
                                        <div class="col-sm-4 detail-label">Akhir Masa Jabatan</div>
                                        <div class="col-sm-8 detail-value">
                                            {{ $perangkat->periode_selesai ? \Carbon\Carbon::parse($perangkat->periode_selesai)->format('d F Y') : 'Saat Ini (Petahana)' }}
                                        </div>
                                    </div>

                                    <div class="row detail-row">
                                        <div class="col-sm-4 detail-label">Lama Menjabat</div>
                                        <div class="col-sm-8 detail-value">
                                            @php
                                                $start = \Carbon\Carbon::parse($perangkat->periode_mulai);
                                                $end = $perangkat->periode_selesai
                                                    ? \Carbon\Carbon::parse($perangkat->periode_selesai)
                                                    : now();
                                                $diff = $start->diff($end);
                                            @endphp
                                            {{ $diff->y > 0 ? $diff->y . ' Tahun' : '' }}
                                            {{ $diff->m > 0 ? $diff->m . ' Bulan' : '' }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- BAGIAN GALERI --}}
                            @if ($perangkat->galeri && $perangkat->galeri->count() > 0)
                                <div class="mt-5">
                                    <h5 class="mb-4 text-dark border-start border-4 border-warning ps-3">Galeri &
                                        Dokumentasi</h5>
                                    <div class="row row-cols-2 row-cols-md-4 g-3">
                                        @foreach ($perangkat->galeri as $media)
                                            <div class="col">
                                                <div class="card h-100 border-0 shadow-sm">
                                                    <a href="{{ asset('storage/uploads/' . $media->file_name) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/uploads/' . $media->file_name) }}"
                                                            alt="{{ $media->caption }}" class="card-img-top rounded"
                                                            style="height: 150px; object-fit: cover;">
                                                    </a>
                                                    @if ($media->caption)
                                                        <div class="card-footer bg-white p-2 border-top-0">
                                                            <small class="text-muted d-block text-truncate"
                                                                title="{{ $media->caption }}">
                                                                {{ $media->caption }}
                                                            </small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="card-footer bg-light p-3">
                            <a href="{{ route('perangkat.index') }}" class="btn btn-outline-secondary">
                                <i class="fa fa-arrow-left me-2"></i>Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
