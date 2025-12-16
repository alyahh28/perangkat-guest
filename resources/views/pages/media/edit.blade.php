@extends('layouts.guest.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Edit Media</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('media.update', $media->media_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="ref_table" class="form-label">Tabel Referensi</label>
                    <select name="ref_table" id="ref_table" class="form-control @error('ref_table') is-invalid @enderror">
                        <option value="perangkat_desa" {{ old('ref_table', $media->ref_table) == 'perangkat_desa' ? 'selected' : '' }}>Perangkat Desa</option>
                        <option value="lembaga_desa" {{ old('ref_table', $media->ref_table) == 'lembaga_desa' ? 'selected' : '' }}>Lembaga Desa</option>
                    </select>
                    @error('ref_table') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="ref_id" class="form-label">ID Referensi</label>
                    <input type="number" name="ref_id" class="form-control @error('ref_id') is-invalid @enderror" value="{{ old('ref_id', $media->ref_id) }}">
                    @error('ref_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">File Saat Ini</label>
                    <div class="mb-2">
                        @if(str_contains($media->mime_type, 'image'))
                            <img src="{{ $media->url }}" alt="Current Image" class="img-thumbnail" style="max-height: 150px;">
                        @else
                            <a href="{{ $media->url }}" target="_blank" class="btn btn-info btn-sm">Lihat File ({{ $media->file_name }})</a>
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <label for="file_upload" class="form-label">Ganti File (Opsional)</label>
                    <input type="file" name="file_upload" class="form-control @error('file_upload') is-invalid @enderror">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti file.</small>
                    @error('file_upload') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="caption" class="form-label">Caption</label>
                    <input type="text" name="caption" class="form-control @error('caption') is-invalid @enderror" value="{{ old('caption', $media->caption) }}">
                    @error('caption') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="sort_order" class="form-label">Urutan</label>
                    <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $media->sort_order) }}">
                    @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('media.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Update Media</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
