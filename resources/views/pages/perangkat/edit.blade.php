@extends('layouts.guest.app')

@section('content')
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow">
                        <div class="card-header bg-warning text-white">
                            <h4 class="mb-0">Form Edit Perangkat Desa</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('perangkat.update', $dataPerangkat->perangkat_id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    {{-- NAMA WARGA --}}
                                    <div class="col-md-6 mb-3">
                                        <label for="warga_id" class="form-label">Nama Warga *</label>
                                        <select class="form-select @error('warga_id') is-invalid @enderror" id="warga_id"
                                            name="warga_id" required>
                                            <option value="">Pilih Warga</option>
                                            @foreach ($dataWarga as $warga)
                                                <option value="{{ $warga->warga_id }}"
                                                    {{ old('warga_id', $dataPerangkat->warga_id) == $warga->warga_id ? 'selected' : '' }}>
                                                    {{ $warga->nama }} - {{ $warga->no_ktp }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('warga_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- JABATAN --}}
                                    <div class="col-md-6 mb-3">
                                        <label for="jabatan" class="form-label">Jabatan *</label>
                                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                            id="jabatan" name="jabatan"
                                            value="{{ old('jabatan', $dataPerangkat->jabatan) }}" required>
                                        @error('jabatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- NIP --}}
                                    <div class="col-md-6 mb-3">
                                        <label for="nip" class="form-label">NIP</label>
                                        <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                            id="nip" name="nip" value="{{ old('nip', $dataPerangkat->nip) }}">
                                        @error('nip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- KONTAK --}}
                                    <div class="col-md-6 mb-3">
                                        <label for="kontak" class="form-label">Kontak *</label>
                                        <input type="text" class="form-control @error('kontak') is-invalid @enderror"
                                            id="kontak" name="kontak"
                                            value="{{ old('kontak', $dataPerangkat->kontak) }}" required>
                                        @error('kontak')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- PERIODE MULAI --}}
                                    <div class="col-md-6 mb-3">
                                        <label for="periode_mulai" class="form-label">Periode Mulai *</label>
                                        <input type="date"
                                            class="form-control @error('periode_mulai') is-invalid @enderror"
                                            id="periode_mulai" name="periode_mulai"
                                            value="{{ old('periode_mulai', $dataPerangkat->periode_mulai) }}" required>
                                        @error('periode_mulai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- PERIODE SELESAI --}}
                                    <div class="col-md-6 mb-3">
                                        <label for="periode_selesai" class="form-label">Periode Selesai</label>
                                        <input type="date"
                                            class="form-control @error('periode_selesai') is-invalid @enderror"
                                            id="periode_selesai" name="periode_selesai"
                                            value="{{ old('periode_selesai', $dataPerangkat->periode_selesai) }}">
                                        @error('periode_selesai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- FOTO UTAMA --}}
                                    <div class="col-12 mb-3">
                                        <label for="foto" class="form-label">Foto Profil Utama</label>
                                        <div class="mb-2">
                                            @php
                                                $placeholder = asset('assets/images/profile/placeholder.png');
                                                $editImgSrc = $dataPerangkat->foto
                                                    ? asset('storage/' . $dataPerangkat->foto)
                                                    : $placeholder;
                                            @endphp
                                            <img src="{{ $editImgSrc }}" alt="Foto" class="rounded shadow-sm"
                                                width="100" onerror="this.onerror=null;this.src='{{ $placeholder }}';">
                                            <br><small class="text-muted">Foto saat ini</small>
                                        </div>
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                            id="foto" name="foto" accept="image/*">
                                        @error('foto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- BAGIAN MEDIA / GALERI --}}
                                <hr>
                                <div class="col-12 mb-3">
                                    <h5 class="mb-3">Galeri / Dokumentasi</h5>

                                    {{-- PERBAIKAN UTAMA DI SINI --}}
                                    @if ($dataPerangkat->galeri && $dataPerangkat->galeri->count() > 0)
                                        <div class="mb-4 p-3 bg-light rounded">
                                            <p class="text-muted fw-bold mb-2">Foto yang sudah diupload:</p>
                                            <div class="row">
                                                @foreach ($dataPerangkat->galeri as $media)
                                                    <div class="col-md-3 mb-3">
                                                        <div class="card h-100 shadow-sm">
                                                            <img src="{{ asset('storage/uploads/' . $media->file_name) }}"
                                                                class="card-img-top"
                                                                style="height: 100px; object-fit: cover;">
                                                            <div class="card-body p-2">
                                                                <div class="form-check mb-2">
                                                                    <input type="checkbox" name="remove_media[]"
                                                                        value="{{ $media->media_id }}"
                                                                        class="form-check-input text-danger">
                                                                    <label
                                                                        class="form-check-label text-danger small">Hapus</label>
                                                                </div>
                                                                <input type="text"
                                                                    name="captions[{{ $media->media_id }}]"
                                                                    value="{{ $media->caption }}" placeholder="Caption"
                                                                    class="form-control form-control-sm mb-1">
                                                                <input type="number"
                                                                    name="sort_orders[{{ $media->media_id }}]"
                                                                    value="{{ $media->sort_order }}" placeholder="Urutan"
                                                                    class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    <label class="form-label fw-bold">Tambah Foto Baru</label>
                                    <div id="new-fotos-container">
                                        <div class="foto-upload-item mb-2 border p-2 rounded">
                                            <input type="file" name="fotos[]" class="form-control mb-2"
                                                accept="image/*">
                                            <div class="row g-2">
                                                <div class="col-md-6"><input type="text" name="captions_new[]"
                                                        class="form-control form-control-sm" placeholder="Caption"></div>
                                                <div class="col-md-6"><input type="number" name="sort_orders_new[]"
                                                        class="form-control form-control-sm" placeholder="Urutan"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="add-foto">
                                        <i class="fa fa-plus"></i> Tambah Foto Lain
                                    </button>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('perangkat.index') }}" class="btn btn-secondary"><i
                                            class="fa fa-arrow-left me-2"></i>Kembali</a>
                                    <button type="submit" class="btn btn-warning text-white"><i
                                            class="fa fa-save me-2"></i>Update Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-foto').addEventListener('click', function() {
            const container = document.getElementById('new-fotos-container');
            const newItem = document.createElement('div');
            newItem.className = 'foto-upload-item mb-2 border p-2 rounded';
            newItem.innerHTML = `
                <input type="file" name="fotos[]" class="form-control mb-2" accept="image/*">
                <div class="row g-2">
                    <div class="col-md-6"><input type="text" name="captions_new[]" class="form-control form-control-sm" placeholder="Caption"></div>
                    <div class="col-md-6"><input type="number" name="sort_orders_new[]" class="form-control form-control-sm" placeholder="Urutan"></div>
                </div>
            `;
            container.appendChild(newItem);
        });
    </script>
@endsection
