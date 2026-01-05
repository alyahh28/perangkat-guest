<!DOCTYPE html>
<html lang="en">

<head>
    {{-- START CSS --}}
    @include('layouts.guest.css')
    {{-- END CSS --}}
</head>

<body>
    {{-- WRAPPER UTAMA: Menggunakan container-fluid agar full width seperti template SEO Master --}}
    <div class="container-fluid bg-white p-0">

        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        {{-- HEADER (Navbar & Hero) --}}
        {{-- Di template ini, Navbar & Hero disatukan dalam satu file header agar background menyatu --}}
        @include('layouts.guest.header')

        {{-- MAIN CONTENT --}}
        {{-- Kita tidak memberi container di sini, biarkan halaman (dashboard) yang mengatur containernya sendiri --}}
        @yield('content')

        {{-- FOOTER --}}
        @include('layouts.guest.footer')

        {{-- BUTTON WA --}}
        <a href="https://wa.me/6281234567890?text=Halo%20Admin%2C%20saya%20ingin%20bertanya." class="whatsapp-float shadow" target="_blank">
            <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp" />
        </a>

    {{-- START JS --}}
    @include('layouts.guest.js')
    {{-- END JS --}}
</body>

</html>
