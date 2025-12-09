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
                        <form action="{{ route('lembaga.update', $lembaga->lembaga_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- edit.blade.php - tambahkan di bagian form logo -->
                            <!-- Logo Upload -->
                            <div class="mb-4">
                                <label for="logo" class="form-label fw-semibold">Logo Lembaga</label>

                                <!-- Logo Single (backward compatibility) -->
                                @if ($lembaga->logo)
                                    <div class="mb-3">
                                        <p class="text-muted mb-1">Logo single (old):</p>
                                        <img src="{{ asset('storage/logos/' . $lembaga->logo) }}"
                                            alt="Logo {{ $lembaga->nama_lembaga }}"
                                            style="max-width: 150px; height: auto;" class="img-thumbnail">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" name="remove_logo"
                                                id="remove_logo">
                                            <label class="form-check-label text-danger" for="remove_logo">
                                                Hapus logo single
                                            </label>
                                        </div>
                                    </div>
                                @endif

                                <!-- Logo Multiple dari Media Table -->
                                @if ($lembaga->media->count() > 0)
                                    <div class="mb-3">
                                        <p class="text-muted">Logo multiple dari media:</p>
                                        <div class="row">
                                            @foreach ($lembaga->media as $media)
                                                <div class="col-md-3 mb-2">
                                                    <div class="position-relative">
                                                        <img src="{{ asset('storage/uploads/' . $media->file_name) }}"
                                                            alt="Logo" class="img-thumbnail"
                                                            style="width: 100px; height: 100px; object-fit: cover;">
                                                        <div class="form-check position-absolute"
                                                            style="top: 5px; left: 5px;">
                                                            <input type="checkbox" name="remove_media[]"
                                                                value="{{ $media->media_id }}" class="form-check-input">
                                                        </div>
                                                        <input type="text" name="captions[{{ $media->media_id }}]"
                                                            value="{{ $media->caption }}" placeholder="Caption"
                                                            class="form-control form-control-sm mt-1">
                                                        <input type="number" name="sort_orders[{{ $media->media_id }}]"
                                                            value="{{ $media->sort_order }}" placeholder="Urutan"
                                                            class="form-control form-control-sm mt-1">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                

                                <!-- Upload Logo Baru (Multiple) -->
                                <div class="mb-3">
                                    <p class="text-muted">Upload logo baru (multiple):</p>
                                    <div id="new-logos-container">
                                        <div class="logo-upload-item mb-2">
                                            <input type="file" name="logos[]" class="form-control" accept="image/*">
                                            <div class="row mt-1">
                                                <div class="col-md-6">
                                                    <input type="text" name="captions_new[]"
                                                        class="form-control form-control-sm" placeholder="Caption">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="number" name="sort_orders_new[]"
                                                        class="form-control form-control-sm" placeholder="Urutan">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-logo">
                                        <i class="fa fa-plus"></i> Tambah Logo Lain
                                    </button>
                                </div>
                            </div>

                            <script>
                                document.getElementById('add-logo').addEventListener('click', function() {
                                    const container = document.getElementById('new-logos-container');
                                    const newItem = document.createElement('div');
                                    newItem.className = 'logo-upload-item mb-2';
                                    newItem.innerHTML = `
            <input type="file" name="logos[]" class="form-control" accept="image/*">
            <div class="row mt-1">
                <div class="col-md-6">
                    <input type="text" name="captions_new[]" class="form-control form-control-sm" placeholder="Caption">
                </div>
                <div class="col-md-6">
                    <input type="number" name="sort_orders_new[]" class="form-control form-control-sm" placeholder="Urutan">
                </div>
            </div>
        `;
                                    container.appendChild(newItem);
                                });
                            </script>
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
