<!DOCTYPE html>
<html lang="en">

<head>
    {{-- START CSS --}}
    @include('layouts.guest.css')
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
        @include('layouts.guest.header')
        {{-- END HEADER --}}

        <!-- Content Start -->
       <!-- resources/views/pages/lembaga_desa/show.blade.php -->
<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="row">
            <div class="col-md-4">
                <!-- Logo Utama -->
                <div class="text-center mb-4">
                    @if($lembaga->logo_utama)
                        <img src="{{ $lembaga->logo_utama }}"
                             alt="{{ $lembaga->nama_lembaga }}"
                             class="img-fluid rounded mb-3"
                             style="max-height: 200px;">
                    @endif
                </div>

                <!-- Multiple Logos -->
                @if($lembaga->media->count() > 0)
                    <h5>Logo Lainnya</h5>
                    <div class="row">
                        @foreach($lembaga->media as $media)
                            <div class="col-6 mb-2">
                                <a href="{{ asset('storage/uploads/' . $media->file_name) }}" target="_blank">
                                    <img src="{{ asset('storage/uploads/' . $media->file_name) }}"
                                         alt="{{ $media->caption }}"
                                         class="img-thumbnail"
                                         style="width: 100px; height: 100px; object-fit: cover;">
                                </a>
                                @if($media->caption)
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

        <!-- Content End -->

        <!-- Footer Start -->
        @include('layouts.guest.footer')
        <!-- Footer End -->
    </div>

    {{-- START JS --}}
    @include('layouts.guest.js')
</body>

</html>
