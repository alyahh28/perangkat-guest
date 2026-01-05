@extends('layouts.guest.app')

@section('content')
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card form-card shadow border-0">
                        {{-- Header Card --}}
                        <div class="card-header bg-info text-white">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-id-card fa-2x me-3"></i>
                                    <div>
                                        <h4 class="mb-0 text-white">Detail User</h4>
                                        <small class="opacity-75">Informasi lengkap pengguna</small>
                                    </div>
                                </div>
                                {{-- Status Badge di Header --}}
                                <span class="badge bg-white text-info fw-bold px-3 py-2 rounded-pill">
                                    {{ $user->role ?? 'User' }}
                                </span>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            {{-- Avatar / Foto dari Tabel Media --}}
                            <div class="text-center mb-4">
                                @php
                                    // Coba ambil berdasarkan media_id di users
                                    $userMedia = null;

                                    if ($user->media_id) {
                                        $userMedia = \App\Models\Media::find($user->media_id);
                                    }

                                    // Jika tidak ada, cari berdasarkan ref_id
                                    if (!$userMedia) {
                                        $userMedia = \App\Models\Media::where('ref_table', 'users')
                                            ->where('ref_id', $user->id)
                                            ->first();

                                        // Jika ditemukan, update media_id di user
                                        if ($userMedia && $user->media_id != $userMedia->media_id) {
                                            $user->media_id = $userMedia->media_id;
                                            $user->save();
                                        }
                                    }
                                @endphp

                                @if ($userMedia)
                                    {{-- Tampilkan foto dari media_id --}}
                                    <div class="position-relative d-inline-block">
                                        <img src="{{ asset('storage/users/' . $userMedia->file_name) }}"
                                            alt="Foto {{ $user->name }}"
                                            class="rounded-circle shadow-sm border border-4 border-white"
                                            style="width: 120px; height: 120px; object-fit: cover;"
                                            onerror="this.onerror=null;this.src='{{ asset('assets/images/profile/placeholder.png') }}';"
                                            title="Media ID: {{ $userMedia->media_id }} | User Media ID: {{ $user->media_id }}">

                                        <span class="position-absolute top-0 end-0 badge bg-info rounded-pill">
                                            MID: {{ $userMedia->media_id }}
                                        </span>
                                    </div>

                                    <div class="mt-3">
                                        <small class="text-info">
                                            <i class="fa fa-database me-1"></i>
                                            media_id di users: <strong>{{ $user->media_id }}</strong>
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            <i class="fa fa-image me-1"></i>
                                            File: {{ $userMedia->file_name }}
                                        </small>
                                    </div>
                                @else
                                    {{-- Default --}}
                                    <img src="{{ asset('assets/images/profile/placeholder.png') }}" alt="Foto Default"
                                        class="rounded-circle shadow-sm border border-4 border-white"
                                        style="width: 120px; height: 120px; object-fit: cover;">

                                    <div class="mt-3">
                                        <small class="text-muted">
                                            <i class="fa fa-exclamation-circle me-1"></i>
                                            media_id di users: <strong>{{ $user->media_id ?? 'NULL' }}</strong>
                                        </small>
                                    </div>
                                @endif

                                <h3 class="mt-3 mb-1">{{ $user->name }}</h3>
                                <p class="text-muted">{{ $user->email }}</p>
                            </div>
                            <hr>


                            {{-- Informasi Detail --}}
                            <div class="row g-4 mt-2">
                                {{-- Username --}}
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded h-100">
                                        <small class="text-muted text-uppercase fw-bold d-block mb-1">Username</small>
                                        <span class="fs-5 text-dark fw-bold">{{ $user->username }}</span>
                                    </div>
                                </div>

                                {{-- Role --}}
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded h-100">
                                        <small class="text-muted text-uppercase fw-bold d-block mb-1">Role Akses</small>
                                        <span class="fs-5 text-dark">{{ $user->role }}</span>
                                    </div>
                                </div>

                                {{-- Status Akun --}}
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded h-100">
                                        <small class="text-muted text-uppercase fw-bold d-block mb-1">Status Akun</small>
                                        @if ($user->activiti == 'Aktif')
                                            <span class="text-success fw-bold"><i class="fa fa-check-circle me-1"></i>
                                                Aktif</span>
                                        @else
                                            <span class="text-danger fw-bold"><i class="fa fa-times-circle me-1"></i> Tidak
                                                Aktif</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Tanggal Bergabung --}}
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded h-100">
                                        <small class="text-muted text-uppercase fw-bold d-block mb-1">Tanggal
                                            Bergabung</small>
                                        <span
                                            class="text-dark">{{ $user->created_at ? $user->created_at->format('d F Y, H:i') . ' WIB' : '-' }}</span>
                                    </div>
                                </div>

                                {{-- Tanggal Update Terakhir --}}
                                <div class="col-md-12">
                                    <div class="p-3 bg-light rounded h-100">
                                        <small class="text-muted text-uppercase fw-bold d-block mb-1">Terakhir
                                            Diupdate</small>
                                        <span
                                            class="text-dark">{{ $user->updated_at ? $user->updated_at->format('d F Y, H:i') . ' WIB' : '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Footer Actions --}}
                        <div class="card-footer bg-white p-4 border-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary px-4">
                                    <i class="fa fa-arrow-left me-2"></i>Kembali
                                </a>

                                <div class="d-flex gap-2">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning px-4 text-white">
                                        <i class="fa fa-edit me-2"></i>Edit
                                    </a>

                                    {{-- Tombol Hapus (Opsional di detail) --}}
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger px-4">
                                            <i class="fa fa-trash me-2"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
