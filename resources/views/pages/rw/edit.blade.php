@extends('layouts.guest.app')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="card border-0 shadow rounded-3">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h4 class="text-primary fw-bold text-center">Edit Data RW</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('rw.update', $rw->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('no_rw') is-invalid @enderror" id="no_rw" name="no_rw" value="{{ old('no_rw', $rw->no_rw) }}" placeholder="Nomor RW">
                                <label for="no_rw">Nomor RW</label>
                                @error('no_rw')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-4">
                                <input type="text" class="form-control @error('ketua_rw') is-invalid @enderror" id="ketua_rw" name="ketua_rw" value="{{ old('ketua_rw', $rw->ketua_rw) }}" placeholder="Nama Ketua RW">
                                <label for="ketua_rw">Nama Ketua RW</label>
                                @error('ketua_rw')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('rw.index') }}" class="btn btn-light w-50 py-3">Batal</a>
                                <button type="submit" class="btn btn-primary w-50 py-3">Update Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
