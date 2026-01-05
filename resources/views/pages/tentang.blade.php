@extends('layouts.guest.app')

@section('content')
    {{-- START MAIN CONTENT --}}

    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="row g-5 align-items-center">
                {{-- Kolom Kiri: Deskripsi Modul & Tujuan --}}
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="section-title position-relative mb-4 pb-2">
                        <h6 class="position-relative text-primary ps-4">Tentang Aplikasi</h6>
                        <h2 class="mt-2">Sistem Informasi Desa (SID)</h2>
                    </div>
                    <p class="mb-4">
                        Sistem Informasi Desa (SID) adalah platform digital yang dirancang untuk memodernisasi tata kelola pemerintahan desa.
                        Modul ini bertujuan untuk menciptakan transparansi data, mempercepat pelayanan administrasi, dan memudahkan interaksi antara pemerintah desa dengan masyarakat.
                    </p>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-lg-square bg-primary rounded-circle">
                                    <i class="fa fa-laptop-code text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1">Digitalisasi Data</h6>
                                    <small>Database Terpusat</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-lg-square bg-primary rounded-circle">
                                    <i class="fa fa-check-circle text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1">Validasi Akurat</h6>
                                    <small>Data Real-time</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex mt-4">
                        <a href="" class="btn btn-primary rounded-pill px-4 me-3">Pelajari Lebih Lanjut</a>
                        <a href="" class="btn btn-outline-primary rounded-pill px-4">Kontak Kami</a>
                    </div>
                </div>

                {{-- Kolom Kanan: Gambar Dashboard (Tampilan Asli Tanpa Overlay Biru) --}}
                <div class="col-lg-6 wow zoomIn" data-wow-delay="0.5s">
                    <div class="position-relative overflow-hidden rounded shadow-lg border border-5 border-light">
                        <img class="img-fluid w-100"
                             src="{{ asset('assets-guest/img/dash.png') }}"
                             alt="Dashboard Sistem Informasi Desa"
                             style="object-fit: cover; min-height: 300px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl bg-primary py-5 my-5">
        <div class="container px-lg-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="p-5 rounded shadow" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);">
                         <h3 class="text-white mb-4">Integrasi Pelayanan</h3>
                         <p class="text-white mb-4">Sistem ini menghubungkan berbagai elemen pemerintahan desa mulai dari RT/RW, Lembaga Desa, hingga Admin Pusat untuk menciptakan ekosistem pelayanan yang efisien.</p>
                         <ul class="list-unstyled text-white">
                             <li class="mb-3"><i class="fa fa-check me-2"></i>Pengajuan Surat Online</li>
                             <li class="mb-3"><i class="fa fa-check me-2"></i>Update Data Mandiri</li>
                             <li class="mb-3"><i class="fa fa-check me-2"></i>Pelaporan Masalah Warga</li>
                         </ul>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="section-title position-relative mb-4">
                        <h6 class="position-relative text-white ps-4">Alur Sistem</h6>
                        <h2 class="text-white mt-2">Mekanisme Pengolahan Data</h2>
                    </div>

                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-white"></div>
                            <div class="timeline-content">
                                <h5 class="text-white">1. Input Data (RT/RW)</h5>
                                <p class="text-white-50 mb-0">Pengumpulan data dasar dari tingkat Rukun Tetangga dan Rukun Warga secara berkala.</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-white"></div>
                            <div class="timeline-content">
                                <h5 class="text-white">2. Verifikasi (Operator Desa)</h5>
                                <p class="text-white-50 mb-0">Pemeriksaan kelengkapan dan validitas data oleh perangkat desa yang berwenang.</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-white"></div>
                            <div class="timeline-content">
                                <h5 class="text-white">3. Sentralisasi Database</h5>
                                <p class="text-white-50 mb-0">Data tersimpan aman di server desa dan siap digunakan untuk kebutuhan administrasi.</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-white"></div>
                            <div class="timeline-content">
                                <h5 class="text-white">4. Output Layanan</h5>
                                <p class="text-white-50 mb-0">Penerbitan surat, laporan demografi, dan pengambilan keputusan berbasis data.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="position-relative d-inline text-primary ps-4">Statistik</h6>
                <h2 class="mt-2">Cakupan Wilayah & Penduduk</h2>
                <p class="mb-0">Data real-time yang dikelola dalam Sistem Informasi Desa</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card border-0 shadow-sm h-100 hover-top">
                        <div class="card-body text-center p-4">
                            <div class="text-primary mb-3">
                                <i class="fa fa-map-marked-alt fa-3x"></i>
                            </div>
                            <h3 class="text-dark counter">{{ $stats['total_rt'] ?? 0 }}</h3>
                            <p class="mb-0 text-muted">Rukun Tetangga (RT)</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card border-0 shadow-sm h-100 hover-top">
                        <div class="card-body text-center p-4">
                            <div class="text-primary mb-3">
                                <i class="fa fa-map fa-3x"></i>
                            </div>
                            <h3 class="text-dark counter">{{ $stats['total_rw'] ?? 0 }}</h3>
                            <p class="mb-0 text-muted">Rukun Warga (RW)</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="card border-0 shadow-sm h-100 hover-top">
                        <div class="card-body text-center p-4">
                            <div class="text-primary mb-3">
                                <i class="fa fa-users fa-3x"></i>
                            </div>
                            <h3 class="text-dark counter">{{ $stats['total_warga'] ?? 0 }}</h3>
                            <p class="mb-0 text-muted">Total Penduduk</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END MAIN CONTENT --}}
@endsection

{{-- CSS KHUSUS HALAMAN INI --}}
<style>
    /* Timeline CSS */
    .timeline {
        position: relative;
        padding-left: 30px;
    }
    .timeline-item {
        position: relative;
        margin-bottom: 30px;
    }
    .timeline-marker {
        position: absolute;
        left: -39px;
        top: 5px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 3px solid rgba(255,255,255,0.2);
        z-index: 2;
    }
    .timeline-content {
        position: relative;
    }
    .timeline:before {
        content: '';
        position: absolute;
        left: -30px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: rgba(255, 255, 255, 0.3);
    }

    /* Hover Effect for Stats Cards */
    .hover-top {
        transition: transform 0.3s ease;
    }
    .hover-top:hover {
        transform: translateY(-5px);
    }
</style>
