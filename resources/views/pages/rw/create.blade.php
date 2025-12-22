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
                    <form action="{{ route('rw.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="no_rw" class="form-label">Nomor RW</label>
                            <input type="text" class="form-control @error('no_rw') is-invalid @enderror" id="no_rw" name="no_rw" value="{{ old('no_rw') }}" placeholder="Contoh: 001">
                            @error('no_rw')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ketua_rw" class="form-label">Nama Ketua RW</label>
                            <input type="text" class="form-control @error('ketua_rw') is-invalid @enderror" id="ketua_rw" name="ketua_rw" value="{{ old('ketua_rw') }}" placeholder="Nama Lengkap">
                            @error('ketua_rw')
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
