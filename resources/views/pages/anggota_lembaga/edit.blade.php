@extends('layouts.guest.app')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                <div class="card border-0 shadow rounded-3">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h4 class="text-primary fw-bold text-center">Edit Anggota Lembaga</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('anggota-lembaga.update', $anggota->anggota_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select @error('lembaga_id') is-invalid @enderror" id="lembaga_id" name="lembaga_id">
                                            <option value="" disabled>Pilih Lembaga</option>
                                            @foreach($lembagas as $lembaga)
                                                <option value="{{ $lembaga->lembaga_id }}" {{ old('lembaga_id', $anggota->lembaga_id) == $lembaga->lembaga_id ? 'selected' : '' }}>
                                                    {{ $lembaga->nama_lembaga }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="lembaga_id">Lembaga Desa</label>
                                        @error('lembaga_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select @error('jabatan_id') is-invalid @enderror" id="jabatan_id" name="jabatan_id">
                                            <option value="" disabled>Pilih Jabatan</option>
                                            @foreach($jabatans as $jabatan)
                                                <option value="{{ $jabatan->jabatan_id }}" {{ old('jabatan_id', $anggota->jabatan_id) == $jabatan->jabatan_id ? 'selected' : '' }}>
                                                    {{ $jabatan->nama_jabatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="jabatan_id">Jabatan</label>
                                        @error('jabatan_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select @error('warga_id') is-invalid @enderror" id="warga_id" name="warga_id">
                                    <option value="" disabled>Pilih Anggota Warga</option>
                                    @foreach($wargas as $warga)
                                        <option value="{{ $warga->warga_id }}" {{ old('warga_id', $anggota->warga_id) == $warga->warga_id ? 'selected' : '' }}>
                                            {{ $warga->nama }} (NIK: {{ $warga->no_ktp }})
                                        </option>
                                    @endforeach
                                </select>
                                <label for="warga_id">Nama Anggota</label>
                                @error('warga_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror" id="tgl_mulai" name="tgl_mulai" value="{{ old('tgl_mulai', $anggota->tgl_mulai) }}">
                                        <label for="tgl_mulai">Tanggal Mulai Menjabat</label>
                                        @error('tgl_mulai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror" id="tgl_selesai" name="tgl_selesai" value="{{ old('tgl_selesai', $anggota->tgl_selesai) }}">
                                        <label for="tgl_selesai">Tanggal Selesai (Opsional)</label>
                                        @error('tgl_selesai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="foto_profil" class="form-label text-muted small">Foto Profil (Biarkan kosong jika tidak diubah)</label>
                                @if($anggota->foto_profile)
                                    <div class="mb-2">
                                        <img src="{{ $anggota->foto_profile->url }}" alt="Foto Profil" class="rounded" width="100">
                                    </div>
                                @endif
                                <input class="form-control @error('foto_profil') is-invalid @enderror" type="file" id="foto_profil" name="foto_profil">
                                @error('foto_profil')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('anggota-lembaga.index') }}" class="btn btn-light w-50 py-3 rounded-pill">Batal</a>
                                <button type="submit" class="btn btn-primary w-50 py-3 rounded-pill">Update Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
