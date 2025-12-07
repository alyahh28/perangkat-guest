{{-- start css --}}
@include('layouts.guest.css')
{{-- end css --}}

{{-- start header --}}
@include('layouts.guest.header')
{{-- end header --}}

{{-- start content --}}
<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card lembaga-form-card">
                    <div class="card-header">
                        <h4 class="mb-0 text-white">
                            <i class="fa fa-edit me-2"></i>Edit Data Lembaga Desa
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('lembaga.update', $lembaga->lembaga_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Logo Upload -->
                            <div class="mb-4">
                                <label for="logo" class="form-label fw-semibold">Logo Lembaga</label>

                                <!-- Logo Saat Ini -->
                                @if($lembaga->logo)
                                    <div class="mb-3">
                                        <p class="text-muted mb-1">Logo saat ini:</p>
                                        <img src="{{ $lembaga->logo_url }}" alt="Logo {{ $lembaga->nama_lembaga }}"
                                             style="max-width: 150px; height: auto;" class="img-thumbnail">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" name="remove_logo" id="remove_logo">
                                            <label class="form-check-label text-danger" for="remove_logo">
                                                Hapus logo saat ini
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-muted mb-2">Belum ada logo</p>
                                @endif

                                <!-- Upload Logo Baru -->
                                <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                       id="logo" name="logo"
                                       accept="image/*">
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: JPG, PNG, GIF (Maksimal: 2MB)</small>
                                <div class="mt-2">
                                    <img id="logo-preview" src="#" alt="Preview Logo Baru" style="max-width: 200px; display: none;" class="img-thumbnail">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="nama_lembaga" class="form-label fw-semibold">Nama Lembaga <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg @error('nama_lembaga') is-invalid @enderror"
                                       id="nama_lembaga" name="nama_lembaga"
                                       value="{{ old('nama_lembaga', $lembaga->nama_lembaga) }}" required maxlength="100"
                                       placeholder="Masukkan nama lembaga">
                                @error('nama_lembaga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="deskripsi" class="form-label fw-semibold">Deskripsi Lembaga</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                          id="deskripsi" name="deskripsi" rows="5"
                                          placeholder="Deskripsikan tentang lembaga ini">{{ old('deskripsi', $lembaga->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="kontak" class="form-label fw-semibold">Kontak</label>
                                <input type="text" class="form-control @error('kontak') is-invalid @enderror"
                                       id="kontak" name="kontak"
                                       value="{{ old('kontak', $lembaga->kontak) }}" maxlength="50"
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
                                    <i class="fa fa-save me-2"></i>Update Lembaga
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end content --}}

<!-- Footer Start -->
@include('layouts.guest.footer')
<!-- Footer End -->

{{-- START JS --}}
@include('layouts.guest.js')
