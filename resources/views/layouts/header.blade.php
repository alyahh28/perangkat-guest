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
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ url('/dashboard') }}"
                    class="nav-item nav-link {{ request()->is('dashboard') ? 'active' : '' }}">Home</a>
                <a href="{{ route('warga.index') }}"
                    class="nav-item nav-link {{ request()->is('warga*') ? 'active' : '' }}">Data Warga</a>
                <a href="{{ route('perangkat.index') }}"
                    class="nav-item nav-link {{ request()->is('perangkat*') ? 'active' : '' }}">Data Perangkat</a>
                <a href="{{ route('user.index') }}"
                    class="nav-item nav-link {{ request()->is('user*') ? 'active' : '' }}">Data User</a>
                <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
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
