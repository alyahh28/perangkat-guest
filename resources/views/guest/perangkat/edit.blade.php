<!DOCTYPE html>
<html lang="en">

<head>
    {{-- START CSS --}}
    @include('layouts.css')
    {{-- END CSS --}}
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        {{-- START HEADER --}}
        <!-- Navbar & Hero Start -->
        @include('layouts.header')
        <!-- Navbar & Hero End -->
        {{-- END HEADER --}}

        <!-- Content Start -->
        <div class="container-xxl py-5">
            <div class="container px-lg-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow">
                            <div class="card-header bg-warning text-white">
                                <h4 class="mb-0">Form Edit Perangkat Desa</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('perangkat.update', $dataPerangkat->perangkat_id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="warga_id" class="form-label">Nama Warga *</label>
                                            <select class="form-select @error('warga_id') is-invalid @enderror"
                                                id="warga_id" name="warga_id" required>
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

                                        <div class="col-md-6 mb-3">
                                            <label for="jabatan" class="form-label">Jabatan *</label>
                                            <input type="text"
                                                class="form-control @error('jabatan') is-invalid @enderror"
                                                id="jabatan" name="jabatan"
                                                value="{{ old('jabatan', $dataPerangkat->jabatan) }}" required>
                                            @error('jabatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="nip" class="form-label">NIP</label>
                                            <input type="text"
                                                class="form-control @error('nip') is-invalid @enderror" id="nip"
                                                name="nip" value="{{ old('nip', $dataPerangkat->nip) }}">
                                            @error('nip')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="kontak" class="form-label">Kontak *</label>
                                            <input type="text"
                                                class="form-control @error('kontak') is-invalid @enderror"
                                                id="kontak" name="kontak"
                                                value="{{ old('kontak', $dataPerangkat->kontak) }}" required>
                                            @error('kontak')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="periode_mulai" class="form-label">Periode Mulai *</label>
                                            <input type="date"
                                                class="form-control @error('periode_mulai') is-invalid @enderror"
                                                id="periode_mulai" name="periode_mulai"
                                                value="{{ old('periode_mulai', $dataPerangkat->periode_mulai) }}"
                                                required>
                                            @error('periode_mulai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

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

                                        <div class="col-12 mb-3">
                                            <label for="foto" class="form-label">Foto</label>
                                            @if ($dataPerangkat->foto)
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $dataPerangkat->foto) }}"
                                                        alt="Foto" class="rounded" width="100">
                                                    <br>
                                                    <small class="text-muted">Foto saat ini</small>
                                                </div>
                                            @endif
                                            <input type="file"
                                                class="form-control @error('foto') is-invalid @enderror" id="foto"
                                                name="foto" accept="image/*">
                                            @error('foto')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Format: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <a href="{{ route('perangkat.index') }}" class="btn btn-secondary">
                                            <i class="fa fa-arrow-left me-2"></i>Kembali
                                        </a>
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fa fa-save me-2"></i>Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content End -->

        <!-- Footer Start -->
        @include('layouts.footer')
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i
                class="bi bi-arrow-up"></i></a>
    </div>

    {{-- START JS --}}
    @include('layouts.js')
    {{-- END JS --}}
</body>

</html>
