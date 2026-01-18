@extends('layouts.app')

@section('title', 'LuhurCamp - Smart Camping in the Clouds')

@section('content')
    <!-- Navbar -->
    <nav id="navbar" class="fixed w-full z-50 transition-all duration-300 bg-transparent py-4 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="#" class="text-2xl font-bold tracking-wider flex items-center gap-3">
                        <img src="{{ asset('storage/logoskycamp.png') }}" alt="LuhurCamp Logo" class="h-12 w-auto filter drop-shadow-lg">
                        <span class="hidden sm:block text-shadow-md">LuhurCamp</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="hover:text-primary-300 transition-colors font-medium text-shadow-sm">Beranda</a>
                    <a href="#about" class="hover:text-primary-300 transition-colors font-medium text-shadow-sm">Tentang</a>
                    <a href="#amenities" class="hover:text-primary-300 transition-colors font-medium text-shadow-sm">Fasilitas</a>
                    <a href="#packages" class="hover:text-primary-300 transition-colors font-medium text-shadow-sm">Paket</a>
                    <a href="#gallery" class="hover:text-primary-300 transition-colors font-medium text-shadow-sm">Galeri</a>
                    <!-- Login Button -->
                    <a href="{{ route('login') }}" class="px-6 py-2 bg-primary-600/90 hover:bg-primary-500 text-white rounded-full font-medium transition-all transform hover:scale-105 shadow-lg border border-primary-500/50 backdrop-blur-sm">
                        Masuk / Daftar
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="focus:outline-none">
                        <svg class="h-8 w-8 drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-secondary-900/95 backdrop-blur-md absolute w-full top-full left-0 border-t border-white/10 shadow-xl">
            <div class="px-4 pt-4 pb-6 space-y-2">
                <a href="#home" class="block px-4 py-3 hover:bg-white/10 rounded-lg transition">Beranda</a>
                <a href="#about" class="block px-4 py-3 hover:bg-white/10 rounded-lg transition">Tentang</a>
                <a href="#amenities" class="block px-4 py-3 hover:bg-white/10 rounded-lg transition">Fasilitas</a>
                <a href="#packages" class="block px-4 py-3 hover:bg-white/10 rounded-lg transition">Paket</a>
                <a href="#gallery" class="block px-4 py-3 hover:bg-white/10 rounded-lg transition">Galeri</a>
                <a href="{{ route('login') }}" class="block px-4 py-3 text-center bg-primary-600 text-white rounded-lg mt-4 font-bold shadow-lg">Masuk / Daftar</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section (Slider) -->
    <section id="home" class="relative h-screen flex items-center justify-center overflow-hidden bg-gray-900">
        <!-- Image Slider Background -->
        <div id="hero-slider" class="absolute inset-0 z-0">
             <!-- Slides will be injected by JS -->
        </div>
        
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-black/80 z-0"></div>

        <!-- Content -->
        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto">
            <div class="animate-fade-in-up">
                <span class="inline-block py-1.5 px-4 rounded-full bg-white/10 backdrop-blur-md text-white text-sm font-semibold mb-6 border border-white/20 shadow-lg">
                    ✨ Smart Camping in the Clouds
                </span>
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight tracking-tight text-shadow-lg">
                    Nikmati Alam dengan <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-accent-300 filter drop-shadow-lg">Sentuhan Modern</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-100 mb-10 max-w-2xl mx-auto font-light text-shadow-md">
                    Rasakan sensasi berkemah di ketinggian 1400 MDPL dengan fasilitas lengkap, pemandangan awan, dan pengalaman tak terlupakan.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#packages" class="px-8 py-4 bg-primary-600 hover:bg-primary-500 text-white text-lg rounded-full font-bold transition-all transform hover:scale-105 shadow-xl hover:shadow-primary-500/30 border border-primary-500/50">
                        Booking Sekarang
                    </a>
                    <a href="#about" class="px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-md text-white text-lg rounded-full font-bold transition-all border border-white/30 shadow-lg hover:shadow-white/10">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce z-10">
            <a href="#about" class="text-white/80 hover:text-white transition-colors">
                <svg class="w-10 h-10 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="relative group">
                    <div class="absolute -inset-4 bg-gradient-to-r from-primary-500 to-accent-500 rounded-2xl opacity-20 blur-xl group-hover:opacity-30 transition duration-1000"></div>
                    <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&q=80" alt="About LuhurCamp" class="relative rounded-2xl shadow-2xl w-full object-cover h-[500px] transform transition duration-500 hover:scale-[1.01]">
                    
                    <!-- Floating Card -->
                    <div class="absolute -bottom-6 -right-6 bg-white p-6 rounded-xl shadow-xl max-w-xs animate-float hidden md:block border border-gray-100/50 backdrop-blur-sm bg-white/90">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center text-2xl shadow-inner">🌤️</div>
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
                        LuhurCamp hadir untuk memberikan pengalaman berkemah yang berbeda. Kami menggabungkan keindahan alam pegunungan yang asri dengan kenyamanan fasilitas modern.
                    </p>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Terletak di dataran tinggi yang sejuk, LuhurCamp menawarkan pemandangan "Negeri di Atas Awan" yang bisa Anda nikmati langsung dari tenda Anda. Cocok untuk liburan keluarga, outing kantor, atau sekadar melepas penat dari hiruk pikuk kota.
                    </p>
                    
                    <ul class="space-y-4 pt-4">
                        <li class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-600">✓</span>
                            <span class="text-gray-700 font-medium">Akses Mudah Dijangkau</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-600">✓</span>
                            <span class="text-gray-700 font-medium">Keamanan 24 Jam</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-600">✓</span>
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
                <p class="text-gray-600">Kami menyediakan berbagai fasilitas untuk memastikan pengalaman camping Anda tetap nyaman, aman, dan menyenangkan.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
                <!-- Static Features Array -->
                @php
                $features = [
                    ['icon' => '🔥', 'color' => 'bg-orange-50', 'title' => 'Api Unggun', 'desc' => 'Area khusus untuk bakar-bakar.'],
                    ['icon' => '⚡', 'color' => 'bg-yellow-50', 'title' => 'Listrik 24 Jam', 'desc' => 'Terminal listrik di setiap kavling.'],
                    ['icon' => '🚽', 'color' => 'bg-green-50', 'title' => 'Toilet Bersih', 'desc' => 'Toilet duduk & jongkok terawat.'],
                    ['icon' => '🕌', 'color' => 'bg-blue-50', 'title' => 'Mushola', 'desc' => 'Tempat ibadah nyaman.'],
                    ['icon' => '📶', 'color' => 'bg-purple-50', 'title' => 'Free WiFi', 'desc' => 'Internet kencang di area camp.'],
                    ['icon' => '🅿️', 'color' => 'bg-red-50', 'title' => 'Parkir Luas', 'desc' => 'Aman untuk mobil & motor.'],
                    ['icon' => '☕', 'color' => 'bg-amber-50', 'title' => 'Kantin', 'desc' => 'Sedia makanan & minuman.'],
                    ['icon' => '🏕️', 'color' => 'bg-teal-50', 'title' => 'Sewa Alat', 'desc' => 'Tenda, matras, sleeping bag dll.'],
                ];
                @endphp

                @foreach($features as $feature)
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 text-center group border border-gray-100">
                    <div class="w-16 h-16 mx-auto {{ $feature['color'] }} rounded-2xl flex items-center justify-center text-3xl mb-4 group-hover:scale-110 group-hover:rotate-3 transition duration-300 shadow-inner">
                        {{ $feature['icon'] }}
                    </div>
                    <h3 class="font-bold text-gray-900 mb-1 group-hover:text-primary-600 transition">{{ $feature['title'] }}</h3>
                    <p class="text-xs text-gray-500">{{ $feature['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Packages Section (Dynamic) -->
    <section id="packages" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-primary-600 font-bold tracking-wider uppercase text-sm">Pilihan Paket</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2 mb-4">Pilih Spot Camping Favoritmu</h2>
                <p class="text-gray-600">Berbagai pilihan kavling dari yang minimalis hingga glamping mewah, sesuai kebutuhan budget Anda.</p>
            </div>

            <!-- Loader -->
            <div id="packages-loader" class="flex justify-center py-12">
                <div class="w-12 h-12 border-4 border-primary-200 border-t-primary-600 rounded-full animate-spin"></div>
            </div>

            <!-- Grid Container -->
            <div id="packages-container" class="grid md:grid-cols-3 gap-8 hidden">
                <!-- Content injected via JS -->
            </div>
            
            <!-- Fallback / Static (Hidden by default, shown if JS fails or empty) -->
            <div id="packages-fallback" class="hidden text-center py-8 text-gray-500">
                <p>Silakan hubungi admin untuk info paket terbaru.</p>
            </div>
        </div>
    </section>

    <!-- Gallery Section (Dynamic) -->
    <section id="gallery" class="py-24 bg-secondary-900 text-white relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-primary-500/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-accent-500/10 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                 <span class="text-primary-400 font-bold tracking-wider uppercase text-sm">Galeri Foto</span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mt-2 mb-4">Momen Indah di LuhurCamp</h2>
                <p class="text-gray-400">Intip keseruan dan keindahan alam yang telah diabadikan oleh pengunjung kami.</p>
            </div>

             <!-- Loader -->
             <div id="gallery-loader" class="flex justify-center py-12">
                <div class="w-12 h-12 border-4 border-white/20 border-t-primary-500 rounded-full animate-spin"></div>
            </div>

            <!-- Gallery Grid -->
            <div id="gallery-container" class="grid grid-cols-2 md:grid-cols-4 gap-4 auto-rows-[200px] hidden">
                 <!-- Content injected via JS -->
            </div>
            
             <div class="text-center mt-12">
                <a href="{{ route('admin.galeri.index') }}" class="inline-flex items-center gap-2 text-primary-400 hover:text-primary-300 font-medium transition hover:translate-x-1">
                    Lihat Galeri Selengkapnya 
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
             </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-950 text-white pt-20 pb-10 border-t border-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-2 space-y-4">
                    <h3 class="text-2xl font-bold text-white flex items-center gap-3">
                         <img src="{{ asset('storage/logoskycamp.png') }}" class="h-10 w-auto filter grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition duration-300">
                         <span>LuhurCamp</span>
                    </h3>
                    <p class="text-gray-400 max-w-sm leading-relaxed">
                        Nikmati keindahan alam dan kenyamanan fasilitas modern di LuhurCamp. Destinasi camping terbaik untuk Anda dan keluarga di Puncak Dua.
                    </p>
                    <div class="flex space-x-4 pt-2">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-900 border border-gray-800 flex items-center justify-center hover:bg-primary-600 hover:border-primary-600 hover:text-white text-gray-400 transition transform hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-900 border border-gray-800 flex items-center justify-center hover:bg-pink-600 hover:border-pink-600 hover:text-white text-gray-400 transition transform hover:-translate-y-1">
                             <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M16.5 6a.5.5 0 110 1 .5.5 0 010-1zM12 2a10 10 0 100 20 10 10 0 000-20zm0 18a8 8 0 110-16 8 8 0 010 16zm-5-8a5 5 0 1110 0 5 5 0 01-10 0z"></path></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-900 border border-gray-800 flex items-center justify-center hover:bg-blue-400 hover:border-blue-400 hover:text-white text-gray-400 transition transform hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path></svg>
                        </a>
                    </div>
                </div>
                
                <div>
                     <h4 class="text-white font-bold mb-6 text-lg">Navigasi</h4>
                     <ul class="space-y-3 text-sm text-gray-400">
                         <li><a href="#home" class="hover:text-primary-500 transition flex items-center gap-2"><span class="w-1 h-1 bg-primary-500 rounded-full opacity-0 hover:opacity-100 transition"></span> Beranda</a></li>
                         <li><a href="#about" class="hover:text-primary-500 transition flex items-center gap-2"><span class="w-1 h-1 bg-primary-500 rounded-full opacity-0 hover:opacity-100 transition"></span> Tentang</a></li>
                         <li><a href="#packages" class="hover:text-primary-500 transition flex items-center gap-2"><span class="w-1 h-1 bg-primary-500 rounded-full opacity-0 hover:opacity-100 transition"></span> Paket Camping</a></li>
                         <li><a href="#gallery" class="hover:text-primary-500 transition flex items-center gap-2"><span class="w-1 h-1 bg-primary-500 rounded-full opacity-0 hover:opacity-100 transition"></span> Galeri</a></li>
                         <li><a href="{{ route('login') }}" class="hover:text-primary-500 transition flex items-center gap-2"><span class="w-1 h-1 bg-primary-500 rounded-full opacity-0 hover:opacity-100 transition"></span> Login Admin</a></li>
                     </ul>
                </div>

                 <div>
                     <h4 class="text-white font-bold mb-6 text-lg">Kontak Kami</h4>
                     <ul class="space-y-5 text-sm text-gray-400">
                         <li class="flex items-start gap-3 group">
                             <div class="mt-1 w-8 h-8 rounded-lg bg-gray-900 border border-gray-800 flex items-center justify-center group-hover:border-primary-600 transition">
                                 <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                             </div>
                             <span class="flex-1">Jalan Raya Puncak Dua, Bogor,<br>Jawa Barat, Indonesia</span>
                         </li>
                         <li class="flex items-center gap-3 group">
                            <div class="w-8 h-8 rounded-lg bg-gray-900 border border-gray-800 flex items-center justify-center group-hover:border-primary-600 transition">
                                <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                             <span>+62 812-3456-7890</span>
                         </li>
                         <li class="flex items-center gap-3 group">
                            <div class="w-8 h-8 rounded-lg bg-gray-900 border border-gray-800 flex items-center justify-center group-hover:border-primary-600 transition">
                                <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                             <span>info@luhurcamp.id</span>
                         </li>
                     </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-900 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-600 text-sm">© {{ date('Y') }} LuhurCamp. All rights reserved.</p>
                <div class="flex space-x-6 text-sm text-gray-600 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
@endsection

@push('styles')
<style>
    .text-shadow-sm { text-shadow: 1px 1px 2px rgba(0,0,0,0.5); }
    .text-shadow-md { text-shadow: 2px 2px 4px rgba(0,0,0,0.5); }
    .text-shadow-lg { text-shadow: 3px 3px 6px rgba(0,0,0,0.6); }
    
    /* Hero Slider */
    #hero-slider .slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 1.5s ease-in-out;
    }
    #hero-slider .slide.active {
        opacity: 1;
    }
    #hero-slider .slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: scale(1.1);
        transition: transform 10s ease-out;
    }
    #hero-slider .slide.active img {
        transform: scale(1);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- Navbar Scroll Logic ---
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.remove('bg-transparent', 'py-4', 'text-white');
                navbar.classList.add('bg-secondary-900/90', 'backdrop-blur-md', 'shadow-md', 'py-2', 'text-gray-100');
            } else {
                navbar.classList.add('bg-transparent', 'py-4', 'text-white');
                navbar.classList.remove('bg-secondary-900/90', 'backdrop-blur-md', 'shadow-md', 'py-2', 'text-gray-100');
            }
        });

        // --- Mobile Menu ---
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        btn.addEventListener('click', () => menu.classList.toggle('hidden'));
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => menu.classList.add('hidden'));
        });

        // --- Hero Image Slider ---
        const slides = [
            'https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?auto=format&fit=crop&q=80',
            'https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&q=80',
            'https://images.unsplash.com/photo-1492648272180-61e45a8d98a7?auto=format&fit=crop&q=80',
            'https://images.unsplash.com/photo-1537225228614-56cc3556d7ed?auto=format&fit=crop&q=80'
        ];
        
        const sliderContainer = document.getElementById('hero-slider');
        
        // Initialize slides
        slides.forEach((src, index) => {
            const div = document.createElement('div');
            div.className = `slide ${index === 0 ? 'active' : ''}`;
            div.innerHTML = `<img src="${src}" alt="Slide ${index}">`;
            sliderContainer.appendChild(div);
        });

        let currentSlide = 0;
        setInterval(() => {
            const activeSlides = document.querySelectorAll('#hero-slider .slide');
            activeSlides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            activeSlides[currentSlide].classList.add('active');
        }, 5000); // Change every 5 seconds

        // --- Fetch API: Packages ---
        fetch('/api/v1/kavlings')
            .then(res => res.json())
            .then(res => {
                const loader = document.getElementById('packages-loader');
                const container = document.getElementById('packages-container');
                const fallback = document.getElementById('packages-fallback');
                
                loader.classList.add('hidden');
                
                if (res.success && res.data.length > 0) {
                    container.classList.remove('hidden');
                    
                    // Limit to 3 items for homepage
                    const items = res.data.slice(0, 3);
                    
                    items.forEach(item => {
                        const card = document.createElement('div');
                        card.className = 'bg-white border text-center border-gray-100 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 flex flex-col group';
                        
                        // Default image if no gallery (handling future enhancement)
                        const image = item.image ? `/storage/${item.image}` : 'https://images.unsplash.com/photo-1537225228614-56cc3556d7ed?auto=format&fit=crop&q=80';
                        
                        card.innerHTML = `
                            <div class="h-56 overflow-hidden relative">
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition z-10"></div>
                                <img src="${image}" alt="${item.nama}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                                <div class="absolute top-4 right-4 z-20">
                                    <span class="bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-primary-600 shadow-sm">${item.kapasitas} Orang</span>
                                </div>
                            </div>
                            <div class="p-8 flex-1 flex flex-col items-start text-left">
                                <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-primary-600 transition">${item.nama}</h3>
                                <p class="text-gray-500 mb-6 text-sm line-clamp-3">${item.deskripsi || 'Nikmati keindahan alam dari kavling ini.'}</p>
                                
                                <div class="w-full h-px bg-gray-100 mb-6"></div>

                                <div class="text-3xl font-bold text-primary-600 mb-6">
                                    Rp ${parseInt(item.harga_per_malam).toLocaleString('id-ID')} <span class="text-sm text-gray-400 font-normal">/malam</span>
                                </div>

                                <a href="{{ route('login') }}" class="block w-full py-3 px-6 bg-gray-900 text-white text-center rounded-xl font-bold hover:bg-primary-600 transition shadow-lg shadow-gray-200">
                                    Pesan Sekarang
                                </a>
                            </div>
                        `;
                        container.appendChild(card);
                    });
                } else {
                     fallback.classList.remove('hidden');
                }
            })
            .catch(err => {
                console.error('Error fetching kavlings:', err);
                document.getElementById('packages-loader').classList.add('hidden');
                document.getElementById('packages-fallback').classList.remove('hidden');
            });

        // --- Fetch API: Gallery ---
        fetch('/api/v1/galleries')
            .then(res => res.json())
            .then(res => {
                const loader = document.getElementById('gallery-loader');
                const container = document.getElementById('gallery-container');
                
                loader.classList.add('hidden');
                
                if (res.success && res.data.data.length > 0) {
                    container.classList.remove('hidden');
                    // Take first 5 items
                    const items = res.data.data.slice(0, 5);
                    
                    items.forEach((item, index) => {
                        const div = document.createElement('div');
                        // First item spans 2x2
                        if (index === 0) {
                            div.className = 'col-span-2 row-span-2 rounded-2xl overflow-hidden relative group shadow-lg';
                        } else {
                            div.className = 'col-span-1 row-span-1 rounded-2xl overflow-hidden relative group shadow-md';
                        }
                        
                        // Check if image path needs 'storage/' prefix
                        const imgPath = item.image_path.startsWith('http') ? item.image_path : `/storage/${item.image_path}`;
                        
                        div.innerHTML = `
                             <img src="${imgPath}" alt="Gallery ${index}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                             <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center p-4 text-center">
                                 <div>
                                     <span class="text-white font-bold text-lg block mb-1">${item.user ? item.user.name : 'Pengunjung'}</span>
                                     <span class="text-white/80 text-xs">${item.caption || ''}</span>
                                 </div>
                             </div>
                        `;
                        container.appendChild(div);
                    });
                }
            })
            .catch(err => console.error('Error fetching gallery:', err));
    });
</script>
@endpush