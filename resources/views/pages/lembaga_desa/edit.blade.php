@extends('layouts.guest.app')

@section('content')
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card lembaga-form-card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">
                                <i class="fa fa-edit me-2"></i>Edit Data Lembaga Desa
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('lembaga.update', $lembaga->lembaga_id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- BAGIAN 1: DATA UTAMA (Wajib Ada) --}}
                                <div class="mb-4 border-bottom pb-4">
                                    <h5 class="mb-3 text-primary">Informasi Dasar</h5>

                                    <div class="mb-3">
                                        <label for="nama_lembaga" class="form-label fw-semibold">Nama Lembaga</label>
                                        <input type="text" class="form-control" id="nama_lembaga" name="nama_lembaga"
                                            value="{{ old('nama_lembaga', $lembaga->nama_lembaga) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi / Profil</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $lembaga->deskripsi) }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kontak" class="form-label fw-semibold">Kontak</label>
                                        <input type="text" class="form-control" id="kontak" name="kontak"
                                            value="{{ old('kontak', $lembaga->kontak) }}">
                                    </div>
                                </div>

                                {{-- BAGIAN 2: UPLOAD LOGO --}}
                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">Manajemen Logo</h5>

                                    @if ($lembaga->logo)
                                        <div class="card bg-light mb-3">
                                            <div class="card-body">
                                                <label class="form-label fw-semibold">Logo Utama (Lama)</label>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/logos/' . $lembaga->logo) }}"
                                                        alt="Logo Lama" class="img-thumbnail me-3"
                                                        style="width: 80px; height: 80px; object-fit: contain;">

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remove_logo"
                                                            id="remove_logo" value="1">
                                                        <label class="form-check-label text-danger" for="remove_logo">
                                                            Hapus Logo Ini
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($lembaga->galeri && $lembaga->galeri->count() > 0)
                                        <label class="form-label fw-semibold mt-2">Galeri Logo Tersimpan</label>
                                        <div class="row">
                                            @foreach ($lembaga->galeri as $media)
                                                <div class="col-md-4 mb-3">
                                                    <div class="card h-100 border">
                                                        <div class="position-relative">
                                                            <img src="{{ asset('storage/uploads/' . $media->file_name) }}"
                                                                class="card-img-top" alt="Media"
                                                                style="height: 120px; object-fit: contain; padding: 10px;">
                                                            <div class="position-absolute top-0 end-0 p-2">
                                                                <div class="form-check bg-white rounded p-1 border">
                                                                    <input type="checkbox" name="remove_media[]"
                                                                        value="{{ $media->media_id }}"
                                                                        class="form-check-input ms-0"
                                                                        id="rm_{{ $media->media_id }}">
                                                                    <label for="rm_{{ $media->media_id }}"
                                                                        class="text-danger small fw-bold ps-1">Hapus</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body p-2">
                                                            <small class="text-muted d-block">Caption:</small>
                                                            <input type="text" name="captions[{{ $media->media_id }}]"
                                                                value="{{ $media->caption }}"
                                                                class="form-control form-control-sm mb-1">

                                                            <small class="text-muted d-block">Urutan:</small>
                                                            <input type="number" name="sort_orders[{{ $media->media_id }}]"
                                                                value="{{ $media->sort_order }}"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="mt-3">
                                        <label class="form-label fw-semibold">Upload Logo Baru</label>
                                        <div id="new-logos-container">
                                            <div class="logo-upload-item card p-3 mb-2 bg-light border-0">
                                                <input type="file" name="logos[]" class="form-control mb-2"
                                                    accept="image/*">
                                                <div class="row g-2">
                                                    <div class="col-md-8">
                                                        <input type="text" name="captions_new[]"
                                                            class="form-control form-control-sm"
                                                            placeholder="Caption Gambar">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="number" name="sort_orders_new[]"
                                                            class="form-control form-control-sm" placeholder="Urutan"
                                                            value="0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-logo">
                                            <i class="fa fa-plus me-1"></i> Tambah File Lain
                                        </button>
                                    </div>
                                </div>

                                {{-- BAGIAN 3: TOMBOL ACTION (PENTING) --}}
                                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                                    <a href="{{ route('lembaga.index') }}" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fa fa-save me-1"></i> Simpan Perubahan
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-logo').addEventListener('click', function() {
            const container = document.getElementById('new-logos-container');
            const newItem = document.createElement('div');
            newItem.className = 'logo-upload-item card p-3 mb-2 bg-light border-0';
            newItem.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <input type="file" name="logos[]" class="form-control" accept="image/*">
                <button type="button" class="btn btn-danger btn-sm ms-2 remove-row" onclick="this.closest('.logo-upload-item').remove()">X</button>
            </div>
            <div class="row g-2">
                <div class="col-md-8">
                    <input type="text" name="captions_new[]" class="form-control form-control-sm" placeholder="Caption Gambar">
                </div>
                <div class="col-md-4">
                    <input type="number" name="sort_orders_new[]" class="form-control form-control-sm" placeholder="Urutan" value="0">
                </div>
            </div>
        `;
            container.appendChild(newItem);
        });
    </script>
@endsection
