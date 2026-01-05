@extends('layouts.guest.app')

@section('content')
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card unified-form-card">
                        <div class="card-header">
                            <h4 class="mb-0 text-white">
                                <i class="fa fa-plus-circle me-2"></i>Tambah Jabatan Lembaga Baru
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('jabatan-lembaga.store') }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <label for="lembaga_id" class="form-label fw-semibold">Lembaga <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select form-control-lg @error('lembaga_id') is-invalid @enderror"
                                        id="lembaga_id" name="lembaga_id" required>
                                        <option value="">Pilih Lembaga</option>
                                        @foreach ($lembaga as $item)
                                            <option value="{{ $item->lembaga_id }}"
                                                {{ old('lembaga_id') == $item->lembaga_id ? 'selected' : '' }}>
                                                {{ $item->nama_lembaga }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('lembaga_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="nama_jabatan" class="form-label fw-semibold">Nama Jabatan <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('nama_jabatan') is-invalid @enderror"
                                        id="nama_jabatan" name="nama_jabatan" value="{{ old('nama_jabatan') }}" required
                                        maxlength="100" placeholder="Masukkan nama jabatan">
                                    @error('nama_jabatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="level" class="form-label fw-semibold">Level <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('level') is-invalid @enderror" id="level"
                                        name="level" required>
                                        <option value="">Pilih Level</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}"
                                                {{ old('level') == $i ? 'selected' : '' }}>
                                                Level {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('level')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Level 1 adalah level tertinggi</small>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <a href="{{ route('jabatan-lembaga.index') }}" class="btn btn-secondary btn-lg">
                                        <i class="fa fa-arrow-left me-2"></i>Kembali
                                    </a>
                                    <button type="submit" class="btn btn-add btn-lg">
                                        <i class="fa fa-save me-2"></i>Simpan Jabatan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
