@extends('layouts.guest.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="fw-bold mb-0">Tambah Data RW</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('rw.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nomor_rw" class="form-label">Nomor RW</label>
                            <input type="text" class="form-control @error('nomor_rw') is-invalid @enderror" id="nomor_rw" name="nomor_rw" value="{{ old('nomor_rw') }}" placeholder="Contoh: 001">
                            @error('nomor_rw')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ketua_rw_warga_id" class="form-label">Ketua RW (Dari Data Warga)</label>
                            <select class="form-select @error('ketua_rw_warga_id') is-invalid @enderror" id="ketua_rw_warga_id" name="ketua_rw_warga_id">
                                <option value="" selected disabled>Pilih Warga</option>
                                @foreach($wargas as $warga)
                                    <option value="{{ $warga->warga_id }}" {{ old('ketua_rw_warga_id') == $warga->warga_id ? 'selected' : '' }}>
                                        {{ $warga->nama }} (NIK: {{ $warga->no_ktp }})
                                    </option>
                                @endforeach
                            </select>
                            @error('ketua_rw_warga_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                             <label for="keterangan" class="form-label">Keterangan</label>
                             <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                             @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="foto_profil" class="form-label">Foto Profil (Optional)</label>
                            <input class="form-control @error('foto_profil') is-invalid @enderror" type="file" id="foto_profil" name="foto_profil">
                            @error('foto_profil')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('rw.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
