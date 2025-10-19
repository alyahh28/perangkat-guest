<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tambah Perangkat Desa - SEO Master</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets-guest/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets-guest/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-guest/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-guest/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets-guest/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets-guest/css/style.css') }}" rel="stylesheet">
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

        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="m-0"><i class="fa fa-search me-2"></i>Bina <span class="fs-5"> Desa</span></h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="{{ url('/dashboard') }}" class="nav-item nav-link">Home</a>
                        <a href="{{ route('warga.index') }}" class="nav-item nav-link">Data Warga</a>
                        <a href="{{ route('perangkat.index') }}" class="nav-item nav-link active">Perangkat Desa</a>
                        <a href="{{ url('/lembaga') }}" class="nav-item nav-link">Lembaga Desa</a>
                        <a href="{{ url('/jabatan') }}" class="nav-item nav-link">Jabatan Lembaga</a>
                        <a href="{{ url('/anggota') }}" class="nav-item nav-link">Anggota Lembaga</a>
                        {{-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="{{ url('/team') }}" class="dropdown-item">Our Team</a>
                                <a href="{{ url('/testimonial') }}" class="dropdown-item">Testimonial</a>
                            </div>
                        </div>
                        <a href="{{ url('/contact') }}" class="nav-item nav-link">Contact</a>
                    </div>
                </div> --}}
            </nav>

            <div class="container-xxl py-5 bg-primary hero-header mb-5">
                <div class="container my-5 py-5 px-lg-5">
                    <div class="row g-5 py-5">
                        <div class="col-lg-12 text-center text-lg-start">
                            <h1 class="text-white mb-4 animated zoomIn">Tambah Perangkat Desa</h1>
                            <p class="text-white pb-3 animated zoomIn">Form untuk menambahkan data perangkat desa baru
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Content Start -->
        <div class="container-xxl py-5">
            <div class="container px-lg-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">Form Tambah Perangkat Desa</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('perangkat.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="warga_id" class="form-label">Nama Warga *</label>
                                            <select class="form-select @error('warga_id') is-invalid @enderror"
                                                id="warga_id" name="warga_id" required>
                                                <option value="">Pilih Warga</option>
                                                @foreach ($dataWarga as $warga)
                                                    <option value="{{ $warga->warga_id }}"
                                                        {{ old('warga_id') == $warga->warga_id ? 'selected' : '' }}>
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
                                                id="jabatan" name="jabatan" value="{{ old('jabatan') }}" required>
                                            @error('jabatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="nip" class="form-label">NIP</label>
                                            <input type="text"
                                                class="form-control @error('nip') is-invalid @enderror" id="nip"
                                                name="nip" value="{{ old('nip') }}">
                                            @error('nip')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="kontak" class="form-label">Kontak *</label>
                                            <input type="text"
                                                class="form-control @error('kontak') is-invalid @enderror"
                                                id="kontak" name="kontak" value="{{ old('kontak') }}" required>
                                            @error('kontak')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="periode_mulai" class="form-label">Periode Mulai *</label>
                                            <input type="date"
                                                class="form-control @error('periode_mulai') is-invalid @enderror"
                                                id="periode_mulai" name="periode_mulai"
                                                value="{{ old('periode_mulai') }}" required>
                                            @error('periode_mulai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="periode_selesai" class="form-label">Periode Selesai</label>
                                            <input type="date"
                                                class="form-control @error('periode_selesai') is-invalid @enderror"
                                                id="periode_selesai" name="periode_selesai"
                                                value="{{ old('periode_selesai') }}">
                                            @error('periode_selesai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label for="foto" class="form-label">Foto</label>
                                            <input type="file"
                                                class="form-control @error('foto') is-invalid @enderror"
                                                id="foto" name="foto" accept="image/*">
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
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save me-2"></i>Simpan
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
        <div class="container-fluid bg-primary text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Get In Touch</h5>
                        <p><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p><i class="fa fa-envelope me-3"></i>info@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Popular Link</h5>
                        <a class="btn btn-link" href="">About Us</a>
                        <a class="btn btn-link" href="">Contact Us</a>
                        <a class="btn btn-link" href="">Privacy Policy</a>
                        <a class="btn btn-link" href="">Terms & Condition</a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Project Gallery</h5>
                        <div class="row g-2">
                            <div class="col-4">
                                <img class="img-fluid" src="{{ asset('assets-guest/img/portfolio-1.jpg') }}"
                                    alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="{{ asset('assets-guest/img/portfolio-2.jpg') }}"
                                    alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="{{ asset('assets-guest/img/portfolio-3.jpg') }}"
                                    alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container px-lg-5">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i
                class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets-guest/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets-guest/lib/easing/easing.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets-guest/js/main.js') }}"></script>
</body>

</html>
