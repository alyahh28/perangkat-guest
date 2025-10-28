<!-- Navbar & Hero Start -->
    <div class="container-xxl position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="m-0"><i class="fa fa-search me-2"></i>BINA <span class="fs-5"> DESA</span></h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0 align-items-center">
                    <a href="{{ url('/dashboard') }}"
                        class="nav-item nav-link {{ request()->is('dashboard') ? 'active' : '' }}">Home</a>
                    <a href="{{ url('/tentang') }}"
                        class="nav-item nav-link {{ request()->is('tentang') ? 'active' : '' }}">Tentang</a>

                    <!-- Dropdown Menu Layanan -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="layananDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Layanan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="layananDropdown">
                            <li>
                                <a href="{{ route('warga.index') }}"
                                    class="dropdown-item {{ request()->is('warga.*') ? 'active' : '' }}">Data Warga</a>
                            </li>
                            <li>
                                <a href="{{ route('perangkat.index') }}"
                                    class="dropdown-item {{ request()->is('perangkat.*') ? 'active' : '' }}">Data Perangkat</a>
                            </li>
                            <li>
                                <a href="{{ route('users.index') }}"
                                    class="dropdown-item {{ request()->is('user.*') ? 'active' : '' }}">Data User</a>
                            </li>
                        </ul>
                    </div>

                    <a href="#"
                        class="nav-item nav-link {{ request()->is('kontak') ? 'active' : '' }}">Kontak</a>

                    <!-- Ikon User, Notifikasi, dan Logout -->
                    <div class="user-actions">
                        <!-- Ikon Profil dengan Dropdown -->
                        <div class="nav-item dropdown">
                            <div class="user-icon dropdown-toggle" id="profileDropdown" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </div>
                            <ul class="dropdown-menu user-dropdown" aria-labelledby="profileDropdown">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle me-2"></i>Profil Saya</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Pengaturan</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Keluar</a></li>
                            </ul>
                        </div>

                        <!-- Ikon Notifikasi -->
                        <div class="nav-item dropdown">
                            <div class="user-icon position-relative" id="notificationDropdown" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bell"></i>
                                <span class="notification-badge">3</span>
                            </div>
                            <ul class="dropdown-menu user-dropdown" aria-labelledby="notificationDropdown">
                                <li><h6 class="dropdown-header">Notifikasi Terbaru</h6></li>
                                <li><a class="dropdown-item" href="#"><small>Pembaruan data warga baru</small></a></li>
                                <li><a class="dropdown-item" href="#"><small>Permintaan akses dari user</small></a></li>
                                <li><a class="dropdown-item" href="#"><small>Laporan bulanan telah tersedia</small></a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-center" href="#">Lihat Semua</a></li>
                            </ul>
                        </div>

                        <!-- Ikon Logout -->
                        <div class="user-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Keluar">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-xxl py-5 bg-primary hero-header mb-5">
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
    </div>
    <!-- Navbar & Hero End -->
