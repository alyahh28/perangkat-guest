<div class="container-fluid bg-primary text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5 px-lg-5">
        <div class="row g-5">

            {{-- KOLOM 1: KONTAK & ALAMAT --}}
            <div class="col-md-6 col-lg-3">
                <h5 class="text-white mb-4">Kantor Desa</h5>
                <p><i class="fa fa-map-marker-alt me-3"></i>Jl. Raya Desa No. 1, Kecamatan Maju, Kabupaten Sejahtera</p>
                <p><i class="fa fa-phone-alt me-3"></i>(021) 123-4567</p>
                <p><i class="fa fa-envelope me-3"></i>admin@desa.go.id</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            {{-- KOLOM 2: NAVIGASI CEPAT --}}
            <div class="col-md-6 col-lg-3">
                <h5 class="text-white mb-4">Akses Cepat</h5>
                <a class="btn btn-link d-flex align-items-center mb-2" href="{{ url('/') }}">
                    <i class="fa fa-angle-right me-2"></i>Beranda
                </a>
                <a class="btn btn-link d-flex align-items-center mb-2" href="{{ route('perangkat.index') }}">
                    <i class="fa fa-angle-right me-2"></i>Perangkat Desa
                </a>
                <a class="btn btn-link d-flex align-items-center mb-2" href="#">
                    <i class="fa fa-angle-right me-2"></i>Profil Wilayah
                </a>
                <a class="btn btn-link d-flex align-items-center mb-2" href="#">
                    <i class="fa fa-angle-right me-2"></i>Berita Terkini
                </a>
            </div>

            {{-- KOLOM 3: LAYANAN WARGA --}}
            <div class="col-md-6 col-lg-3">
                <h5 class="text-white mb-4">Layanan Warga</h5>
                <a class="btn btn-link d-flex align-items-center mb-2" href="#">
                    <i class="fa fa-file-alt me-2"></i>Administrasi Surat
                </a>
                <a class="btn btn-link d-flex align-items-center mb-2" href="#">
                    <i class="fa fa-bullhorn me-2"></i>Pengaduan Masyarakat
                </a>
                <a class="btn btn-link d-flex align-items-center mb-2" href="#">
                    <i class="fa fa-info-circle me-2"></i>Transparansi Anggaran
                </a>
                <a class="btn btn-link d-flex align-items-center mb-2" href="#">
                    <i class="fa fa-users me-2"></i>Data Kependudukan
                </a>
            </div>

            {{-- KOLOM 4: JAM OPERASIONAL (Pengganti Newsletter) --}}
            <div class="col-md-6 col-lg-3">
                <h5 class="text-white mb-4">Jam Pelayanan</h5>
                <div class="d-flex flex-column">
                    <span class="text-white-50 mb-1">Senin - Kamis</span>
                    <h6 class="text-white mb-3">08:00 - 16:00 WIB</h6>

                    <span class="text-white-50 mb-1">Jumat</span>
                    <h6 class="text-white mb-3">08:00 - 15:00 WIB</h6>

                    <span class="text-white-50 mb-1">Sabtu - Minggu</span>
                    <h6 class="text-white">Libur</h6>
                </div>
            </div>
        </div>
    </div>

    {{-- COPYRIGHT SECTION --}}
    <div class="container px-lg-5">
        <div class="copyright border-top border-white-50 pt-4 pb-4">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    {{-- TAHUN DINAMIS & NAMA SISTEM BARU --}}
                    &copy; {{ date('Y') }} <a class="border-bottom text-white fw-bold" href="#">Sistem Informasi Desa (SID)</a>.
                    All Right Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="#" class="text-white-50">Kebijakan Privasi</a>
                        <a href="#" class="text-white-50">Syarat & Ketentuan</a>
                        <a href="#" class="text-white-50">Bantuan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
