@extends('layouts.guest.app')

@section('content')
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="row">
                <div class="col-md-4">
                    <!-- Logo Utama -->
                    <div class="text-center mb-4">
                        @if ($lembaga->logo)
                            <img src="{{ asset('storage/logos/' . $lembaga->logo) }}" alt="{{ $lembaga->nama_lembaga }}"
                                class="img-fluid rounded mb-3" style="max-height: 200px;">
                        @endif
                    </div>

                    <!-- Multiple Logos -->
                    @if ($lembaga->galeri && $lembaga->galeri->count() > 0)
                        <h5>Logo Lainnya</h5>
                        <div class="row">
                            @foreach ($lembaga->galeri as $media)
                                <div class="col-6 mb-2">
                                    <a href="{{ asset('storage/uploads/' . $media->file_name) }}" target="_blank">
                                        <img src="{{ asset('storage/uploads/' . $media->file_name) }}"
                                            alt="{{ $media->caption }}" class="img-thumbnail"
                                            style="width: 100px; height: 100px; object-fit: cover;">
                                    </a>
                                    @if ($media->caption)
                                        <p class="small text-muted">{{ $media->caption }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="col-md-8">
                    <h1>{{ $lembaga->nama_lembaga }}</h1>

                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Informasi Lembaga</h5>

                            <div class="mb-3">
                                <strong>Kontak:</strong>
                                <p>{{ $lembaga->kontak ?? '-' }}</p>
                            </div>

                            <div class="mb-3">
                                <strong>Deskripsi:</strong>
                                <p>{{ $lembaga->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                            </div>

                            <div class="mb-3">
                                <strong>Dibuat:</strong>
                                <p>{{ $lembaga->created_at->format('d M Y H:i') }}</p>
                            </div>

                            <div class="mb-3">
                                <strong>Diperbarui:</strong>
                                <p>{{ $lembaga->updated_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('lembaga.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('lembaga.edit', $lembaga->lembaga_id) }}" class="btn btn-warning">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
