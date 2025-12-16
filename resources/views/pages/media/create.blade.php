@extends('layouts.guest.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Tambah Media Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="ref_table" class="form-label">Tabel Referensi (Ref Table)</label>
                    <select name="ref_table" id="ref_table" class="form-control @error('ref_table') is-invalid @enderror">
                        <option value="">-- Pilih Tabel --</option>
                        <option value="perangkat_desa" {{ old('ref_table') == 'perangkat_desa' ? 'selected' : '' }}>Perangkat Desa</option>
                        <option value="lembaga_desa" {{ old('ref_table') == 'lembaga_desa' ? 'selected' : '' }}>Lembaga Desa</option>
                        {{-- Tambahkan opsi lain sesuai kebutuhan --}}
                    </select>
                    @error('ref_table') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="ref_id" class="form-label">ID Referensi (Ref ID)</label>
                    <input type="number" name="ref_id" class="form-control @error('ref_id') is-invalid @enderror" value="{{ old('ref_id') }}" placeholder="Contoh: 1">
                    @error('ref_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="file_upload" class="form-label">Upload File</label>
                    <input type="file" name="file_upload" class="form-control @error('file_upload') is-invalid @enderror">
                    <small class="text-muted">Format: jpg, png, gif, pdf. Max: 2MB.</small>
                    @error('file_upload') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="caption" class="form-label">Caption / Keterangan</label>
                    <input type="text" name="caption" class="form-control @error('caption') is-invalid @enderror" value="{{ old('caption') }}">
                    @error('caption') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="sort_order" class="form-label">Urutan (Sort Order)</label>
                    <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', 0) }}">
                    @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('media.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Media</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
