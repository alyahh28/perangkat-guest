@extends('layouts.guest.app')

@section('content')
<div class="container-xxl py-5">
    <div class="container px-lg-4">

        {{-- Header: Tombol Kembali & Judul --}}
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <a href="{{ route('anggota-lembaga.index') }}" class="btn btn-link text-decoration-none text-dark p-0 mb-2">
                    <i class="fa fa-arrow-left me-2"></i>Kembali ke Daftar
                </a>
                <h2 class="fw-bold text-primary">Detail Personil</h2>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="badge bg-primary fs-6 px-3 py-2">
                    {{ $anggota->lembaga->nama_lembaga ?? 'Lembaga Tidak Diketahui' }}
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="row g-0">

                            {{-- KOLOM KIRI: Foto Profil Besar --}}
                            <div class="col-md-5 bg-light d-flex align-items-center justify-content-center p-4">
                                    <div class="mb-3 position-relative d-inline-block">
                                        @if($anggota->foto_profile)
                                            <img src="{{ $anggota->foto_profile->url }}"
                                                 class="img-fluid rounded-3 shadow-sm"
                                                 alt="Foto {{ $anggota->warga->nama ?? '-' }}"
                                                 style="max-height: 400px; width: 100%; object-fit: cover;">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($anggota->warga->nama ?? 'Anggota') }}&background=random&size=256"
                                                 class="img-fluid rounded-circle shadow-sm"
                                                 alt="Avatar">
                                        @endif
                                    </div>
                                    <h4 class="fw-bold mb-1">{{ $anggota->warga->nama ?? '-' }}</h4>
                                    <p class="text-muted mb-0">{{ $anggota->jabatan->nama_jabatan ?? 'Anggota' }}</p>
                                </div>
                            </div>

                            {{-- KOLOM KANAN: Detail Informasi --}}
                            <div class="col-md-7 p-4 p-md-5">
                                <h5 class="mb-4 fw-bold border-bottom pb-2">Informasi Lengkap</h5>

                                <div class="row mb-3">
                                    <div class="col-sm-4 text-muted">Nomor KTP (NIK)</div>
                                    <div class="col-sm-8 fw-bold text-dark">
                                        {{ $anggota->warga->no_ktp ?? '-' }}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4 text-muted">Nama Lengkap</div>
                                    <div class="col-sm-8 fw-bold text-dark">
                                        {{ $anggota->warga->nama ?? '-' }}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4 text-muted">Lembaga Desa</div>
                                    <div class="col-sm-8">
                                        <span class="d-inline-block px-2 py-1 rounded bg-light text-primary border fw-semibold">
                                            {{ $anggota->lembaga->nama_lembaga ?? '-' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4 text-muted">Jabatan</div>
                                    <div class="col-sm-8 fw-bold text-dark">
                                        {{ $anggota->jabatan->nama_jabatan ?? '-' }}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4 text-muted">Masa Jabatan</div>
                                    <div class="col-sm-8 fw-bold text-dark">
                                        {{ \Carbon\Carbon::parse($anggota->tgl_mulai)->format('d F Y') }}
                                        s/d
                                        {{ $anggota->tgl_selesai ? \Carbon\Carbon::parse($anggota->tgl_selesai)->format('d F Y') : 'Sekarang' }}
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-sm-4 text-muted">Terdaftar Pada</div>
                                    <div class="col-sm-8 fw-bold text-dark">
                                        {{ $anggota->created_at->format('d F Y') }}
                                        <small class="text-muted fw-normal">({{ $anggota->created_at->diffForHumans() }})</small>
                                    </div>
                                </div>

                                {{-- Bagian Tombol Aksi --}}
                                <div class="d-flex gap-2 mt-5 pt-3 border-top">
                                    <a href="{{ route('anggota-lembaga.edit', $anggota->anggota_id) }}" class="btn btn-warning text-white px-4">
                                        <i class="fa fa-edit me-2"></i>Edit Data
                                    </a>

                                    <form action="{{ route('anggota-lembaga.destroy', $anggota->anggota_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data personil ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger px-4">
                                            <i class="fa fa-trash me-2"></i>Hapus
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
