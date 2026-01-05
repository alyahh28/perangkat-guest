@extends('layouts.guest.app')

@section('content')
    <!-- Content Start -->
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header bg-gradient-warning text-white py-4">
                            <div class="text-center">
                                <i class="fa fa-user-edit fa-2x mb-3"></i>
                                <h4 class="mb-0">Edit Data Warga</h4>
                                <p class="mb-0 mt-2">Perbarui informasi data warga desa</p>
                            </div>
                        </div>
                        <div class="card-body p-5">
                            <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Data Pribadi -->
                                    <div class="col-12 mb-4">
                                        <h5 class="text-warning mb-3 border-bottom pb-2">Data Pribadi</h5>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="nama" class="form-label fw-bold">Nama Lengkap *</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-warning text-white">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <input type="text"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                id="nama" name="nama"
                                                value="{{ old('nama', $warga->nama) }}"
                                                placeholder="Masukkan nama lengkap" required>
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="no_ktp" class="form-label fw-bold">NIK *</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-warning text-white">
                                                <i class="fa fa-id-card"></i>
                                            </span>
                                            <input type="text"
                                                class="form-control @error('no_ktp') is-invalid @enderror"
                                                id="no_ktp" name="no_ktp"
                                                value="{{ old('no_ktp', $warga->no_ktp) }}"
                                                placeholder="Masukkan Nomor Induk Kependudukan" required>
                                            @error('no_ktp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="jenis_kelamin" class="form-label fw-bold">Jenis Kelamin *</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-warning text-white">
                                                <i class="fa fa-venus-mars"></i>
                                            </span>
                                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                                id="jenis_kelamin" name="jenis_kelamin" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="Laki-laki" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="agama" class="form-label fw-bold">Agama *</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-warning text-white">
                                                <i class="fa fa-pray"></i>
                                            </span>
                                            <select class="form-control @error('agama') is-invalid @enderror"
                                                id="agama" name="agama" required>
                                                <option value="">Pilih Agama</option>
                                                <option value="Islam" {{ old('agama', $warga->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Kristen" {{ old('agama', $warga->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="Katolik" {{ old('agama', $warga->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                <option value="Hindu" {{ old('agama', $warga->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Buddha" {{ old('agama', $warga->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                <option value="Konghucu" {{ old('agama', $warga->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                            </select>
                                            @error('agama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="pekerjaan" class="form-label fw-bold">Pekerjaan *</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-warning text-white">
                                                <i class="fa fa-briefcase"></i>
                                            </span>
                                            <input type="text"
                                                class="form-control @error('pekerjaan') is-invalid @enderror"
                                                id="pekerjaan" name="pekerjaan"
                                                value="{{ old('pekerjaan', $warga->pekerjaan) }}"
                                                placeholder="Masukkan pekerjaan" required>
                                            @error('pekerjaan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Data Kontak -->
                                    <div class="col-12 mb-4 mt-3">
                                        <h5 class="text-warning mb-3 border-bottom pb-2">Data Kontak</h5>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="email" class="form-label fw-bold">Alamat Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-warning text-white">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email"
                                                value="{{ old('email', $warga->email) }}"
                                                placeholder="contoh: user@desa.id">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="telp" class="form-label fw-bold">Nomor Telepon *</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-warning text-white">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                            <input type="text"
                                                class="form-control @error('telp') is-invalid @enderror"
                                                id="telp" name="telp"
                                                value="{{ old('telp', $warga->telp) }}"
                                                placeholder="Masukkan nomor telepon" required>
                                            @error('telp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Info Alert -->
                                <div class="alert alert-warning border-warning">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-exclamation-triangle me-3 fa-lg"></i>
                                        <div>
                                            <h6 class="alert-heading mb-1">Perhatian!</h6>
                                            <p class="mb-0 small">
                                                Password hanya perlu diisi jika ingin mengubah password user.
                                                Jika tidak, biarkan kolom password kosong.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                                    <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary btn-lg">
                                        <i class="fa fa-arrow-left me-2"></i>Kembali ke Daftar
                                    </a>
                                    <button type="submit" class="btn btn-warning btn-lg px-4">
                                        <i class="fa fa-save me-2"></i>Update Data Warga
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Warga Info Card -->
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fa fa-calendar text-warning me-3"></i>
                                        <div>
                                            <small class="text-muted d-block">Tanggal Dibuat</small>
                                            <strong>{{ $warga->created_at->format('d F Y') }}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fa fa-clock text-warning me-3"></i>
                                        <div>
                                            <small class="text-muted d-block">Terakhir Diupdate</small>
                                            <strong>{{ $warga->updated_at->format('d F Y') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content End -->
@endsection
