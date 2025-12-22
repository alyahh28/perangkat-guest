@extends('layouts.guest.app')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                <div class="card border-0 shadow rounded-3">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h4 class="text-primary fw-bold text-center">Tambah Anggota Lembaga</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('anggota-lembaga.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select @error('lembaga_desa_id') is-invalid @enderror" id="lembaga_desa_id" name="lembaga_desa_id">
                                            <option value="" selected disabled>Pilih Lembaga</option>
                                            @foreach($lembagas as $lembaga)
                                                {{-- PERBAIKAN DI SINI: Gunakan $lembaga->lembaga_id --}}
                                                <option value="{{ $lembaga->lembaga_id }}" {{ old('lembaga_desa_id') == $lembaga->lembaga_id ? 'selected' : '' }}>
                                                    {{ $lembaga->nama_lembaga }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="lembaga_desa_id">Lembaga Desa</label>
                                        @error('lembaga_desa_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select @error('jabatan_lembaga_id') is-invalid @enderror" id="jabatan_lembaga_id" name="jabatan_lembaga_id">
                                            <option value="" selected disabled>Pilih Jabatan</option>
                                            @foreach($jabatans as $jabatan)
                                                {{-- PERBAIKAN DI SINI: Gunakan $jabatan->jabatan_id --}}
                                                <option value="{{ $jabatan->jabatan_id }}" {{ old('jabatan_lembaga_id') == $jabatan->jabatan_id ? 'selected' : '' }}>
                                                    {{ $jabatan->nama_jabatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="jabatan_lembaga_id">Jabatan</label>
                                        @error('jabatan_lembaga_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama Lengkap">
                                <label for="nama">Nama Lengkap</label>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('nomor_anggota') is-invalid @enderror" id="nomor_anggota" name="nomor_anggota" value="{{ old('nomor_anggota') }}" placeholder="Nomor Anggota / NIP">
                                <label for="nomor_anggota">Nomor Anggota / NIP (Opsional)</label>
                                @error('nomor_anggota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="foto" class="form-label text-muted small">Foto Profil (Opsional)</label>
                                <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto">
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('anggota-lembaga.index') }}" class="btn btn-light w-50 py-3 rounded-pill">Batal</a>
                                <button type="submit" class="btn btn-primary w-50 py-3 rounded-pill">Simpan Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
