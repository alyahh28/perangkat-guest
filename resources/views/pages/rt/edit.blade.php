@extends('layouts.guest.app')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="card border-0 shadow rounded-3">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h4 class="text-primary fw-bold text-center">Edit Data RT</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('rt.update', $rt->rt_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-floating mb-3">
                                <select class="form-select @error('rw_id') is-invalid @enderror" id="rw_id" name="rw_id">
                                    <option value="" disabled>Pilih RW Induk</option>
                                    @foreach($rws as $rw)
                                        <option value="{{ $rw->rw_id }}" {{ old('rw_id', $rt->rw_id) == $rw->rw_id ? 'selected' : '' }}>
                                            RW {{ $rw->nomor_rw }} - {{ $rw->ketua->nama ?? '-' }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="rw_id">RW Induk</label>
                                @error('rw_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('nomor_rt') is-invalid @enderror" id="nomor_rt" name="nomor_rt" value="{{ old('nomor_rt', $rt->nomor_rt) }}" placeholder="Nomor RT">
                                <label for="nomor_rt">Nomor RT</label>
                                @error('nomor_rt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select @error('ketua_rt_warga_id') is-invalid @enderror" id="ketua_rt_warga_id" name="ketua_rt_warga_id">
                                    <option value="" disabled>Pilih Warga</option>
                                    @foreach($wargas as $warga)
                                        <option value="{{ $warga->warga_id }}" {{ old('ketua_rt_warga_id', $rt->ketua_rt_warga_id) == $warga->warga_id ? 'selected' : '' }}>
                                            {{ $warga->nama }} (NIK: {{ $warga->no_ktp }})
                                        </option>
                                    @endforeach
                                </select>
                                <label for="ketua_rt_warga_id">Ketua RT</label>
                                @error('ketua_rt_warga_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-floating mb-4">
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" style="height: 100px" placeholder="Keterangan">{{ old('keterangan', $rt->keterangan) }}</textarea>
                                <label for="keterangan">Keterangan</label>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="foto_profil" class="form-label text-muted small">Foto Profil (Biarkan kosong jika tidak diubah)</label>
                                @if($rt->foto_profile)
                                    <div class="mb-2">
                                        <img src="{{ $rt->foto_profile->url }}" alt="Foto Profil" class="rounded" width="100">
                                    </div>
                                @endif
                                <input class="form-control @error('foto_profil') is-invalid @enderror" type="file" id="foto_profil" name="foto_profil">
                                @error('foto_profil')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('rt.index') }}" class="btn btn-light w-50 py-3 rounded-pill">Batal</a>
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
