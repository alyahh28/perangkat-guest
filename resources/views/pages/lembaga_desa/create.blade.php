@extends('layouts.guest.app')

@section('content')
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card lembaga-form-card">
                        <div class="card-header">
                            <h4 class="mb-0 text-white">
                                <i class="fa fa-plus-circle me-2"></i>Tambah Lembaga Desa Baru
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('lembaga.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Logo Upload -->
                                <div class="mb-4">
                                    <label for="logo" class="form-label fw-semibold">Logo Lembaga</label>
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                        id="logo" name="logo" accept="image/*">
                                    @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Format: JPG, PNG, GIF (Maksimal: 2MB)</small>
                                    <div class="mt-2">
                                        <img id="logo-preview" src="#" alt="Preview Logo"
                                            style="max-width: 200px; display: none;" class="img-thumbnail">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="nama_lembaga" class="form-label fw-semibold">Nama Lembaga <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('nama_lembaga') is-invalid @enderror"
                                        id="nama_lembaga" name="nama_lembaga" value="{{ old('nama_lembaga') }}" required
                                        maxlength="100" placeholder="Masukkan nama lembaga">
                                    @error('nama_lembaga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="deskripsi" class="form-label fw-semibold">Deskripsi Lembaga</label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5"
                                        placeholder="Deskripsikan tentang lembaga ini">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="mb-4">
                                    <label for="kontak" class="form-label fw-semibold">Kontak</label>
                                    <input type="text" class="form-control @error('kontak') is-invalid @enderror"
                                        id="kontak" name="kontak" value="{{ old('kontak') }}" maxlength="50"
                                        placeholder="Nomor telepon atau kontak lainnya">
                                    @error('kontak')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <a href="{{ route('lembaga.index') }}" class="btn btn-secondary btn-lg">
                                        <i class="fa fa-arrow-left me-2"></i>Kembali
                                    </a>
                                    <button type="submit" class="btn btn-add btn-lg">
                                        <i class="fa fa-save me-2"></i>Simpan Lembaga
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
        // Preview logo sebelum upload
        document.getElementById('logo').addEventListener('change', function(e) {
            const preview = document.getElementById('logo-preview');
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });
    </script>
@endsection
