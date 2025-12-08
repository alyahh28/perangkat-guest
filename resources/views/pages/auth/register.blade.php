<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register - Bina Desa</title>
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

        .register-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            background: white;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            border-top: 4px solid #28a745;
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h2 {
            color: #28a745;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .register-header p {
            color: #6c757d;
            margin-bottom: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #495057;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: #286ea7;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
            outline: none;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #286ea7;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #218838;
            transform: translateY(-1px);
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 14px;
        }

        .alert-error ul {
            margin-bottom: 0;
            padding-left: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 14px;
        }

        .text-error {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
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

    <!-- Register Wrapper Start -->
    <div class="register-wrapper">
        <div class="register-container">
            <div class="register-header">
                <h2>📝 Register Guest</h2>
                <p>Daftar akun baru Bina Desa</p>
            </div>

            @if ($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>

                 <!-- role -->
                                        <div class="mb-3">
                                            <label for="role" class="form-label">role</label>
                                            <select id="role" name="role" class="form-select">
                                                <option value="">-- Pilih --</option>
                                                <option value="Admin">Admin</option>
                                                <option value="Warga">Warga</option>
                                            </select>
                                        </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                    @error('username')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                    <small style="display: block; margin-top: 5px; color: #6c757d;">Min. 3 karakter & harus ada huruf
                        kapital.</small>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>

                <button type="submit">REGISTER</button>
            </form>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </div>
        </div>
    </div>
    <!-- Register Wrapper End -->

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
