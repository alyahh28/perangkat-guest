<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login - Portal Desa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="{{ asset('assets-guest/favicon.ico') }}" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets-guest/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            /* Background dengan Overlay Ungu Kebiruan seperti referensi */
            background: linear-gradient(rgba(48, 27, 94, 0.4), rgba(48, 27, 94, 0.6)),
                        url('{{ asset("assets-guest/img/dash.png") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .auth-card {
            background-color: rgba(30, 25, 45, 0.85); /* Warna gelap transparan */
            backdrop-filter: blur(8px); /* Efek blur kaca */
            padding: 40px 50px;
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 450px;
            color: white;
            text-align: center;
            position: relative;
        }

        .auth-logo {
            max-height: 80px;
            margin-bottom: 10px;
        }

        .auth-title {
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 40px;
            text-transform: uppercase;
            font-size: 24px;
            color: #fff;
        }

        /* Input Style Garis Bawah (Underline) */
        .form-group {
            margin-bottom: 25px;
            text-align: left;
        }

        .form-label {
            display: block;
            font-size: 14px;
            color: #a0a0a0;
            margin-bottom: 5px;
        }

        .form-control-custom {
            width: 100%;
            background: transparent;
            border: none;
            border-bottom: 2px solid #5a5a5a;
            padding: 10px 0;
            color: #fff;
            font-size: 16px;
            outline: none;
            transition: all 0.3s;
            border-radius: 0;
        }

        .form-control-custom:focus {
            border-bottom-color: #8c52ff; /* Warna Ungu saat aktif */
        }

        .form-control-custom::placeholder {
            color: transparent; /* Sembunyikan placeholder standar */
        }

        /* Tombol Register Ungu */
        .btn-auth {
            width: 100%;
            background: #6f42c1; /* Ungu */
            background: linear-gradient(90deg, #6200ea, #8c52ff);
            border: none;
            padding: 12px;
            border-radius: 30px;
            color: white;
            font-weight: 500;
            font-size: 16px;
            margin-top: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(140, 82, 255, 0.4);
            color: white;
        }

        .auth-footer {
            margin-top: 25px;
            font-size: 13px;
            color: #bbb;
        }

        .auth-footer a {
            color: #fff;
            text-decoration: underline;
        }

        /* Alert Custom */
        .alert-custom {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid #dc3545;
            color: #ff8b94;
            font-size: 14px;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="auth-card animate__animated animate__fadeIn">
        <img src="{{ asset('assets-guest/img/logo.png') }}" alt="Logo" class="auth-logo">

        <h2 class="auth-title">LOGIN</h2>

        @if ($errors->any())
            <div class="alert-custom">
                <i class="fas fa-exclamation-circle me-1"></i> {{ $errors->first() }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert-custom" style="border-color: #28a745; color: #a3cfbb; background: rgba(40, 167, 69, 0.2);">
                <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control-custom" value="{{ old('username') }}" required autocomplete="off">
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control-custom" required autocomplete="off">
            </div>

            <button type="submit" class="btn btn-auth">Login</button>
        </form>

        <div class="auth-footer">
            <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>
