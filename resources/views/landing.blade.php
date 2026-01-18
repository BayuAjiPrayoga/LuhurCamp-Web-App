@extends('layouts.app')

@section('title', 'LuhurCamp - The Beauty of Nature')

@section('content')
    <div class="min-h-screen bg-midnight-900 text-white font-sans selection:bg-azure-500 selection:text-white overflow-x-hidden">

        <!-- Live Campers Counter (Floating Widget) -->
        <div id="live-campers-widget" class="fixed bottom-6 right-6 z-50 transform translate-y-20 opacity-0 transition-all duration-700 ease-out">
            <div class="bg-midnight-900/90 backdrop-blur-md border border-azure-500/30 p-4 rounded-2xl shadow-2xl flex items-center gap-4 relative overflow-hidden group">
                <!-- Glow Effect -->
                <div class="absolute inset-0 bg-azure-500/10 blur-xl group-hover:bg-azure-500/20 transition"></div>

                <div class="relative z-10 flex items-center gap-3">
                    <div class="relative">
                        <span class="absolute top-0 right-0 w-3 h-3 bg-green-500 border-2 border-midnight-900 rounded-full z-10 animate-pulse"></span>
                        <div class="flex -space-x-3">
                            <img class="w-10 h-10 rounded-full border-2 border-midnight-900 object-cover" src="https://i.pravatar.cc/100?img=33" alt="">
                            <img class="w-10 h-10 rounded-full border-2 border-midnight-900 object-cover" src="https://i.pravatar.cc/100?img=47" alt="">
                            <img class="w-10 h-10 rounded-full border-2 border-midnight-900 object-cover" src="https://i.pravatar.cc/100?img=12" alt="">
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-azure-400 font-bold uppercase tracking-wider mb-0.5">Happening Now</p>
                        <p class="text-sm font-medium text-white"><span id="camper-count" class="font-bold text-lg text-white">24</span> Campers are here</p>
                    </div>
                </div>

                <!-- Close Button -->
                <button onclick="document.getElementById('live-campers-widget').classList.add('translate-y-20', 'opacity-0')" class="absolute top-1 right-1 p-1 text-gray-500 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>

        <!-- Navbar -->
        <nav id="navbar" class="fixed w-full z-50 transition-all duration-300 py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logoskycamp.png') }}" class="h-8 md:h-10 w-auto" alt="Logo">
                    <span class="font-bold text-lg md:text-xl tracking-wider">LuhurCamp</span>
                </div>

                <div class="hidden md:flex items-center space-x-8 text-sm font-medium text-azure-400">
                    <a href="#home" class="text-white hover:text-azure-400 transition relative group">
                        Home
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-azure-400 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#packages" class="hover:text-white transition">Packages</a>
                    <a href="#ticket" class="hover:text-white transition">Ticket</a>
                    <a href="#about" class="hover:text-white transition">About Us</a>
                    <a href="#contact" class="hover:text-white transition">Contact</a>
                </div>

                <a href="{{ route('login') }}"
                    class="px-6 py-2 bg-gradient-to-r from-azure-600 to-azure-500 rounded-full text-sm font-semibold hover:shadow-[0_0_20px_rgba(14,165,233,0.5)] transition-all transform hover:scale-105">
                    Login / Register
                </a>
            </div>
        </nav>

        <!-- Hero Section -->
        <section id="home" class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden">
            <!-- Background Layers -->
            <div class="absolute inset-0 z-0">
                <!-- Sky Gradient -->
                <div class="absolute inset-0 bg-gradient-to-b from-midnight-800 via-midnight-900 to-midnight-900"></div>
                <!-- Stars (CSS generated or image) -->
                <div class="absolute inset-0 opacity-30"
                    style="background-image: radial-gradient(white 1px, transparent 1px); background-size: 50px 50px;">
                </div>

                <!-- Mountain Layer 1 (Back) -->
                <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&q=80"
                    class="absolute bottom-0 left-0 w-full h-[70vh] object-cover opacity-40 mix-blend-overlay"
                    style="mask-image: linear-gradient(to top, black, transparent);" fetchpriority="high">

                <!-- Mountain Layer 2 (Front) -->
                <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&q=80"
                    class="absolute -bottom-20 left-0 w-full h-[60vh] object-cover mix-blend-normal opacity-80"
                    style="mask-image: linear-gradient(to top, black 60%, transparent);" fetchpriority="high">
            </div>

            <div
                class="relative z-10 w-full max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center h-full">

                <!-- Left Side: Main Text -->
                <div class="lg:col-span-8 flex flex-col justify-center">
                    <p class="text-azure-400 font-medium tracking-[0.2em] mb-4 animate-fade-in-up">THE BEAUTY OF</p>
                    <h1
                        class="text-6xl md:text-8xl lg:text-9xl font-bold tracking-tighter text-transparent bg-clip-text bg-gradient-to-b from-white to-white/10 mb-8 animate-fade-in text-shado-lg leading-none">
                        LUHUR<br>CAMP
                    </h1>

                    <div class="flex items-center gap-6 mt-8">
                        <!-- Play Video Button -->
                        <a href="https://youtu.be/r31am7oPNkg?si=weynxrye_JOx2gdZ" target="_blank"
                            class="relative group cursor-pointer animate-float">
                            <div
                                class="w-16 h-16 rounded-full border border-white/30 flex items-center justify-center backdrop-blur-sm group-hover:bg-white/10 transition">
                                <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center">
                                    <svg class="w-5 h-5 text-midnight-900 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                </div>
                            </div>
                            <span
                                class="absolute ml-20 top-1/2 -translate-y-1/2 text-sm font-medium w-max text-white/80 group-hover:text-white transition">Watch
                                Video</span>
                        </a>

                        <!-- Scroll Indicator -->
                        <div class="hidden md:flex flex-col items-center gap-2 ml-32 opacity-60">
                            <span class="text-xs tracking-widest -rotate-90 origin-center translate-y-8">SCROLL DOWN</span>
                            <div class="w-px h-24 bg-gradient-to-b from-white to-transparent mt-12"></div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Weather & Info -->
                <div class="lg:col-span-4 flex flex-col justify-between h-[60vh] py-10">
                    <!-- Weather Widget -->
                    <div
                        class="bg-midnight-800/50 backdrop-blur-md border border-white/10 p-6 rounded-3xl self-end w-full max-w-xs transition hover:bg-midnight-800/70 mb-4">
                        <div class="flex justify-between items-start mb-4">
                            <span class="bg-azure-500 text-white text-xs px-3 py-1 rounded-full">Today</span>
                            <span class="text-sm text-gray-400">Puncak Dua</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <div id="weather-icon" class="text-5xl">☁️</div>
                            <div>
                                <h3 id="weather-temp" class="text-4xl font-bold">18°C</h3>
                                <p id="weather-desc" class="text-azure-400 text-sm">Cloudy</p>
                            </div>
                        </div>
                        <div
                            class="mt-4 pt-4 border-t border-white/10 grid grid-cols-3 gap-2 text-center text-xs text-gray-400">
                            <div>
                                <span class="block text-white mb-1">Wind</span>
                                <span id="weather-wind">10km/h</span>
                            </div>
                            <div>
                                <span class="block text-white mb-1">Hum</span>
                                <span id="weather-hum">85%</span>
                            </div>
                            <div>
                                <span class="block text-white mb-1">Vis</span>
                                <span id="weather-vis">2km</span>
                            </div>
                        </div>
                    </div>

                    <!-- Altitude / Flight Widget -->
                    <div class="mt-auto self-end w-full max-w-xs">
                        <div class="bg-gradient-to-br from-secondary-900/90 to-midnight-900/90 backdrop-blur-md p-6 rounded-3xl border border-white/10 relative overflow-hidden group">
                            <!-- Animated Gauge Background -->
                            <div class="absolute right-0 top-0 opacity-20 transform translate-x-1/4 -translate-y-1/4">
                                <svg class="w-32 h-32 text-azure-500 animate-[spin_10s_linear_infinite]" viewBox="0 0 100 100">
                                    <circle cx="50" cy="50" r="45" stroke="currentColor" stroke-width="2" fill="none" stroke-dasharray="10 5"/>
                                </svg>
                            </div>

                            <div class="relative z-10">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-xs font-bold text-azure-400 uppercase tracking-widest">Altimeter</span>
                                    <div class="flex items-center gap-1 text-green-400 text-xs">
                                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Live
                                    </div>
                                </div>

                                <div class="flex items-end gap-2 mb-2">
                                    <span class="text-5xl font-bold text-white tracking-tighter">1400</span>
                                    <span class="text-lg text-gray-400 mb-2">MDPL</span>
                                </div>
                                <p class="text-xs text-gray-400 mb-4">Meters Above Sea Level</p>

                                <div class="space-y-3">
                                    <!-- Comparison -->
                                    <div class="flex items-center gap-3 text-xs text-gray-300">
                                        <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center">
                                            🏢
                                        </div>
                                        <div>
                                            <p class="font-bold text-white">Higher than</p>
                                            <p>Burj Khalifa (828m)</p>
                                        </div>
                                    </div>
                                    <!-- Oxygen -->
                                    <div class="flex items-center gap-3 text-xs text-gray-300">
                                        <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center">
                                            🌬️
                                        </div>
                                        <div>
                                            <p class="font-bold text-white">Oxygen Level</p>
                                            <p>~95% (Fresh Air)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floating Image Card (Bottom Left Overlap) -->
            <div class="absolute bottom-20 left-10 md:left-20 max-w-sm hidden lg:block">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-white/10 group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&q=80"
                        class="w-full h-48 object-cover group-hover:scale-110 transition duration-700" loading="lazy">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent flex flex-col justify-end p-6">
                        <p class="text-azure-400 text-xs font-bold uppercase mb-1">Our Facilities</p>
                        <h4 class="text-lg font-bold">Look deeper into Nature</h4>
                    </div>
                </div>
            </div>
        </section>

    <!-- Instagram Feed / UGC Section -->
    <section class="py-24 relative bg-midnight-950 overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute top-20 left-20 w-72 h-72 bg-azure-500/10 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-secondary-500/10 rounded-full blur-[100px]"></div>

        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="text-azure-500 font-bold uppercase tracking-widest text-sm">#LuhurCampMoments</span>
                <h2 class="text-4xl font-bold mt-2">Captured by You</h2>
                <div class="flex items-center justify-center gap-2 mt-4 text-gray-400">
                     <span>Follow <a href="#" class="text-white hover:text-azure-400 transition font-bold">@luhurcamp</a> on Instagram</span>
                </div>
            </div>

            <!-- Masonry Grid -->
            <div id="gallery-grid" class="grid grid-cols-2 md:grid-cols-4 gap-4 h-[600px]">
                <!-- Item 1 (Large) -->
                <div class="col-span-2 row-span-2 relative group overflow-hidden rounded-3xl cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?auto=format&fit=crop&q=80" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" loading="lazy">
                </div>
                <!-- Item 2 -->
                <div class="col-span-1 row-span-1 relative group overflow-hidden rounded-3xl cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&q=80" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <!-- Blog / Stories Section -->
    <section id="stories" class="py-24 relative bg-midnight-900 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4">
             <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div>
                    <span class="text-azure-500 font-bold uppercase tracking-widest text-sm">Stories from the Sky</span>
                    <h2 class="text-4xl font-bold mt-2">Tips & Tales</h2>
                </div>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                 <!-- Story 1 -->
                <article class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-3xl aspect-[4/3] mb-6">
                        <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&q=80" 
                             class="w-full h-full object-cover transition duration-700 group-hover:scale-110" loading="lazy">
                    </div>
                    <div class="space-y-3">
                        <h3 class="text-xl font-bold group-hover:text-azure-400 transition">Tips Camping Aman Saat Musim Hujan</h3>
                    </div>
                </article>
            </div>
        </div>
    </section>

        <!-- Packages & Opening Hours Section -->
        <section id="packages" class="py-24 relative">
            <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-2 gap-16 items-center">
                <!-- Info -->
                <div>
                    <span class="text-azure-500 font-bold uppercase tracking-widest text-sm">About Place</span>
                    <h2 class="text-5xl font-bold mt-4 mb-6">Luhur Camp <br>Mountain</h2>
                    <p class="text-gray-400 leading-relaxed mb-8">
                        Rasakan pengalaman camping terbaik di ketinggian 1400 MDPL.
                    </p>
                </div>

                <!-- Opening Hours Card -->
                <div class="relative">
                    <div class="bg-secondary-600 rounded-3xl p-8 md:p-12 relative overflow-hidden shadow-2xl">
                         <h3 class="text-2xl font-bold mb-8">Opening Hours</h3>
                        <div class="space-y-6">
                            <div>
                                <p class="text-azure-200 text-sm mb-1">Check In</p>
                                <p class="text-3xl font-bold">14:00 <span class="text-lg font-normal text-azure-200">WIB</span></p>
                            </div>
                            <div>
                                <p class="text-azure-200 text-sm mb-1">Check Out</p>
                                <p class="text-3xl font-bold">12:00 <span class="text-lg font-normal text-azure-200">WIB</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!-- Reviews / Testimonials Section -->
    <section id="reviews" class="py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 relative z-10 mx-auto">
             <div class="text-center mb-12">
                <span class="text-azure-500 font-bold uppercase tracking-widest text-sm">Stories from the Sky</span>
                <h2 class="text-4xl font-bold mt-2">What Campers Say</h2>
            </div>

            <!-- Marquee Container -->
            <div class="relative w-full overflow-hidden group">
                <div class="flex gap-6 animate-marquee hover:pause w-max">
                     <!-- Review Cards -->
                     @foreach([
                            ['name' => 'Budi Santoso', 'role' => 'Camper', 'text' => 'Pemandangan city light-nya juara banget!'],
                            ['name' => 'Siti Aminah', 'role' => 'Family Trip', 'text' => 'Cocok buat camping bareng keluarga.'],
                            ['name' => 'Reza Rahardian', 'role' => 'Photographer', 'text' => 'Spot foto sunrise-nya terbaik di Bogor.'],
                        ] as $review)
                        <div class="w-[350px] bg-secondary-600/30 backdrop-blur-md border border-white/5 p-8 rounded-3xl flex-shrink-0">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-azure-400 to-azure-600 flex items-center justify-center text-white font-bold text-xl">
                                    {{ substr($review['name'], 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-white">{{ $review['name'] }}</h4>
                                </div>
                            </div>
                            <p class="text-gray-300 text-sm leading-relaxed">"{{ $review['text'] }}"</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    <!-- Ticket/Packages Horizontal Scroll -->
        <section id="ticket" class="py-24 bg-midnight-800/50 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-4 mb-12">
                <h2 class="text-4xl font-bold text-center">Ticket & Packages</h2>
            </div>
            <div class="overflow-x-auto pb-12 hide-scrollbar">
                <div id="packages-list" class="flex gap-6 px-4 md:px-20 w-max mx-auto">
                    <div class="w-[300px] h-[400px] bg-secondary-600/50 rounded-3xl animate-pulse"></div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section id="faq" class="py-24 relative overflow-hidden">
            <div class="max-w-4xl mx-auto px-4 relative z-10">
                <div class="text-center mb-16">
                    <span class="text-azure-500 font-bold uppercase tracking-widest text-sm">Need Help?</span>
                    <h2 class="text-4xl font-bold mt-2">Frequently Asked Questions</h2>
                </div>
                <div class="space-y-4">
                    <div class="group bg-secondary-600/30 border border-white/5 rounded-2xl overflow-hidden hover:bg-secondary-600/50 transition duration-300">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none" onclick="this.parentElement.classList.toggle('active')">
                            <span class="font-bold text-lg text-white">Apakah ada listrik di setiap kavling?</span>
                        </button>
                        <div class="px-6 pb-0 h-0 overflow-hidden transition-all duration-300 group-[.active]:h-auto group-[.active]:pb-6">
                            <p class="text-gray-400">Ya, setiap kavling camping sudah dilengkapi dengan terminal listrik 24 jam.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer (Simple) -->
        <footer class="py-12 border-t border-white/5 bg-midnight-950">
            <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-3 opacity-80">
                    <img src="{{ asset('images/logoskycamp.png') }}" class="h-8 w-auto grayscale" loading="lazy">
                    <span class="font-bold">LuhurCamp</span>
                </div>
                <div class="text-gray-500 text-sm max-w-xl text-center md:text-left">
                    &copy; {{ date('Y') }} LuhurCamp. All rights reserved. <br>
                    <span class="text-xs text-gray-600 block mt-1">23552011194_BAYU AJI PRAYOOGA_TIF RP - 23 CNS A_UASWEB1</span>
                </div>
            </div>
        </footer>

    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // --- Navbar Glass Effect ---
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('bg-midnight-900/80', 'backdrop-blur-md', 'border-b', 'border-white/5', 'py-4');
                    navbar.classList.remove('py-6');
                } else {
                    navbar.classList.remove('bg-midnight-900/80', 'backdrop-blur-md', 'border-b', 'border-white/5', 'py-4');
                    navbar.classList.add('py-6');
                }
            });

            // --- Fetch Weather ---
            fetch('/api/v1/weather')
                .then(res => res.json())
                .then(data => {
                    if (data.main) {
                        document.getElementById('weather-temp').innerText = Math.round(data.main.temp) + '°C';
                        document.getElementById('weather-hum').innerText = data.main.humidity + '%';
                        document.getElementById('weather-vis').innerText = (data.visibility / 1000) + 'km';
                    }
                    if (data.wind) {
                        document.getElementById('weather-wind').innerText = data.wind.speed + 'm/s';
                    }
                    if (data.weather && data.weather[0]) {
                        document.getElementById('weather-desc').innerText = data.weather[0].main;
                        const iconMap = {
                            'Clouds': '☁️', 'Rain': '🌧️', 'Clear': '☀️', 'Mist': '🌫️', 'Drizzle': '🌦️'
                        };
                        document.getElementById('weather-icon').innerText = iconMap[data.weather[0].main] || '🌤️';
                    }
                })
                .catch(e => console.log('Weather API error, using static fallback'));

            // --- Fetch Packages ---
            fetch('/api/v1/kavlings')
                .then(res => res.json())
                .then(res => {
                    const container = document.getElementById('packages-list');
                    if (res.data && res.data.length > 0) {
                        container.innerHTML = '';
                        res.data.forEach(item => {
                            const card = document.createElement('div');
                            card.className = 'bg-secondary-600 rounded-3xl p-6 w-[320px] flex-shrink-0 border border-white/5 hover:border-azure-500/50 transition duration-300 group relative overflow-hidden';
                            // Use API image or fallback
                            const image = item.image ? `/storage/${item.image}` : 'https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&q=80';
                            card.innerHTML = `
                                    <div class="absolute inset-0 z-0">
                                        <img src="${image}" class="w-full h-full object-cover opacity-20 group-hover:opacity-40 transition duration-700" loading="lazy">
                                    </div>
                                    <div class="relative z-10 h-[350px] flex flex-col justify-end">
                                        <h3 class="text-2xl font-bold text-white mb-1 group-hover:text-azure-400 transition">${item.nama}</h3>
                                        <p class="text-azure-200 font-medium mb-4">IDR ${parseInt(item.harga_per_malam).toLocaleString('id-ID')}</p>
                                        <a href="https://wa.me/6281234567890?text=Halo%20LuhurCamp,%20saya%20mau%20booking%20${item.nama}" target="_blank" class="px-6 py-2 bg-azure-600 text-white text-center rounded-xl font-semibold hover:bg-azure-500 transition">Book Now</a>
                                    </div>
                                `;
                            container.appendChild(card);
                        });
                    }
                })
                .catch(e => console.error('Error loading packages', e));

            // --- Fetch Gallery (Captured by You) ---
            fetch('/api/v1/galleries')
                .then(res => res.json())
                .then(res => {
                    const container = document.getElementById('gallery-grid');
                    // Check standard Laravel resource wrapper 'data' or direct array
                    const items = res.data || res; 
                    
                    if (items && items.length > 0) {
                        container.innerHTML = '';
                        // Limit to first 4 items for the grid
                        const displayItems = items.slice(0, 4);
                        
                        displayItems.forEach((item, index) => {
                            const div = document.createElement('div');
                            // First item spans 2 cols and 2 rows (large), others are standard
                            if (index === 0) {
                                div.className = 'col-span-2 row-span-2 relative group overflow-hidden rounded-3xl cursor-pointer';
                            } else {
                                div.className = 'col-span-1 row-span-1 relative group overflow-hidden rounded-3xl cursor-pointer';
                            }

                            // Assuming item.image exists. Adjust property name if needed (e.g., item.file, item.url)
                            const imageUrl = item.image ? `/storage/${item.image}` : 'https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?auto=format&fit=crop&q=80';
                            
                            div.innerHTML = `
                                <img src="${imageUrl}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" loading="lazy" alt="User captured moment">
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition"></div>
                            `;
                            container.appendChild(div);
                        });
                    }
                })
                .catch(e => console.error('Error loading gallery', e));

            // --- Live Campers Widget Logic ---
            setTimeout(() => {
                const widget = document.getElementById('live-campers-widget');
                const countEl = document.getElementById('camper-count');
                if(widget) {
                    widget.classList.remove('translate-y-20', 'opacity-0');
                }
                setInterval(() => {
                    if(countEl) {
                        const current = parseInt(countEl.innerText);
                        const change = Math.random() > 0.5 ? 1 : -1;
                        let newCount = current + change;
                        if(newCount < 15) newCount = 15; // Min limit
                        if(newCount > 40) newCount = 40; // Max limit
                        countEl.innerText = newCount;
                    }
                }, 8000); 
            }, 3000);
        });
    </script>
    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endpush