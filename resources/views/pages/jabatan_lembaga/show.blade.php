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

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="card-header bg-white border-0 pt-4 pb-0 text-center">
                            <h4 class="text-primary fw-bold mb-1">Detail Jabatan Lembaga</h4>
                            <p class="text-muted">Informasi lengkap mengenai jabatan dan pemegang jabatan saat ini.</p>
                        </div>
                        <div class="card-body p-4">
                            {{-- Informasi Jabatan --}}
                            <div class="table-responsive mb-4">
                                <table class="table table-borderless">
                                    <tr>
                                        <th class="text-muted" style="width: 35%;">Nama Jabatan</th>
                                        <td class="fw-bold">: {{ $jabatan->nama_jabatan }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Lembaga Desa</th>
                                        <td class="fw-bold text-primary">
                                            : <a href="{{ route('lembaga.show', $jabatan->lembaga->lembaga_id) }}" class="text-decoration-none">
                                                {{ $jabatan->lembaga->nama_lembaga }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Level Hierarki</th>
                                        <td class="fw-bold">: Level {{ $jabatan->level }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">ID Jabatan</th>
                                        <td>: {{ $jabatan->jabatan_id }}</td>
                                    </tr>
                                </table>
                            </div>

                            <hr class="my-4">

                            {{-- Daftar Anggota --}}
                            <h5 class="mb-3 text-primary"><i class="fa fa-users me-2"></i>Daftar Pemegang Jabatan</h5>
                            
                            @if($jabatan->anggota && $jabatan->anggota->count() > 0)
                                <div class="row g-3">
                                    @foreach($jabatan->anggota as $anggota)
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center bg-light p-3 rounded shadow-sm h-100">
                                                <img src="{{ $anggota->foto ? asset('storage/anggota-images/' . $anggota->foto) : asset('assets/images/profile/placeholder.png') }}" 
                                                     alt="{{ $anggota->nama }}" 
                                                     class="rounded-circle me-3 border border-2 border-white shadow-sm"
                                                     style="width: 60px; height: 60px; object-fit: cover;"
                                                     onerror="this.onerror=null;this.src='{{ asset('assets/images/profile/placeholder.png') }}';">
                                                <div>
                                                    <h6 class="mb-1 text-dark">{{ $anggota->nama }}</h6>
                                                    <small class="text-muted d-block mb-1">NIA: {{ $anggota->nomor_anggota ?? '-' }}</small>
                                                    {{-- <a href="#" class="btn btn-xs btn-outline-primary py-0 px-2" style="font-size: 0.75rem;">Detail</a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-warning d-flex align-items-center" role="alert">
                                    <i class="fa fa-exclamation-triangle me-2"></i>
                                    <div>
                                        Belum ada anggota yang menjabat posisi ini.
                                    </div>
                                </div>
                            @endif

                        </div>
                        <div class="card-footer bg-white border-top p-3 d-flex justify-content-between">
                            <a href="{{ route('jabatan-lembaga.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left me-2"></i>Kembali
                            </a>
                            <div class="d-flex gap-2">
                                <a href="{{ route('jabatan-lembaga.edit', $jabatan->jabatan_id) }}" class="btn btn-warning text-white">
                                    <i class="fa fa-edit me-2"></i>Edit Jabatan
                                </a>
                                <form action="{{ route('jabatan-lembaga.destroy', $jabatan->jabatan_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jabatan ini?')">
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
@endsection
