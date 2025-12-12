<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login Berhasil - Portal Desa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="{{ asset('assets-guest/favicon.ico') }}" rel="icon">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets-guest/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-guest/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
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

        .success-card {
            background-color: rgba(30, 25, 45, 0.9);
            backdrop-filter: blur(8px);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 500px;
            text-align: center;
            color: white;
            border-top: 5px solid #00c851; /* Hijau Sukses */
        }

        .auth-logo {
            max-height: 60px;
            margin-bottom: 20px;
        }

        .icon-box {
            width: 80px;
            height: 80px;
            background: rgba(0, 200, 81, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #00c851;
            border: 2px solid #00c851;
            animation: bounceIn 0.8s;
        }

        .info-box {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 15px;
            margin: 25px 0;
            text-align: left;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-dashboard {
            background: linear-gradient(90deg, #00c851, #007e33);
            border: none;
            padding: 12px 35px;
            border-radius: 30px;
            color: white;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(0, 200, 81, 0.4);
        }

        .btn-dashboard:hover {
            transform: translateY(-2px);
            color: white;
        }

        @keyframes bounceIn {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>

<body>
    <div class="success-card animate__animated animate__fadeInDown">
        <img src="{{ asset('assets-guest/img/logo.png') }}" alt="Logo" class="auth-logo">

        <div class="icon-box">
            <i class="fas fa-check fa-3x"></i>
        </div>

        <h2 class="mb-2 fw-bold">Login Berhasil!</h2>
        <p class="text-white-50">Selamat datang kembali di sistem.</p>

        <div class="info-box">
            <div class="d-flex align-items-center mb-3">
                <i class="fas fa-user-circle fa-2x me-3 text-white"></i>
                <div>
                    <small class="text-white-50 d-block">Nama Pengguna</small>
                    <strong style="font-size: 1.1rem; color: #fff;">{{ auth()->user()->name ?? 'Guest' }}</strong>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <i class="fas fa-id-badge fa-2x me-3 text-white"></i>
                <div>
                    <small class="text-white-50 d-block">Role Akses</small>
                    <strong style="color: #fff;">{{ auth()->user()->role ?? 'User' }}</strong>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('dashboard') }}" class="btn-dashboard">
                <i class="fas fa-tachometer-alt me-2"></i> Masuk Dashboard
            </a>
        </div>

        <div class="mt-3">
            <a href="{{ route('login') }}" class="text-white-50 text-decoration-none small">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Login
            </a>
        </div>
    </div>
</body>
</html>
