<!DOCTYPE html>
<html lang="en">

<head>
    {{-- START CSS --}}
    @include('layouts.guest.css')
    {{-- END CSS --}}
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

        {{-- START HEADER --}}
        @include('layouts.guest.header')
        {{-- END HEADER --}}

        <!-- Full Screen Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content" style="background: rgba(29, 29, 39, 0.7);">
                    <div class="modal-header border-0">
                        <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center justify-content-center">
                        <div class="input-group" style="max-width: 600px;">
                            <input type="text" class="form-control bg-transparent border-light p-3"
                                placeholder="Type search keyword">
                            <button class="btn btn-light px-4"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Full Screen Search End -->

        {{-- START MAIN CONTENT --}}
        @yield('content')
        {{-- END MAIN CONTENT --}}

        <!-- Footer Start -->
        @include('layouts.guest.footer')
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="https://faq.whatsapp.com/5913398998672934/?locale=en_US" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i
            </i><img src="{{ asset(path: 'assets-guest/img/IconWa.png') }}" alt="{{ __('') }}"></a>


    </div>

    {{-- START JS --}}
    @include('layouts.guest.js')
    {{-- END JS --}}
</body>

</html>
