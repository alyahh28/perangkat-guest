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
        <div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="row">
            <div class="col-md-4">
                <!-- Foto Utama -->
                @if($perangkat->foto_utama)
                    <img src="{{ $perangkat->foto_utama }}"
                         alt="{{ $perangkat->warga->nama }}"
                         class="img-fluid rounded mb-3">
                @endif

                <!-- Multiple Photos -->
                @if($perangkat->media->count() > 0)
                    <h5>Foto Lainnya</h5>
                    <div class="row">
                        @foreach($perangkat->media as $media)
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
                <h2>{{ $perangkat->warga->nama }}</h2>
                <h4 class="text-primary">{{ $perangkat->jabatan }}</h4>

                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>NIP:</strong> {{ $perangkat->nip ?? '-' }}</p>
                                <p><strong>Kontak:</strong> {{ $perangkat->kontak }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Periode Mulai:</strong> {{ $perangkat->periode_mulai->format('d M Y') }}</p>
                                <p><strong>Periode Selesai:</strong> {{ $perangkat->periode_selesai ? $perangkat->periode_selesai->format('d M Y') : 'Sekarang' }}</p>
                                <p>
                                    <strong>Status:</strong>
                                    <span class="badge bg-{{ $perangkat->periode_selesai && $perangkat->periode_selesai->isPast() ? 'danger' : 'success' }}">
                                        {{ $perangkat->periode_selesai && $perangkat->periode_selesai->isPast() ? 'Tidak Aktif' : 'Aktif' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="{{ route('perangkat.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Kembali
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
