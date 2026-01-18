@extends('layouts.app')

@section('title', 'LuhurCamp - Smart Camping in the Clouds')

@section('content')
    <!-- Navbar -->
    <nav id="navbar" class="fixed w-full z-50 transition-all duration-300 bg-transparent py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="#" class="text-2xl font-bold text-white tracking-wider flex items-center gap-2">
                        <span>🏕️</span> LuhurCamp
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-white hover:text-primary-300 transition-colors font-medium">Beranda</a>
                    <a href="#about" class="text-white hover:text-primary-300 transition-colors font-medium">Tentang</a>
                    <a href="#amenities"
                        class="text-white hover:text-primary-300 transition-colors font-medium">Fasilitas</a>
                    <a href="#packages" class="text-white hover:text-primary-300 transition-colors font-medium">Paket</a>
                    <a href="#gallery" class="text-white hover:text-primary-300 transition-colors font-medium">Galeri</a>
                    <!-- Login Button -->
                    <a href="{{ route('login') }}"
                        class="px-6 py-2 bg-primary-600 hover:bg-primary-500 text-white rounded-full font-medium transition-all transform hover:scale-105 shadow-lg border border-primary-500/50 backdrop-blur-sm">
                        Masuk / Daftar
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-white focus:outline-none">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu"
            class="hidden md:hidden bg-secondary-600/95 backdrop-blur-md absolute w-full top-full left-0 border-t border-white/10">
            <div class="px-4 pt-4 pb-6 space-y-2">
                <a href="#home" class="block px-4 py-3 text-white hover:bg-white/10 rounded-lg">Beranda</a>
                <a href="#about" class="block px-4 py-3 text-white hover:bg-white/10 rounded-lg">Tentang</a>
                <a href="#amenities" class="block px-4 py-3 text-white hover:bg-white/10 rounded-lg">Fasilitas</a>
                <a href="#packages" class="block px-4 py-3 text-white hover:bg-white/10 rounded-lg">Paket</a>
                <a href="#gallery" class="block px-4 py-3 text-white hover:bg-white/10 rounded-lg">Galeri</a>
                <a href="{{ route('login') }}"
                    class="block px-4 py-3 text-center bg-primary-600 text-white rounded-lg mt-4 font-bold">Masuk /
                    Daftar</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?auto=format&fit=crop&q=80"
                alt="Camping Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto">
            <div class="animate-fade-in-up">
                <span
                    class="inline-block py-1 px-3 rounded-full bg-white/20 backdrop-blur-sm text-white text-sm font-semibold mb-6 border border-white/30">
                    ✨ Smart Camping in the Clouds
                </span>
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight tracking-tight">
                    Nikmati Alam dengan <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-accent-300">Sentuhan
                        Modern</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-200 mb-10 max-w-2xl mx-auto font-light">
                    Rasakan sensasi berkemah di ketinggian dengan fasilitas lengkap, pemandangan menakjubkan, dan pengalaman
                    tak terlupakan.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#packages"
                        class="px-8 py-4 bg-primary-600 hover:bg-primary-500 text-white text-lg rounded-full font-bold transition-all transform hover:scale-105 shadow-xl hover:shadow-primary-500/30">
                        Booking Sekarang
                    </a>
                    <a href="#about"
                        class="px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-md text-white text-lg rounded-full font-bold transition-all border border-white/30">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
            <a href="#about" class="text-white/70 hover:text-white transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3">
                    </path>
                </svg>
            </a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="relative group">
                    <div
                        class="absolute -inset-4 bg-gradient-to-r from-primary-500 to-accent-500 rounded-2xl opacity-20 blur-xl group-hover:opacity-30 transition duration-1000">
                    </div>
                    <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&q=80"
                        alt="About LuhurCamp"
                        class="relative rounded-2xl shadow-2xl w-full object-cover h-[500px] transform transition duration-500 hover:scale-[1.01]">

                    <!-- Floating Card -->
                    <div
                        class="absolute -bottom-6 -right-6 bg-white p-6 rounded-xl shadow-xl max-w-xs animate-float hidden md:block border border-gray-100">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center text-2xl">🌤️
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Ketinggian</p>
                                <p class="text-lg font-bold text-gray-900">1400+ MDPL</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600">Udara sejuk & pemandangan awan yang memukau setiap pagi.</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <span class="text-primary-600 font-bold tracking-wider uppercase text-sm">Tentang LuhurCamp</span>
                    <h2 class="text-4xl font-bold text-gray-900">Lebih dari Sekadar <br>Tempat Berkemah</h2>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        LuhurCamp hadir untuk memberikan pengalaman berkemah yang berbeda. Kami menggabungkan keindahan alam
                        pegunungan yang asri dengan kenyamanan fasilitas modern.
                    </p>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Terletak di dataran tinggi yang sejuk, LuhurCamp menawarkan pemandangan "Negeri di Atas Awan" yang
                        bisa Anda nikmati langsung dari tenda Anda. Cocok untuk liburan keluarga, outing kantor, atau
                        sekadar melepas penat dari hiruk pikuk kota.
                    </p>

                    <ul class="space-y-4 pt-4">
                        <li class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span class="text-gray-700 font-medium">Akses Mudah Dijangkau</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span class="text-gray-700 font-medium">Keamanan 24 Jam</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span class="text-gray-700 font-medium">Peralatan Lengkap</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Amenities Section -->
    <section id="amenities" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-primary-600 font-bold tracking-wider uppercase text-sm">Fasilitas</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2 mb-4">Kenyamanan Anda Prioritas Kami</h2>
                <p class="text-gray-600">Kami menyediakan berbagai fasilitas untuk memastikan pengalaman camping Anda tetap
                    nyaman dan aman.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition text-center group">
                    <div
                        class="w-16 h-16 mx-auto bg-primary-50 rounded-full flex items-center justify-center text-3xl mb-4 group-hover:scale-110 transition duration-300">
                        🔥
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Area Api Unggun</h3>
                    <p class="text-sm text-gray-500">Nikmati hangatnya malam dengan api unggun yang aman.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition text-center group">
                    <div
                        class="w-16 h-16 mx-auto bg-blue-50 rounded-full flex items-center justify-center text-3xl mb-4 group-hover:scale-110 transition duration-300">
                        ⚡
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Listrik 24 Jam</h3>
                    <p class="text-sm text-gray-500">Terminal listrik tersedia di setiap area kavling.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition text-center group">
                    <div
                        class="w-16 h-16 mx-auto bg-green-50 rounded-full flex items-center justify-center text-3xl mb-4 group-hover:scale-110 transition duration-300">
                        🚽
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Toilet Bersih</h3>
                    <p class="text-sm text-gray-500">Toilet duduk dan jongkok yang terawat kebersihannya.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition text-center group">
                    <div
                        class="w-16 h-16 mx-auto bg-yellow-50 rounded-full flex items-center justify-center text-3xl mb-4 group-hover:scale-110 transition duration-300">
                        🕌
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Mushola</h3>
                    <p class="text-sm text-gray-500">Tempat ibadah yang nyaman dan bersih tersedia.</p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition text-center group">
                    <div
                        class="w-16 h-16 mx-auto bg-purple-50 rounded-full flex items-center justify-center text-3xl mb-4 group-hover:scale-110 transition duration-300">
                        📶
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Free WiFi</h3>
                    <p class="text-sm text-gray-500">Tetap terhubung dengan dunia luar meski di alam.</p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition text-center group">
                    <div
                        class="w-16 h-16 mx-auto bg-red-50 rounded-full flex items-center justify-center text-3xl mb-4 group-hover:scale-110 transition duration-300">
                        🅿️
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Area Parkir Luas</h3>
                    <p class="text-sm text-gray-500">Parkir aman untuk motor dan mobil pengunjung.</p>
                </div>

                <!-- Feature 7 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition text-center group">
                    <div
                        class="w-16 h-16 mx-auto bg-orange-50 rounded-full flex items-center justify-center text-3xl mb-4 group-hover:scale-110 transition duration-300">
                        ☕
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Warung & Cafe</h3>
                    <p class="text-sm text-gray-500">Sedia berbagai makanan dan minuman hangat.</p>
                </div>

                <!-- Feature 8 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition text-center group">
                    <div
                        class="w-16 h-16 mx-auto bg-teal-50 rounded-full flex items-center justify-center text-3xl mb-4 group-hover:scale-110 transition duration-300">
                        🏕️
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Sewa Peralatan</h3>
                    <p class="text-sm text-gray-500">Tidak punya tenda? Kami sewakan lengkap!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Packages Section -->
    <section id="packages" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-primary-600 font-bold tracking-wider uppercase text-sm">Pilihan Paket</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2 mb-4">Pilih Spot Camping Favoritmu</h2>
                <p class="text-gray-600">Berbagai pilihan kavling sesuai kebutuhan Anda, dari yang minimalis hingga glamping
                    mewah.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div
                    class="bg-white border text-center border-gray-100 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 flex flex-col">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1537225228614-56cc3556d7ed?auto=format&fit=crop&q=80"
                            alt="Kavling Teras"
                            class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Kavling Deck A</h3>
                        <p class="text-gray-500 mb-6 line-clamp-2">Spot kayu eksklusif dengan view langsung ke lembah awan.
                        </p>

                        <div class="text-3xl font-bold text-primary-600 mb-6">
                            Running Price <span class="text-sm text-gray-400 font-normal">/malam</span>
                        </div>

                        <ul class="text-left space-y-3 mb-8 flex-1">
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="text-green-500">✓</span> Ukuran 4x4 Meter
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="text-green-500">✓</span> Kapasitas 4-6 Orang
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="text-green-500">✓</span> Alas Kayu Premium
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="text-green-500">✓</span> Dekat Sumber Listrik
                            </li>
                        </ul>

                        <a href="{{ route('login') }}"
                            class="block w-full py-3 px-6 bg-gray-900 text-white rounded-xl font-bold hover:bg-gray-800 transition">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>

                <!-- Card 2 (Highlight) -->
                <div
                    class="bg-white border-2 border-primary-500 text-center rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition duration-300 transform md:-translate-y-4 flex flex-col relative">
                    <div class="absolute top-0 right-0 bg-primary-500 text-white text-xs font-bold px-3 py-1 rounded-bl-lg">
                        POPULER</div>
                    <div class="h-48 overflow-hidden">
                        <img src="https://plus.unsplash.com/premium_photo-1661962483868-t366f6003254?auto=format&fit=crop&q=80"
                            alt="Glamping Tent"
                            class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Glamping VIP</h3>
                        <p class="text-gray-500 mb-6 line-clamp-2">Pengalaman camping tanpa ribet. Tenda sudah terpasang +
                            kasur empuk.</p>

                        <div class="text-3xl font-bold text-primary-600 mb-6">
                            Best Value <span class="text-sm text-gray-400 font-normal">/malam</span>
                        </div>

                        <ul class="text-left space-y-3 mb-8 flex-1">
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="text-green-500">✓</span> Tenda Safari Kapasitas 4
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="text-green-500">✓</span> Termasuk Kasur & Bantal
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="text-green-500">✓</span> Private Deck
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="text-green-500">✓</span> Breakfast Include
                            </li>
                        </ul>

                        <a href="{{ route('login') }}"
                            class="block w-full py-3 px-6 bg-primary-600 text-white rounded-xl font-bold hover:bg-primary-500 transition shadow-lg shadow-primary-500/30">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-white border text-center border-gray-100 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 flex flex-col">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1526491109672-74740652028d?auto=format&fit=crop&q=80"
                            alt="Ground Camping"
                            class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Kavling Ground</h3>
                        <p class="text-gray-500 mb-6 line-clamp-2">Camping di atas rumput hijau yang asri, rasakan alam
                            sesungguhnya.</p>

                        <div class="text-3xl font-bold text-primary-600 mb-6">
                            Hemat <span class="text-sm text-gray-400 font-normal">/malam</span>
                        </div>

                        <ul class="text-left space-y-3 mb-8 flex-1">
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="text-green-500">✓</span> Area Rumput Datar
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="text-green-500">✓</span> Kapasitas Fleksibel
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="text-green-500">✓</span> Dekat Toilet
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="text-green-500">✓</span> Bebas Pasang Hammock
                            </li>
                        </ul>

                        <a href="{{ route('login') }}"
                            class="block w-full py-3 px-6 bg-gray-900 text-white rounded-xl font-bold hover:bg-gray-800 transition">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-24 bg-secondary-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-primary-400 font-bold tracking-wider uppercase text-sm">Galeri Foto</span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mt-2 mb-4">Momen Indah di LuhurCamp</h2>
                <p class="text-gray-400">Intip keseruan dan keindahan alam yang telah diabadikan oleh pengunjung kami.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 auto-rows-[200px]">
                <div class="col-span-2 row-span-2 rounded-2xl overflow-hidden relative group">
                    <img src="https://images.unsplash.com/photo-1510312305653-8ed496efae75?auto=format&fit=crop&q=80"
                        alt="Gallery 1"
                        class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div
                        class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                        <span class="text-white font-bold text-lg">Suasana Malam</span>
                    </div>
                </div>
                <div class="col-span-1 row-span-1 rounded-2xl overflow-hidden relative group">
                    <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&q=80"
                        alt="Gallery 2"
                        class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                </div>
                <div class="col-span-1 row-span-1 rounded-2xl overflow-hidden relative group">
                    <img src="https://images.unsplash.com/photo-1529385101578-col" alt="Gallery 3"
                        class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                </div>
                <div class="col-span-1 row-span-1 rounded-2xl overflow-hidden relative group">
                    <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&q=80"
                        alt="Gallery 4"
                        class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                </div>
                <div class="col-span-1 row-span-1 rounded-2xl overflow-hidden relative group">
                    <img src="https://images.unsplash.com/photo-1492648272180-61e45a8d98a7?auto=format&fit=crop&q=80"
                        alt="Gallery 5"
                        class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('admin.galeri.index') }}"
                    class="inline-flex items-center gap-2 text-primary-400 hover:text-primary-300 font-medium transition">
                    Lihat Galeri Selengkapnya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-2xl font-bold text-white mb-4 flex items-center gap-2">
                        <span>🏕️</span> LuhurCamp
                    </h3>
                    <p class="text-gray-400 mb-6 max-w-sm">
                        Nikmati keindahan alam dan kenyamanan fasilitas modern di LuhurCamp. Destinasi camping terbaik untuk
                        Anda dan keluarga.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary-600 transition">
                            <!-- Facebook Icon -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary-600 transition">
                            <!-- Instagram Icon -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M16.5 6a.5.5 0 110 1 .5.5 0 010-1zM12 2a10 10 0 100 20 10 10 0 000-20zm0 18a8 8 0 110-16 8 8 0 010 16zm-5-8a5 5 0 1110 0 5 5 0 01-10 0z">
                                </path>
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary-600 transition">
                            <!-- Twitter Icon -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-4">Navigasi</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#home" class="hover:text-primary-500 transition">Beranda</a></li>
                        <li><a href="#about" class="hover:text-primary-500 transition">Tentang</a></li>
                        <li><a href="#packages" class="hover:text-primary-500 transition">Paket Camping</a></li>
                        <li><a href="#gallery" class="hover:text-primary-500 transition">Galeri</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-primary-500 transition">Login Admin</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-4">Kontak Kami</h4>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-primary-500 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Jalan Raya Puncak Dua, Bogor,<br>Jawa Barat, Indonesia</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            <span>+62 812-3456-7890</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span>info@luhurcamp.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center bg-gray-900">
                <p class="text-gray-500 text-sm">© {{ date('Y') }} LuhurCamp. All rights reserved.</p>
                <div class="flex space-x-6 text-sm text-gray-500 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
@endsection

@push('scripts')
    <script>
        // Navbar Scroll Effect
        const navbar = document.getElementById('navbar');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.remove('bg-transparent', 'py-4');
                navbar.classList.add('bg-secondary-900/90', 'backdrop-blur-md', 'shadow-md', 'py-2');
            } else {
                navbar.classList.add('bg-transparent', 'py-4');
                navbar.classList.remove('bg-secondary-900/90', 'backdrop-blur-md', 'shadow-md', 'py-2');
            }
        });

        // Mobile Menu Toggle
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // Close mobile menu on link click
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.add('hidden');
            });
        });
    </script>
@endpush