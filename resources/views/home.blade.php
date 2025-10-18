<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Portal Desa Mandiri' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-green-600 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <i class="fas fa-landmark text-3xl"></i>
                    <div>
                        <h1 class="text-2xl font-bold">Desa Mandiri</h1>
                        <p class="text-green-100 text-sm">Portal Perangkat & Lembaga Desa</p>
                    </div>
                </div>
                <nav class="hidden md:flex space-x-6">
                    <a href="#beranda" class="hover:text-green-200 font-semibold">Beranda</a>
                    <a href="#perangkat" class="hover:text-green-200">Perangkat Desa</a>
                    <a href="#lembaga" class="hover:text-green-200">Lembaga Desa</a>
                    <a href="#wilayah" class="hover:text-green-200">Struktur Wilayah</a>
                    <a href="#kontak" class="hover:text-green-200">Kontak</a>
                     <a href="{{ route('login') }}" class="hover:text-green-200">Login</a>
                </nav>
                <button class="md:hidden text-2xl">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="beranda" class="bg-gradient-to-r from-green-500 to-green-700 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">Selamat Datang di Desa Mandiri</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">
                Mari bersama-sama membangun desa melalui sinergi perangkat desa dan lembaga-lembaga yang ada. 
                Kenali struktur organisasi dan wilayah desa kami.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#perangkat" 
                   class="bg-white text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-green-50 transition duration-300">
                    <i class="fas fa-users mr-2"></i>Lihat Perangkat Desa
                </a>
                <a href="#lembaga" 
                   class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-green-600 transition duration-300">
                    <i class="fas fa-building mr-2"></i>Lihat Lembaga Desa
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center text-gray-800 mb-12">Desa Mandiri dalam Angka</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center group hover:transform hover:scale-105 transition duration-300">
                    <div class="bg-green-100 rounded-full w-24 h-24 mx-auto flex items-center justify-center mb-4 group-hover:bg-green-200">
                        <i class="fas fa-user-tie text-green-600 text-3xl"></i>
                    </div>
                    <h4 class="text-4xl font-bold text-gray-800">{{ $stats['total_perangkat'] ?? 0 }}</h4>
                    <p class="text-gray-600 font-semibold">Perangkat Desa</p>
                </div>
                <div class="text-center group hover:transform hover:scale-105 transition duration-300">
                    <div class="bg-blue-100 rounded-full w-24 h-24 mx-auto flex items-center justify-center mb-4 group-hover:bg-blue-200">
                        <i class="fas fa-hands-helping text-blue-600 text-3xl"></i>
                    </div>
                    <h4 class="text-4xl font-bold text-gray-800">{{ $stats['total_lembaga'] ?? 0 }}</h4>
                    <p class="text-gray-600 font-semibold">Lembaga Desa</p>
                </div>
                <div class="text-center group hover:transform hover:scale-105 transition duration-300">
                    <div class="bg-yellow-100 rounded-full w-24 h-24 mx-auto flex items-center justify-center mb-4 group-hover:bg-yellow-200">
                        <i class="fas fa-map-marker-alt text-yellow-600 text-3xl"></i>
                    </div>
                    <h4 class="text-4xl font-bold text-gray-800">{{ $stats['total_rt'] ?? 0 }}</h4>
                    <p class="text-gray-600 font-semibold">Rukun Tetangga</p>
                </div>
                <div class="text-center group hover:transform hover:scale-105 transition duration-300">
                    <div class="bg-red-100 rounded-full w-24 h-24 mx-auto flex items-center justify-center mb-4 group-hover:bg-red-200">
                        <i class="fas fa-map text-red-600 text-3xl"></i>
                    </div>
                    <h4 class="text-4xl font-bold text-gray-800">{{ $stats['total_rw'] ?? 0 }}</h4>
                    <p class="text-gray-600 font-semibold">Rukun Warga</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Perangkat Desa Section -->
    <section id="perangkat" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Struktur Perangkat Desa</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Kenali para perangkat desa yang bertugas melayani masyarakat dan membangun desa kita
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach(($perangkat_desa ?? []) as $index => $perangkat)
                <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-center mb-4">
                        <div class="w-24 h-24 bg-gradient-to-br from-green-400 to-green-600 rounded-full mx-auto flex items-center justify-center shadow-md">
                            @if($perangkat['foto'] ?? false)
                                <img src="{{ $perangkat['foto'] }}" alt="{{ $perangkat['nama'] }}" class="w-24 h-24 rounded-full object-cover">
                            @else
                                <i class="fas fa-user text-white text-3xl"></i>
                            @endif
                        </div>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-2">{{ $perangkat['nama'] }}</h3>
                    <p class="text-green-600 font-semibold text-center mb-4">{{ $perangkat['jabatan'] }}</p>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center p-2 bg-gray-50 rounded-lg">
                            <i class="fas fa-id-card text-green-500 w-6 text-center"></i>
                            <span class="ml-2 text-gray-700">{{ $perangkat['nip'] }}</span>
                        </div>
                        <div class="flex items-center p-2 bg-gray-50 rounded-lg">
                            <i class="fas fa-phone text-green-500 w-6 text-center"></i>
                            <span class="ml-2 text-gray-700">{{ $perangkat['kontak'] }}</span>
                        </div>
                        <div class="flex items-center p-2 bg-gray-50 rounded-lg">
                            <i class="fas fa-calendar-alt text-green-500 w-6 text-center"></i>
                            <span class="ml-2 text-gray-700">{{ $perangkat['periode'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <p class="text-gray-600">
                    Total <span class="font-semibold text-green-600">{{ count($perangkat_desa ?? []) }}</span> perangkat desa aktif
                </p>
            </div>
        </div>
    </section>

    <!-- Lembaga Desa Section -->
    <section id="lembaga" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Lembaga Desa</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Berbagai lembaga yang aktif berkontribusi dalam pembangunan dan pemberdayaan masyarakat desa
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @foreach(($lembaga_desa ?? []) as $lembaga)
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-blue-500 rounded-xl flex items-center justify-center shadow-md">
                                @if($lembaga['logo'] ?? false)
                                    <img src="{{ $lembaga['logo'] }}" alt="{{ $lembaga['nama'] }}" class="w-12 h-12">
                                @else
                                    <i class="fas fa-hands-helping text-white text-2xl"></i>
                                @endif
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $lembaga['nama'] }}</h3>
                            <p class="text-gray-600 mb-4 leading-relaxed">{{ $lembaga['deskripsi'] }}</p>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user-tie text-blue-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-xs">Ketua</p>
                                        <p class="font-semibold text-gray-700">{{ $lembaga['ketua'] }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-phone text-blue-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-xs">Kontak</p>
                                        <p class="font-semibold text-gray-700">{{ $lembaga['kontak'] }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-users text-blue-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-xs">Anggota</p>
                                        <p class="font-semibold text-gray-700">{{ $lembaga['jumlah_anggota'] }} orang</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Struktur Wilayah Section -->
    <section id="wilayah" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Struktur Wilayah</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Pembagian administratif desa dalam Rukun Warga (RW) dan Rukun Tetangga (RT)
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- RW Section -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-map text-red-500 mr-3"></i>
                        Rukun Warga (RW)
                    </h3>
                    <div class="space-y-4">
                        @foreach(($struktur_wilayah['rw'] ?? []) as $rw)
                        <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg hover:bg-red-100 transition duration-300">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">RW</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">RW {{ $rw['nomor'] }}</h4>
                                    <p class="text-sm text-gray-600">{{ $rw['ketua'] }}</p>
                                </div>
                            </div>
                            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                {{ count(array_filter($struktur_wilayah['rt'] ?? [], function($rt) use ($rw) { return $rt['rw'] === $rw['nomor']; })) }} RT
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- RT Section -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-map-marker-alt text-yellow-500 mr-3"></i>
                        Rukun Tetangga (RT)
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach(($struktur_wilayah['rt'] ?? []) as $rt)
                        <div class="flex items-center p-3 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition duration-300">
                            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center mr-3">
                                <span class="text-white font-bold text-sm">RT</span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800">RT {{ $rt['nomor'] }}/RW {{ $rt['rw'] }}</h4>
                                <p class="text-xs text-gray-600">{{ $rt['ketua'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="py-16 bg-green-600 text-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">Kontak Kami</h2>
                <p class="text-green-100 text-lg max-w-2xl mx-auto">
                    Hubungi kami untuk informasi lebih lanjut tentang perangkat dan lembaga desa
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marker-alt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Alamat Kantor</h3>
                    <p class="text-green-100">Jl. Desa Mandiri No. 123<br>Kecamatan Contoh, Kabupaten Sample</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-phone text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Telepon</h3>
                    <p class="text-green-100">(021) 1234-5678<br>0812-3456-7890</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Email</h3>
                    <p class="text-green-100">desamandiri@example.com<br>info@desamandiri.com</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <div class="flex justify-center space-x-6 mb-4">
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-facebook text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-whatsapp text-2xl"></i>
                    </a>
                </div>
                <p class="text-gray-400">&copy; 2024 Desa Mandiri. All rights reserved.</p>
                <p class="text-gray-500 text-sm mt-2">Portal Informasi Perangkat & Lembaga Desa</p>
            </div>
        </div>
    </footer>

    <!-- Smooth Scroll Script -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>