@extends('layouts.guest.app') {{-- Sesuaikan dengan nama file layout utamamu --}}

@section('hero-title', 'Profil Saya')
@section('hero-description', 'Kelola informasi akun dan data diri Anda di sini')

@section('content')
<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden">

                    {{-- Header Card dengan Background Biru --}}
                    <div class="card-header bg-primary text-white p-4 text-center">
                        <div class="d-inline-block position-relative">
                            {{-- Avatar Placeholder / Gambar --}}
                            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                 style="width: 100px; height: 100px; border: 4px solid rgba(255,255,255,0.3);">
                                <i class="fas fa-user fa-3x text-primary"></i>
                            </div>
                        </div>
                        <h4 class="text-white mb-1">{{ $user->name }}</h4>
                        <p class="text-white-50 mb-0">
                            <span class="badge bg-white text-primary rounded-pill px-3">
                                {{ $user->role }}
                            </span>
                        </p>
                    </div>

                    {{-- Body Card --}}
                    <div class="card-body p-4 p-md-5">
                        <div class="row g-4">
                            {{-- Informasi Username --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-muted small mb-2 text-uppercase fw-bold">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-at text-primary"></i></span>
                                        <input type="text" class="form-control bg-light border-start-0" value="{{ $user->username }}" readonly>
                                    </div>
                                </div>
                            </div>

                            {{-- Informasi Email --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-muted small mb-2 text-uppercase fw-bold">Alamat Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-primary"></i></span>
                                        <input type="text" class="form-control bg-light border-start-0" value="{{ $user->email }}" readonly>
                                    </div>
                                </div>
                            </div>

                            {{-- Tanggal Bergabung --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-muted small mb-2 text-uppercase fw-bold">Bergabung Sejak</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-calendar-alt text-primary"></i></span>
                                        <input type="text" class="form-control bg-light border-start-0" value="{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}" readonly>
                                    </div>
                                </div>
                            </div>

                            {{-- Status Akun (Contoh statis) --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-muted small mb-2 text-uppercase fw-bold">Status Akun</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-check-circle text-success"></i></span>
                                        <input type="text" class="form-control bg-light border-start-0 text-success fw-bold" value="Aktif" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Tombol Aksi --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary px-4">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            {{-- Jika ingin menambah fitur edit profil nanti --}}
                            {{-- <a href="#" class="btn btn-primary px-4">
                                <i class="fas fa-edit me-2"></i>Edit Profil
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
