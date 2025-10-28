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
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div>
                        <h2 class="mb-1" style="color: #2c3e50; font-weight: 800;">Perangkat Desa</h2>
                        <p class="text-muted mb-0">Struktur pemerintahan desa</p>
                    </div>
                    <a href="{{ route('perangkat.create') }}" class="btn btn-add">
                        <i class="fa fa-plus me-2"></i>Tambah Perangkat Baru
                    </a>
                </div>

                <div class="perangkat-grid">
                    @forelse ($dataPerangkat as $perangkat)
                        <div class="perangkat-card">
                            <div class="card-header">
                                <div class="header-content">
                                    @if ($perangkat->foto)
                                        <img src="{{ asset('storage/' . $perangkat->foto) }}" class="foto-perangkat"
                                            alt="{{ $perangkat->warga->nama }}">
                                    @else
                                        <div class="avatar">
                                            {{ strtoupper(substr($perangkat->warga->nama, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="nama">
                                            <i class="fa fa-user-tie me-2"></i>{{ $perangkat->warga->nama }}
                                        </div>
                                        <div class="jabatan">
                                            {{ $perangkat->jabatan }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="info-item">
                                    <span class="info-label">NIP</span>
                                    <span class="info-value">
                                        <i class="fa fa-id-card me-2"></i>
                                        {{ $perangkat->nip ?? '-' }}
                                    </span>
                                </div>

                                <div class="info-item">
                                    <span class="info-label">Kontak</span>
                                    <span class="info-value">
                                        <i class="fa fa-phone me-2"></i>
                                        {{ $perangkat->kontak ?? '-' }}
                                    </span>
                                </div>

                                <div class="info-item">
                                    <span class="info-label">Periode Mulai</span>
                                    <span class="info-value">
                                        <i class="fa fa-calendar me-2"></i>
                                        {{ \Carbon\Carbon::parse($perangkat->periode_mulai)->format('d M Y') }}
                                    </span>
                                </div>

                                <div class="info-item">
                                    <span class="info-label">Periode Selesai</span>
                                    <span class="info-value">
                                        <i class="fa fa-calendar me-2"></i>
                                        {{ $perangkat->periode_selesai ? \Carbon\Carbon::parse($perangkat->periode_selesai)->format('d M Y') : 'Sekarang' }}
                                    </span>
                                </div>

                                <div class="info-item">
                                    <span class="info-label">Status</span>
                                    <span class="info-value">
                                        <span
                                            class="status-badge {{ $perangkat->periode_selesai ? 'status-nonaktif' : 'status-aktif' }}">
                                            <i class="fa fa-circle me-1" style="font-size: 0.5rem;"></i>
                                            {{ $perangkat->periode_selesai ? 'Tidak Aktif' : 'Aktif' }}
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="d-flex justify-content-between gap-2">
                                    <button class="btn btn-action btn-detail flex-fill"
                                        onclick="showDetail({{ $perangkat->perangkat_id }})">
                                        <i class="fa fa-eye me-2"></i>Detail
                                    </button>
                                    <a href="{{ route('perangkat.edit', $perangkat->perangkat_id) }}"
                                        class="btn btn-action btn-edit flex-fill">
                                        <i class="fa fa-edit me-2"></i>Edit
                                    </a>
                                    <form action="{{ route('perangkat.destroy', $perangkat->perangkat_id) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-action flex-fill"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data perangkat ini?')">
                                            <i class="fa fa-trash me-2"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="empty-state">
                                <i class="fa fa-user-tie"></i>
                                <h3 class="mb-3" style="color: #495057;">Belum Ada Data Perangkat Desa</h3>
                                <p class="mb-4">Silakan tambah data perangkat desa terlebih dahulu</p>
                                <a href="{{ route('perangkat.create') }}" class="btn btn-add btn-lg">
                                    <i class="fa fa-plus me-2"></i>Tambah Perangkat Pertama
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if (isset($dataPerangkat) && method_exists($dataPerangkat, 'hasPages') && $dataPerangkat->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        <nav>
                            {{ $dataPerangkat->links() }}
                        </nav>
                    </div>
                @endif
            </div>
        </div>
        <!-- Content End -->

        <!-- Footer Start -->
        @include('layouts.guest.footer')
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="https://faq.whatsapp.com/5913398998672934/?locale=en_US" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i
            </i><img src="{{ asset(path: 'assets-guest/img/IconWa.png') }}" alt="{{ __('') }}"></a>

    </div>

    {{-- START JS --}}
    @include('layouts.guest.js')


</body>

</html>
