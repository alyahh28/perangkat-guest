<!DOCTYPE html>
<html lang="en">

<head>
    {{-- START CSS --}}
    @include('layouts.css')
    {{-- END CSS --}}


</head>

{{-- start content --}}
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
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div>
                        <h2 class="mb-1" style="color: #2c3e50; font-weight: 800;">Daftar User</h2>
                        <p class="text-muted mb-0">Kelola semua pengguna sistem</p>
                    </div>
                    <a href="{{ route('user.create') }}" class="btn btn-add">
                        <i class="fa fa-plus me-2"></i>Tambah User Baru
                    </a>
                </div>

                <div class="user-grid">
                    @forelse ($dataUsers as $item)
                        <div class="user-card">
                            <div class="card-header">
                                <div class="email">
                                    <i class="fa fa-envelope me-2"></i>{{ $item->email }}
                                </div>
                                <div class="user-id">
                                    ID User {{ $item->id }}
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="info-item">
                                    <span class="info-label">Bergabung</span>
                                    <span class="info-value">
                                        <i class="fa fa-calendar me-2"></i>
                                        {{ $item->created_at->format('d M Y') }}
                                    </span>
                                </div>

                                <div class="info-item">
                                    <span class="info-label">Status</span>
                                    <span class="info-value">
                                        <span
                                            class="status-badge {{ $item->activiti == 'Aktif' ? 'status-aktif' : 'status-nonaktif' }}">
                                            <i class="fa fa-circle me-1" style="font-size: 0.5rem;"></i>
                                            {{ $item->activiti ?? 'Tidak Aktif' }}
                                        </span>
                                    </span>
                                </div>

                                <!-- Password Hash Section -->
                                <div class="info-item">
                                    <span class="info-label">Password )</span>
                                    <span class="info-value">
                                        <small class="text-muted" style="font-family: monospace; font-size: 0.75rem;">
                                           =$item->password), 0, 20) }}...
                                        </small>
                                    </span>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="d-flex justify-content-between gap-2">
                                    <button class="btn btn-action btn-detail flex-fill">
                                        <i class="fa fa-eye me-2"></i>Detail
                                    </button>
                                    <a href="{{ route('user.edit', $item->id) }}"
                                        class="btn btn-action btn-edit flex-fill">
                                        <i class="fa fa-edit me-2"></i>Edit
                                    </a>
                                    <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-action flex-fill"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                            <i class="fa fa-trash me-2"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="empty-state">
                                <i class="fa fa-users"></i>
                                <h3 class="mb-3" style="color: #495057;">Belum Ada User</h3>
                                <p class="mb-4">Mulai dengan menambahkan user pertama ke dalam sistem</p>
                                <a href="{{ route('user.create') }}" class="btn btn-add btn-lg">
                                    <i class="fa fa-plus me-2"></i>Tambah User Pertama
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if (isset($dataUsers) && method_exists($dataUsers, 'hasPages') && $dataUsers->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        <nav>
                            {{ $dataUsers->links() }}
                        </nav>
                    </div>
                @endif
            </div>
        </div>
        <!-- Content End -->

        <!-- Footer Start -->
        @include('layouts.footer')
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2">
            <i class="bi bi-arrow-up"></i>
        </a>
    </div>
{{-- end content --}}

    {{-- START JS --}}
    @include('layouts.js')
    {{-- END JS --}}


</body>

</html>
