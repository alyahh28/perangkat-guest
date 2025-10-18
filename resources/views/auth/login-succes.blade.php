<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Berhasil - Portal Desa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-xl shadow-lg max-w-md w-full text-center">
            <div class="text-green-600 text-5xl mb-4">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Selamat, anda sudah berhasil masuk!!</h1>
            <p class="text-gray-600 mb-6">Silahkan masuk ke dashboard</p>

            <div class="space-y-4">
                <a href="{{ route('dashboard') }}" 
                   class="block w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition duration-300 font-semibold">
                    <i class="fas fa-tachometer-alt mr-2"></i>Masuk ke Dashboard
                </a>
                <a href="{{ route('login') }}" 
                   class="block w-full bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition duration-300 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Login
                </a>
            </div>

            <!-- Informasi login (opsional, untuk debugging) -->
            <div class="mt-8 p-4 bg-gray-100 rounded-lg text-left">
                <h3 class="font-semibold text-gray-700 mb-2">Informasi Login:</h3>
                <p class="text-sm text-gray-600"><strong>Username:</strong> {{ $username }}</p>
                <p class="text-sm text-gray-600"><strong>Password:</strong> {{ $password }}</p>
            </div>
        </div>
    </div>
</body>
</html>