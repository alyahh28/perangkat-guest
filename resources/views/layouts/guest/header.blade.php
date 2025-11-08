<!-- Navbar & Hero Start -->
<div class="container-xxl position-relative p-0">
    <nav class="navbar navbar-expand-sm navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="" class="navbar-brand p-0">
            <h1 class="m-0"><i class="fa fa-search me-2"></i>BINA <span class="fs-5"> DESA</span></h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <!-- Menu Navigasi Utama -->
            <div class="navbar-nav mx-auto py-0 align-items-center">
                <a href="{{ url('/dashboard') }}"
                    class="nav-item nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home me-1"></i>Home
                </a>

                <a href="{{ url('/tentang') }}"
                    class="nav-item nav-link {{ request()->is('tentang') ? 'active' : '' }}">
                    <i class="fas fa-info-circle me-1"></i>Tentang
                </a>


                <a href="{{ route('perangkat.index') }}"
                    class="nav-item nav-link {{ request()->is('perangkat.*') ? 'active' : '' }}">
                    <i class="fas fa-users me-2"></i>Perangkat
                </a>

                {{--  <a href="{{ route('perangkat.index') }}"
                    class="dropdown-item {{ request()->is('perangkat.*') ? 'active' : '' }}">
                    <i class="fas fa-user-tie me-2"></i>Data Perangkat
                </a>  --}}

                <!-- Dropdown Menu Layanan -->
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="layananDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-concierge-bell me-1"></i>Layanan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="layananDropdown">
                        <li>
                            <a href="{{ route('warga.index') }}"
                                class="dropdown-item {{ request()->is('warga.*') ? 'active' : '' }}">
                                <i class="fas fa-users me-2"></i>Data Warga
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('users.index') }}"
                                class="dropdown-item {{ request()->is('user.*') ? 'active' : '' }}">
                                <i class="fas fa-user-cog me-2"></i>Data User
                            </a>
                        </li>
                    </ul>
                </div>

                <a href="#" class="nav-item nav-link {{ request()->is('kontak') ? 'active' : '' }}">
                    <i class="fas fa-address-book me-1"></i>Kontak
                </a>
            </div>

            <!-- Ikon User, Notifikasi, dan Logout di Kanan -->
            <div class="navbar-nav ms-auto py-0 align-items-center" style="margin-right: 100px">
                <div class="user-actions d-flex align-items-center gap-3">
                    <!-- Ikon Notifikasi -->
                    <div class="nav-item dropdown">
                        <div class="user-icon position-relative" id="notificationDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </div>
                        <ul class="dropdown-menu user-dropdown dropdown-menu-end"
                            aria-labelledby="notificationDropdown">
                            <li>
                                <h6 class="dropdown-header">Notifikasi Terbaru</h6>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user-plus me-2 text-success"></i>
                                    <small>Pembaruan data warga baru</small>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-key me-2 text-warning"></i>
                                    <small>Permintaan akses dari user</small>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-chart-bar me-2 text-info"></i>
                                    <small>Laporan bulanan telah tersedia</small>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item text-center" href="#">
                                    <i class="fas fa-list me-1"></i>Lihat Semua
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Ikon Profil dengan Dropdown -->
                    <div class="nav-item dropdown">
                        <div class="user-icon dropdown-toggle align-items-center" id="profileDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-2"></i>
                            <span class="user-name">Guest</span>
                        </div>
                        <ul class="dropdown-menu user-dropdown dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user-circle me-2"></i>Profil Saya
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cog me-2"></i>Pengaturan
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt me-2"></i>Keluar
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-5 bg-primary hero-header mb-5">
        <div class="container my-5 py-5 px-lg-5">
            <div class="row g-5 py-5">
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="text-white mb-4 animated zoomIn">@yield('hero-title', 'PERANGKAT & LEMBAGA')</h1>
                    <p class="text-white pb-3 animated zoomIn">@yield('hero-description', 'Portal Desa Mandiri - Melayani dengan Sepenuh Hati')</p>
                    @hasSection('hero-buttons')
                        @yield('hero-buttons')
                    @endif
                </div>
                @hasSection('hero-image')
                    <div class="col-lg-6 text-center text-lg-start">
                        @yield('hero-image')
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- BUTTON WA --}}
    <a href="https://wa.me/6281234567890?text=Halo%20Admin%2C%20saya%20ingin%20bertanya." class="whatsapp-float"
        target="_blank" rel="noopener noreferrer">
        <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp" />
    </a>
</div>
<!-- Navbar & Hero End -->
