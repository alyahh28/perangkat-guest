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
                        <form action="{{ route('rt.update', $rt->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-floating mb-3">
                                <select class="form-select @error('rw_id') is-invalid @enderror" id="rw_id" name="rw_id">
                                    <option value="" disabled>Pilih RW Induk</option>
                                    @foreach($rws as $rw)
                                        <option value="{{ $rw->id }}" {{ old('rw_id', $rt->rw_id) == $rw->id ? 'selected' : '' }}>
                                            RW {{ $rw->no_rw }} - {{ $rw->ketua_rw }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="rw_id">RW Induk</label>
                                @error('rw_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('no_rt') is-invalid @enderror" id="no_rt" name="no_rt" value="{{ old('no_rt', $rt->no_rt) }}" placeholder="Nomor RT">
                                <label for="no_rt">Nomor RT</label>
                                @error('no_rt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-4">
                                <input type="text" class="form-control @error('ketua_rt') is-invalid @enderror" id="ketua_rt" name="ketua_rt" value="{{ old('ketua_rt', $rt->ketua_rt) }}" placeholder="Nama Ketua RT">
                                <label for="ketua_rt">Nama Ketua RT</label>
                                @error('ketua_rt')
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
