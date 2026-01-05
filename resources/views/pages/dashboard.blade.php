@extends('layouts.guest.app')
@section('content')
    {{-- START MAIN CONTENT --}}

    <div class="container-fluid py-5">
        <div class="container px-lg-5">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="section-title position-relative mb-4 pb-2">
                        <h6 class="position-relative text-primary ps-4">Tentang Desa</h6>
                        <h2 class="mt-2">Selamat Datang di Portal Desa Mandiri</h2>
                    </div>
                    <p class="mb-4">Desa kami merupakan komunitas yang harmonis dengan berbagai potensi dan sumber
                        daya manusia yang berkualitas. Kami berkomitmen untuk memberikan pelayanan terbaik bagi
                        seluruh warga.</p>

                    <div class="row g-3 mt-4">
                        <div class="col-sm-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <div class="text-primary mb-2">
                                        <i class="fa fa-users fa-2x"></i>
                                    </div>
                                    <h3 class="text-dark">{{ $stats['total_perangkat'] ?? 0 }}</h3>
                                    <p class="mb-0 text-muted">Perangkat Desa</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <div class="text-primary mb-2">
                                        <i class="fa fa-building fa-2x"></i>
                                    </div>
                                    <h3 class="text-dark">{{ $stats['total_lembaga'] ?? 0 }}</h3>
                                    <p class="mb-0 text-muted">Lembaga Desa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img class="img-fluid wow zoomIn" data-wow-delay="0.5s" src="{{ asset('assets-guest/img/dash.png') }}" alt="Tentang Desa">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="container px-lg-5">
            <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="position-relative d-inline text-primary ps-4">Our Team</h6>
                <h2 class="mt-2">Tim Pengembang Website</h2>
            </div>

            <div class="row g-4 justify-content-center">

                {{-- ANGGOTA 1: Della --}}
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item bg-light rounded shadow-sm overflow-hidden">
                        <div class="d-flex">
                            <div class="flex-shrink-0 d-flex flex-column align-items-center mt-4 pt-5" style="width: 75px;">

                                {{-- GANTI LINK DI BAWAH INI UNTUK DELLA --}}

                                <a class="btn btn-square text-primary bg-white my-1"
                                   href="https://github.com/USERNAME_GITHUB_DELLA" target="_blank">
                                    <i class="fab fa-github"></i>
                                </a>

                                <a class="btn btn-square text-primary bg-white my-1"
                                   href="https://www.linkedin.com/in/USERNAME_LINKEDIN_DELLA/" target="_blank">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>

                                <a class="btn btn-square text-primary bg-white my-1"
                                   href="https://www.instagram.com/USERNAME_IG_DELLA/" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>

                            </div>

                            <div class="w-100" style="height: 300px;">
                                <img class="img-fluid w-100 h-100"
                                     src="{{ asset('assets-guest/img/dellA.jpg') }}"
                                     alt="Della Marcelina"
                                     style="object-fit: cover;">
                            </div>
                        </div>

                        <div class="px-4 py-3 text-center">
                            <h5 class="fw-bold m-0">Della Marcelina Br Sembiring</h5>
                            <small class="text-primary fw-bold">Admin</small>
                            <hr class="my-2">
                            <div class="text-start mt-2" style="font-size: 0.9rem;">
                                <p class="mb-1 text-muted">
                                    <i class="fa fa-id-card me-2 text-primary"></i>NIM: 2457301032
                                </p>
                                <p class="mb-0 text-muted">
                                    <i class="fa fa-graduation-cap me-2 text-primary"></i> Sistem Informasi
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ANGGOTA 2: Alyah --}}
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item bg-light rounded shadow-sm overflow-hidden">
                        <div class="d-flex">
                            <div class="flex-shrink-0 d-flex flex-column align-items-center mt-4 pt-5" style="width: 75px;">

                                {{-- GANTI LINK DI BAWAH INI UNTUK ALYAH --}}

                                <a class="btn btn-square text-primary bg-white my-1"
                                   href="https://github.com/USERNAME_GITHUB_ALYAH" target="_blank">
                                    <i class="fab fa-github"></i>
                                </a>

                                <a class="btn btn-square text-primary bg-white my-1"
                                   href="https://www.linkedin.com/in/USERNAME_LINKEDIN_ALYAH" target="_blank">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>

                                <a class="btn btn-square text-primary bg-white my-1"
                                   href="https://www.instagram.com/USERNAME_IG_ALYAH" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>

                            </div>

                            <div class="w-100" style="height: 300px;">
                                <img class="img-fluid w-100 h-100"
                                     src="{{ asset('assets-guest/img/ALYAH.jpeg') }}"
                                     alt="Alyah Najwa"
                                     style="object-fit: cover;">
                            </div>
                        </div>
                        <div class="px-4 py-3 text-center">
                            <h5 class="fw-bold m-0">Alyah Najwa Restu Islmai</h5>
                            <small class="text-primary fw-bold">Guest</small>
                            <hr class="my-2">
                            <div class="text-start mt-2" style="font-size: 0.9rem;">
                                <p class="mb-1 text-muted">
                                    <i class="fa fa-id-card me-2 text-primary"></i>NIM: 2457301012
                                </p>
                                <p class="mb-0 text-muted">
                                    <i class="fa fa-graduation-cap me-2 text-primary"></i> Sistem Informasi
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- END MAIN CONTENT --}}
@endsection
