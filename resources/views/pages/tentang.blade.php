@extends('layouts.guest.app')
@section('content')
    {{-- START MAIN CONTENT --}}


    <!-- About Structure Start -->
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="section-title position-relative mb-4 pb-2">
                        <h6 class="position-relative text-primary ps-4">Struktur Organisasi</h6>
                        <h2 class="mt-2">Tata Kelola Pemerintahan Desa</h2>
                    </div>
                    <p class="mb-4">Struktur organisasi desa kami dirancang untuk memberikan pelayanan yang optimal kepada
                        masyarakat dengan sistem yang transparan dan akuntabel.</p>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-lg-square bg-primary rounded-circle">
                                    <i class="fa fa-sitemap text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1">Struktur Hierarki</h6>
                                    <small>Jelas dan Terstruktur</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-lg-square bg-primary rounded-circle">
                                    <i class="fa fa-users text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1">Teamwork Solid</h6>
                                    <small>Sinergi Antar Lembaga</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-lg-square bg-primary rounded-circle">
                                    <i class="fa fa-chart-line text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1">Pengembangan Berkelanjutan</h6>
                                    <small>Terus Berkembang</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-lg-square bg-primary rounded-circle">
                                    <i class="fa fa-handshake text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1">Pelayanan Masyarakat</h6>
                                    <small>Fokus pada Warga</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <img class="img-fluid rounded" src="{{ asset('assets-guest/img/about.jpg') }}"
                        alt="Struktur Organisasi Desa">
                </div>
            </div>
        </div>
    </div>
    <!-- About Structure End -->

    <!-- Lembaga Desa Start -->
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="position-relative d-inline text-primary ps-4">Lembaga Desa</h6>
                <h2 class="mt-2">Lembaga-Lembaga Desa</h2>
                <p class="mb-0">Berbagai lembaga yang berperan aktif dalam pembangunan dan pemberdayaan masyarakat desa
                </p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                    <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                        <div class="service-icon flex-shrink-0">
                            <i class="fa fa-landmark fa-2x"></i>
                        </div>
                        <h5 class="mb-3">Badan Permusyawaratan Desa (BPD)</h5>
                        <p>Lembaga yang melaksanakan fungsi pemerintahan dalam bidang legislasi, pengawasan, dan penampungan
                            aspirasi masyarakat.</p>
                        <a class="btn px-3 mt-auto mx-auto" href="">Lihat Detail</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                        <div class="service-icon flex-shrink-0">
                            <i class="fa fa-female fa-2x"></i>
                        </div>
                        <h5 class="mb-3">Pemberdayaan Kesejahteraan Keluarga (PKK)</h5>
                        <p>Lembaga kemasyarakatan yang memberdayakan wanita untuk turut berpartisipasi dalam pembangunan
                            desa.</p>
                        <a class="btn px-3 mt-auto mx-auto" href="">Lihat Detail</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                        <div class="service-icon flex-shrink-0">
                            <i class="fa fa-users fa-2x"></i>
                        </div>
                        <h5 class="mb-3">Karang Taruna</h5>
                        <p>Organisasi kepemudaan yang menjadi wadah pengembangan generasi muda desa dalam berbagai kegiatan
                            positif.</p>
                        <a class="btn px-3 mt-auto mx-auto" href="">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Lembaga Desa End -->

    <!-- Alur Kerja Start -->
    <div class="container-xxl bg-primary py-5">
        <div class="container px-lg-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <img class="img-fluid rounded" src="{{ asset('assets-guest/img/about.jpg') }}"
                        alt="Alur Kerja Organisasi Desa">
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="section-title position-relative mb-4">
                        <h6 class="position-relative text-white ps-4">Alur Kerja</h6>
                        <h2 class="text-white mt-2">Proses dan Mekanisme Kerja</h2>
                    </div>
                    <p class="text-white mb-4">Sistem kerja yang terintegrasi antara perangkat desa dan lembaga-lembaga desa
                        untuk memastikan pelayanan yang efektif dan efisien.</p>

                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-white"></div>
                            <div class="timeline-content">
                                <h5 class="text-white">Perencanaan</h5>
                                <p class="text-white mb-0">Penyusunan program kerja berdasarkan musyawarah desa dan
                                    aspirasi masyarakat.</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-white"></div>
                            <div class="timeline-content">
                                <h5 class="text-white">Koordinasi</h5>
                                <p class="text-white mb-0">Sinergi antar lembaga desa untuk pelaksanaan program yang
                                    terintegrasi.</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-white"></div>
                            <div class="timeline-content">
                                <h5 class="text-white">Pelaksanaan</h5>
                                <p class="text-white mb-0">Implementasi program dengan melibatkan partisipasi aktif
                                    masyarakat.</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-white"></div>
                            <div class="timeline-content">
                                <h5 class="text-white">Evaluasi</h5>
                                <p class="text-white mb-0">Monitoring dan evaluasi berkala untuk perbaikan berkelanjutan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Alur Kerja End -->

    <!-- Data RT/RW Start -->
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="position-relative d-inline text-primary ps-4">Pusat Data</h6>
                <h2 class="mt-2">Data RT/RW Desa</h2>
                <p class="mb-0">Sistem terpusat untuk pengelolaan data wilayah RT/RW dalam desa kami</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="text-primary mb-3">
                                <i class="fa fa-map-marked-alt fa-3x"></i>
                            </div>
                            <h3 class="text-dark">{{ $stats['total_rt'] ?? 12 }}</h3>
                            <p class="mb-0 text-muted">Rukun Tetangga (RT)</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="text-primary mb-3">
                                <i class="fa fa-map fa-3x"></i>
                            </div>
                            <h3 class="text-dark">{{ $stats['total_rw'] ?? 4 }}</h3>
                            <p class="mb-0 text-muted">Rukun Warga (RW)</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="text-primary mb-3">
                                <i class="fa fa-house-user fa-3x"></i>
                            </div>
                            <h3 class="text-dark">{{ $stats['total_kk'] ?? 1250 }}</h3>
                            <p class="mb-0 text-muted">Kepala Keluarga</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="text-primary mb-3">
                                <i class="fa fa-user-friends fa-3x"></i>
                            </div>
                            <h3 class="text-dark">{{ $stats['total_warga'] ?? 4500 }}</h3>
                            <p class="mb-0 text-muted">Total Warga</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h4 class="mb-4">Fungsi Pusat Data RT/RW</h4>
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0 btn-square bg-primary rounded-circle"
                            style="width: 60px; height: 60px;">
                            <i class="fa fa-database text-white"></i>
                        </div>
                        <div class="ms-4">
                            <h5>Pendataan Warga</h5>
                            <p class="mb-0">Sistem terpadu untuk pencatatan data kependudukan yang akurat dan terupdate.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0 btn-square bg-primary rounded-circle"
                            style="width: 60px; height: 60px;">
                            <i class="fa fa-chart-pie text-white"></i>
                        </div>
                        <div class="ms-4">
                            <h5>Analisis Demografi</h5>
                            <p class="mb-0">Pemetaan karakteristik penduduk untuk perencanaan program yang tepat sasaran.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="flex-shrink-0 btn-square bg-primary rounded-circle"
                            style="width: 60px; height: 60px;">
                            <i class="fa fa-file-invoice text-white"></i>
                        </div>
                        <div class="ms-4">
                            <h5>Pelayanan Administrasi</h5>
                            <p class="mb-0">Memudahkan proses administrasi kependudukan bagi warga desa.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <img class="img-fluid rounded" src="{{ asset('assets-guest/img/about.jpg') }}"
                        alt="Manajemen Data RT/RW">
                </div>
            </div>
        </div>
    </div>
    <!-- Data RT/RW End -->

    <!-- Dokumen SK Start -->
    <div class="container-xxl bg-light py-5">
        <div class="container px-lg-5">
            <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="position-relative d-inline text-primary ps-4">Dokumen Resmi</h6>
                <h2 class="mt-2">Surat Keputusan (SK)</h2>
                <p class="mb-0">Dokumen legalitas penunjukkan perangkat desa dan pengurus lembaga</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="text-primary mb-3">
                                <i class="fa fa-file-signature fa-3x"></i>
                            </div>
                            <h5 class="mb-3">SK Perangkat Desa</h5>
                            <p class="mb-3">Surat Keputusan resmi penunjukkan perangkat desa beserta tugas dan fungsinya.
                            </p>
                            <a href="#" class="btn btn-primary">Lihat Dokumen</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="text-primary mb-3">
                                <i class="fa fa-file-contract fa-3x"></i>
                            </div>
                            <h5 class="mb-3">SK Lembaga Desa</h5>
                            <p class="mb-3">Dokumen pengangkatan pengurus lembaga desa (BPD, PKK, Karang Taruna).</p>
                            <a href="#" class="btn btn-primary">Lihat Dokumen</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="text-primary mb-3">
                                <i class="fa fa-user-check fa-3x"></i>
                            </div>
                            <h5 class="mb-3">SK RT/RW</h5>
                            <p class="mb-3">Penetapan pengurus Rukun Tetangga dan Rukun Warga di wilayah desa.</p>
                            <a href="#" class="btn btn-primary">Lihat Dokumen</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dokumen SK End -->

    {{-- END MAIN CONTENT --}}
@endsection

<style>
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
        left: -40px;
        top: 5px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
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
</style>
