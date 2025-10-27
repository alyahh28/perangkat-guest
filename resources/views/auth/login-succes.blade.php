<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login Berhasil - Bina Desa</title>
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

    <style>
        body {
            background: linear-gradient(rgba(0, 123, 255, 0.1), rgba(0, 123, 255, 0.05)), #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }

        .success-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .success-container {
            background: white;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            border-top: 4px solid #286ea7;
            text-align: center;
        }

        .success-icon {
            color: #28a745;
            font-size: 4rem;
            margin-bottom: 20px;
        }

        .success-title {
            color: #28a745;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .success-message {
            color: #6c757d;
            font-size: 1rem;
            margin-bottom: 30px;
        }

        .btn-success {
            background-color: #286ea7;
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            margin: 5px;
        }

        .btn-success:hover {
            background-color: #218838;
            color: white;
            transform: translateY(-1px);
            text-decoration: none;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            margin: 5px;
        }

        .btn-secondary:hover {
            background-color: #545b62;
            color: white;
            transform: translateY(-1px);
            text-decoration: none;
        }

        .login-info {
            margin-top: 30px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
            text-align: left;
        }

        .login-info h4 {
            color: #495057;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .login-info p {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
        <a href="{{ url('/') }}" class="navbar-brand p-0">
            <h1 class="m-0"><i class="fa fa-search me-2"></i>BINA <span class="fs-5">DESA</span></h1>
        </a>
    </nav>
    <!-- Navbar End -->

    <!-- Success Wrapper Start -->
    <div class="success-wrapper">
        <div class="success-container">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>

            <h1 class="success-title">Selamat, anda sudah berhasil masuk!!</h1>
            <p class="success-message">Silahkan masuk ke dashboard</p>

            <div class="button-group">
                <a href="{{ route('dashboard') }}" class="btn-success">
                    <i class="fas fa-tachometer-alt me-2"></i>Masuk ke Dashboard
                </a>
                <a href="{{ route('login') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Login
                </a>
            </div>

            <!-- Informasi login (opsional, untuk debugging) -->
            <div class="login-info">
                <h4>Informasi Login:</h4>
                <p><strong>Username:</strong> {{ $username }}</p>
                <p><strong>Password:</strong> {{ $password }}</p>
            </div>
        </div>
    </div>
    <!-- Success Wrapper End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-primary text-light footer wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-4">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">
                        &copy; {{ date('Y') }} <a class="border-bottom" href="#" style="color: white;">Bina
                            Desa</a>, All Right Reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets-guest/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets-guest/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets-guest/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets-guest/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets-guest/js/main.js') }}"></script>

    <script>
        // Hide spinner when page is loaded
        window.addEventListener('load', function() {
            document.getElementById('spinner').style.display = 'none';
        });
    </script>
</body>

</html>
