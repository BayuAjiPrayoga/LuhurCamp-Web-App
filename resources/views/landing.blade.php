@extends('layouts.app')

@section('title', 'LuhurCamp - The Beauty of Nature')

@section('content')
    <div
        class="min-h-screen bg-midnight-900 text-white font-sans selection:bg-azure-500 selection:text-white overflow-x-hidden">

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

    <!-- Interactive Map Section -->
    <section id="map" class="py-24 relative overflow-hidden bg-midnight-950">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-azure-500 font-bold uppercase tracking-widest text-sm">Explore Location</span>
                <h2 class="text-4xl font-bold mt-2">Campsite Map</h2>
                <p class="text-gray-400 mt-4 max-w-2xl mx-auto">
                    Interactive view of our camping grounds. Click on the pins to see spot details.
                </p>
            </div>

            <!-- Map Container -->
            <div class="relative w-full h-[600px] bg-midnight-800 rounded-3xl border border-white/5 overflow-hidden shadow-2xl group">
                <!-- Fallback/Background Map Image (Abstract Mountain Terrain) -->
                <div class="absolute inset-0 opacity-40 bg-[url('https://images.unsplash.com/photo-1548588627-f978862b85e1?auto=format&fit=crop&q=80')] bg-cover bg-center grayscale transition duration-700 group-hover:grayscale-0"></div>
                
                <!-- Map Grid Overlay -->
                <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] bg-[size:40px_40px]"></div>

                <!-- Interactive Pins (Mocked Position) -->
                <!-- We will populate this with JS based on API, for now hardcoded demo pins -->
                <div id="map-pins-container" class="absolute inset-0">
                    <!-- Pin Template -->
                    <!-- <div class="absolute cursor-pointer group/pin hover:z-50" style="top: 30%; left: 40%;">
                        <div class="w-8 h-8 -ml-4 -mt-8 bg-azure-500 rounded-full border-4 border-midnight-900 shadow-[0_0_20px_rgba(14,165,233,0.6)] animate-bounce"></div>
                        <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-4 w-48 bg-midnight-900/90 backdrop-blur-md p-4 rounded-xl border border-white/10 opacity-0 group-hover/pin:opacity-100 transition duration-300 pointer-events-none transform translate-y-2 group-hover/pin:translate-y-0 text-center">
                            <h4 class="font-bold text-white">Kavling A1</h4>
                            <p class="text-xs text-azure-400">View Citylight</p>
                            <p class="text-xs text-gray-300 mt-1">Status: <span class="text-green-400">Available</span></p>
                        </div>
                    </div> -->
                </div>
                
                <!-- Legend -->
                <div class="absolute bottom-6 left-6 bg-midnight-900/80 backdrop-blur-md p-4 rounded-xl border border-white/10 text-xs">
                    <div class="flex items-center gap-2 mb-2"><div class="w-3 h-3 rounded-full bg-azure-500"></div> Available</div>
                    <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-red-500"></div> Booked</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Virtual Tour Section (Panorama) -->
    <section id="virtual-tour" class="py-24 relative overflow-hidden bg-midnight-900">
        <div class="max-w-7xl mx-auto px-4 mb-12 flex flex-col md:flex-row justify-between items-end gap-6">
            <div>
                <span class="text-azure-500 font-bold uppercase tracking-widest text-sm">Experience It</span>
                <h2 class="text-4xl font-bold mt-2">Virtual Tour</h2>
                <p class="text-gray-400 mt-2">Drag or move mouse to explore the view.</p>
            </div>
            <div class="flex gap-2">
                <button class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white/10 transition" onclick="document.getElementById('pano-viewer').scrollLeft -= 50">
                    ←
                </button>
                <button class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white/10 transition" onclick="document.getElementById('pano-viewer').scrollLeft += 50">
                    →
                </button>
            </div>
        </div>

        <!-- Panorama Viewer -->
        <div class="w-full h-[60vh] relative group cursor-grab active:cursor-grabbing overflow-hidden">
             <!-- Overlay Text -->
             <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 pointer-events-none text-center opacity-0 group-hover:opacity-100 transition duration-500">
                <div class="bg-black/50 backdrop-blur-md px-6 py-3 rounded-full border border-white/10">
                    <span class="text-white font-medium tracking-wider">360° VIEW</span>
                </div>
             </div>

             <!-- The Panorama Image Container -->
            <div id="pano-viewer" class="w-full h-full overflow-x-scroll hide-scrollbar scroll-smooth relative" 
                 onmousemove="const w=this.scrollWidth-this.clientWidth; const p=event.clientX/window.innerWidth; this.scrollLeft=p*w;">
                <div class="w-[300vw] h-full relative">
                    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&q=80" 
                         class="w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 transition duration-700"
                         loading="lazy">
                    
                    <!-- Points of Interest -->
                    <div class="absolute top-1/2 left-[20%] group/poi">
                        <div class="w-4 h-4 bg-white rounded-full animate-ping"></div>
                        <div class="absolute top-6 left-1/2 -translate-x-1/2 bg-black/70 text-white text-xs px-2 py-1 rounded whitespace-nowrap opacity-0 group-hover/poi:opacity-100 transition">North Peak</div>
                    </div>
                    <div class="absolute top-2/3 left-[50%] group/poi">
                         <div class="w-4 h-4 bg-white rounded-full animate-ping delay-300"></div>
                         <div class="absolute top-6 left-1/2 -translate-x-1/2 bg-black/70 text-white text-xs px-2 py-1 rounded whitespace-nowrap opacity-0 group-hover/poi:opacity-100 transition">Camping Ground A</div>
                    </div>
                    <div class="absolute top-1/3 left-[80%] group/poi">
                         <div class="w-4 h-4 bg-white rounded-full animate-ping delay-700"></div>
                         <div class="absolute top-6 left-1/2 -translate-x-1/2 bg-black/70 text-white text-xs px-2 py-1 rounded whitespace-nowrap opacity-0 group-hover/poi:opacity-100 transition">Sunrise Point</div>
                    </div>
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.85-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.85-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.163 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    <span>Follow <a href="#" class="text-white hover:text-azure-400 transition font-bold">@luhurcamp</a> on Instagram</span>
                </div>
            </div>

            <!-- Masonry Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 h-[600px]">
                <!-- Item 1 (Large) -->
                <div class="col-span-2 row-span-2 relative group overflow-hidden rounded-3xl cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?auto=format&fit=crop&q=80" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-white/20 backdrop-blur overflow-hidden"><img src="https://i.pravatar.cc/100?img=12" class="w-full h-full object-cover"></div>
                            <span class="text-white text-sm font-medium">@alex_adventurer</span>
                        </div>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="col-span-1 row-span-1 relative group overflow-hidden rounded-3xl cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&q=80" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" loading="lazy">
                </div>
                 <!-- Item 3 -->
                 <div class="col-span-1 row-span-1 relative group overflow-hidden rounded-3xl cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1537225228614-56cc3556d7ed?auto=format&fit=crop&q=80" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" loading="lazy">
                </div>
                <!-- Item 4 (Wide) -->
                 <div class="col-span-2 row-span-1 relative group overflow-hidden rounded-3xl cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1496947853313-7992541a2a8f?auto=format&fit=crop&q=80" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-white/20 backdrop-blur overflow-hidden"><img src="https://i.pravatar.cc/100?img=32" class="w-full h-full object-cover"></div>
                            <span class="text-white text-sm font-medium">@sarah.hikes</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 text-center md:hidden">
                 <a href="#" class="inline-flex items-center gap-2 text-azure-400 border border-azure-400/30 px-6 py-3 rounded-full hover:bg-azure-400/10 transition">
                    View More on Instagram
                 </a>
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
                        Pemandangan city light yang memukau di malam hari dan lautan awan di pagi hari.
                        <br><br>
                        Fasilitas lengkap: Listrik, Toilet, Mushola, dan WiFi.
                    </p>
                    <div
                        class="flex items-center gap-4 text-sm font-medium text-azure-400 cursor-pointer hover:text-white transition">
                        LEARN MORE <span class="text-xl">→</span>
                    </div>
                </div>

                <!-- Opening Hours Card -->
                <div class="relative">
                    <div class="bg-secondary-600 rounded-3xl p-8 md:p-12 relative overflow-hidden shadow-2xl">
                        <div
                            class="absolute top-0 right-0 w-64 h-64 bg-azure-500/10 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2">
                        </div>

                        <h3 class="text-2xl font-bold mb-8">Opening Hours</h3>

                        <div class="space-y-6">
                            <div>
                                <p class="text-azure-200 text-sm mb-1">Check In</p>
                                <p class="text-3xl font-bold">14:00 <span
                                        class="text-lg font-normal text-azure-200">WIB</span></p>
                            </div>
                            <div>
                                <p class="text-azure-200 text-sm mb-1">Check Out</p>
                                <p class="text-3xl font-bold">12:00 <span
                                        class="text-lg font-normal text-azure-200">WIB</span></p>
                            </div>
                        </div>

                        <div class="mt-10 pt-8 border-t border-white/10">
                            <a href="#ticket" class="text-azure-400 hover:text-white transition flex items-center gap-2">
                                See schedule details <span>→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

            </section>

    <!-- Reviews / Testimonials Section -->
    <section id="reviews" class="py-24 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-azure-900/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-secondary-900/20 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 relative z-10 mx-auto">
             <div class="text-center mb-12">
                <span class="text-azure-500 font-bold uppercase tracking-widest text-sm">Stories from the Sky</span>
                <h2 class="text-4xl font-bold mt-2">What Campers Say</h2>
            </div>
            
            <!-- Marquee Container -->
            <div class="relative w-full overflow-hidden group">
                <div class="flex gap-6 animate-marquee hover:pause w-max">
                     <!-- Review Cards (Duplicated for infinite scroll effect) -->
                     @foreach([
                        ['name' => 'Budi Santoso', 'role' => 'Camper', 'text' => 'Pemandangan city light-nya juara banget! Fasilitas toilet bersih, listrik aman. Bakal balik lagi sih ini.'],
                        ['name' => 'Siti Aminah', 'role' => 'Family Trip', 'text' => 'Cocok buat camping bareng keluarga. Anak-anak seneng banget sama suasananya. Ga terlalu dingin karena bawa sleeping bag sewaan sini.'],
                        ['name' => 'Reza Rahardian', 'role' => 'Photographer', 'text' => 'Spot foto sunrise-nya terbaik di Bogor. Lautan awannya dapet banget pas pagi. Recommended buat hunter foto!'],
                        ['name' => 'Diana Putri', 'role' => 'Glamping', 'text' => 'Nyobain glamping-nya seru. Ga repot bawa tenda, tinggal bawa badan. Pelayanan ramah banget.'],
                         ['name' => 'Ahmad Dani', 'role' => 'Solo Camper', 'text' => 'Tenang, damai, dan syahdu. Tempat healing terbaik dari hiruk pikuk Jakarta. Kopi di kantinnya juga enak.'],
                     ] as $review)
                    <div class="w-[350px] bg-secondary-600/30 backdrop-blur-md border border-white/5 p-8 rounded-3xl flex-shrink-0">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-azure-400 to-azure-600 flex items-center justify-center text-white font-bold text-xl">
                                {{ substr($review['name'], 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-white">{{ $review['name'] }}</h4>
                                <p class="text-xs text-azure-400">{{ $review['role'] }}</p>
                            </div>
                        </div>
                        <p class="text-gray-300 text-sm leading-relaxed">"{{ $review['text'] }}"</p>
                        <div class="flex text-yellow-400 mt-4 text-sm gap-1">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                    </div>
                    @endforeach
                     <!-- Duplicate for Loop -->
                    @foreach([
                        ['name' => 'Budi Santoso', 'role' => 'Camper', 'text' => 'Pemandangan city light-nya juara banget! Fasilitas toilet bersih, listrik aman. Bakal balik lagi sih ini.'],
                        ['name' => 'Siti Aminah', 'role' => 'Family Trip', 'text' => 'Cocok buat camping bareng keluarga. Anak-anak seneng banget sama suasananya. Ga terlalu dingin karena bawa sleeping bag sewaan sini.'],
                        ['name' => 'Reza Rahardian', 'role' => 'Photographer', 'text' => 'Spot foto sunrise-nya terbaik di Bogor. Lautan awannya dapet banget pas pagi. Recommended buat hunter foto!'],
                        ['name' => 'Diana Putri', 'role' => 'Glamping', 'text' => 'Nyobain glamping-nya seru. Ga repot bawa tenda, tinggal bawa badan. Pelayanan ramah banget.'],
                         ['name' => 'Ahmad Dani', 'role' => 'Solo Camper', 'text' => 'Tenang, damai, dan syahdu. Tempat healing terbaik dari hiruk pikuk Jakarta. Kopi di kantinnya juga enak.'],
                     ] as $review)
                    <div class="w-[350px] bg-secondary-600/30 backdrop-blur-md border border-white/5 p-8 rounded-3xl flex-shrink-0">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-azure-400 to-azure-600 flex items-center justify-center text-white font-bold text-xl">
                                {{ substr($review['name'], 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-white">{{ $review['name'] }}</h4>
                                <p class="text-xs text-azure-400">{{ $review['role'] }}</p>
                            </div>
                        </div>
                        <p class="text-gray-300 text-sm leading-relaxed">"{{ $review['text'] }}"</p>
                        <div class="flex text-yellow-400 mt-4 text-sm gap-1">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
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

            <!-- Scrolling Container -->
            <div class="overflow-x-auto pb-12 hide-scrollbar">
                <div id="packages-list" class="flex gap-6 px-4 md:px-20 w-max mx-auto">
                    <!-- JS Will Inject Cards Here -->
                    <div class="w-[300px] h-[400px] bg-secondary-600/50 rounded-3xl animate-pulse"></div>
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
                    <!-- FAQ Item 1 -->
                    <div
                        class="group bg-secondary-600/30 border border-white/5 rounded-2xl overflow-hidden hover:bg-secondary-600/50 transition duration-300">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none"
                            onclick="this.parentElement.classList.toggle('active')">
                            <span class="font-bold text-lg text-white">Apakah ada listrik di setiap kavling?</span>
                            <span
                                class="text-azure-400 text-2xl transform transition-transform duration-300 group-[.active]:rotate-45">+</span>
                        </button>
                        <div
                            class="px-6 pb-0 h-0 overflow-hidden transition-all duration-300 group-[.active]:h-auto group-[.active]:pb-6">
                            <p class="text-gray-400">Ya, setiap kavling camping sudah dilengkapi dengan terminal listrik 24
                                jam. Anda bisa mencharge HP atau menggunakan alat elektronik lainnya tanpa biaya tambahan.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div
                        class="group bg-secondary-600/30 border border-white/5 rounded-2xl overflow-hidden hover:bg-secondary-600/50 transition duration-300">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none"
                            onclick="this.parentElement.classList.toggle('active')">
                            <span class="font-bold text-lg text-white">Bagaimana akses jalan menuju lokasi?</span>
                            <span
                                class="text-azure-400 text-2xl transform transition-transform duration-300 group-[.active]:rotate-45">+</span>
                        </button>
                        <div
                            class="px-6 pb-0 h-0 overflow-hidden transition-all duration-300 group-[.active]:h-auto group-[.active]:pb-6">
                            <p class="text-gray-400">Jalan menuju LuhurCamp sudah beraspal dan beton. Bisa dilalui oleh
                                mobil (City Car aman) maupun motor. Namun, harap berhati-hati saat hujan karena jalanan bisa
                                licin dan berkabut.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div
                        class="group bg-secondary-600/30 border border-white/5 rounded-2xl overflow-hidden hover:bg-secondary-600/50 transition duration-300">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none"
                            onclick="this.parentElement.classList.toggle('active')">
                            <span class="font-bold text-lg text-white">Apakah menyediakan sewa tenda?</span>
                            <span
                                class="text-azure-400 text-2xl transform transition-transform duration-300 group-[.active]:rotate-45">+</span>
                        </button>
                        <div
                            class="px-6 pb-0 h-0 overflow-hidden transition-all duration-300 group-[.active]:h-auto group-[.active]:pb-6">
                            <p class="text-gray-400">Tentu! Kami menyewakan paket tenda lengkap (Tenda, Matras, Sleeping
                                Bag, Lampu) dengan harga terjangkau. Anda bisa memesannya saat booking online atau langsung
                                di lokasi (selama persediaan ada).</p>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div
                        class="group bg-secondary-600/30 border border-white/5 rounded-2xl overflow-hidden hover:bg-secondary-600/50 transition duration-300">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none"
                            onclick="this.parentElement.classList.toggle('active')">
                            <span class="font-bold text-lg text-white">Apakah sinyal HP bagus?</span>
                            <span
                                class="text-azure-400 text-2xl transform transition-transform duration-300 group-[.active]:rotate-45">+</span>
                        </button>
                        <div
                            class="px-6 pb-0 h-0 overflow-hidden transition-all duration-300 group-[.active]:h-auto group-[.active]:pb-6">
                            <p class="text-gray-400">Sinyal Telkomsel dan XL cukup stabil di area camp. Kami juga
                                menyediakan fasilitas WiFi gratis di area utama dan kantin.</p>
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
                <div class="text-gray-500 text-sm">
                    &copy; {{ date('Y') }} LuhurCamp. All rights reserved.
                </div>
                <div class="flex gap-6 text-gray-500 text-sm">
                    <a href="#" class="hover:text-azure-400 transition">Instagram</a>
                    <a href="#" class="hover:text-azure-400 transition">WhatsApp</a>
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
                    if (res.success && res.data.length > 0) {
                        container.innerHTML = '';
                        res.data.forEach(item => {
                            const card = document.createElement('div');
                            card.className = 'bg-secondary-600 rounded-3xl p-6 w-[320px] flex-shrink-0 border border-white/5 hover:border-azure-500/50 transition duration-300 group relative overflow-hidden';

                            // Image Background (Overlay)
                            const image = item.image ? `/storage/${item.image}` : 'https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&q=80';

                            card.innerHTML = `
                                    <div class="absolute inset-0 z-0">
                                        <img src="${image}" class="w-full h-full object-cover opacity-20 group-hover:opacity-40 transition duration-700" loading="lazy">
                                        <div class="absolute inset-0 bg-gradient-to-t from-midnight-900 via-secondary-600/50 to-transparent"></div>
                                    </div>

                                    <div class="relative z-10 h-[350px] flex flex-col">
                                        <h3 class="text-2xl font-bold text-white mb-1 group-hover:text-azure-400 transition">${item.nama}</h3>
                                        <p class="text-azure-200 text-sm mb-4">Max ${item.kapasitas} Person</p>

                                        <p class="text-gray-300 text-sm line-clamp-3 mb-auto">${item.deskripsi || 'Perfect spot for camping.'}</p>

                                        <div class="mt-6 pt-6 border-t border-white/10 flex justify-between items-center">
                                            <div>
                                                <p class="text-xs text-gray-400">Start from</p>
                                                <p class="text-xl font-bold text-white">IDR ${parseInt(item.harga_per_malam).toLocaleString('id-ID')}</p>
                                            </div>
                                            <a href="#" class="w-10 h-10 rounded-full bg-azure-500 flex items-center justify-center text-white hover:bg-azure-400 transition shadow-lg shadow-azure-500/30">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                            </a>
                                        </div>
                                    </div>
                                `;
                            container.appendChild(card);
                        });
                    }
                })
                .catch(e => console.error('Error loading packages'));

            // --- Interactive Map Logic ---
            fetch('/api/v1/kavlings')
                .then(res => res.json())
                .then(res => {
                    const mapContainer = document.getElementById('map-pins-container');
                    if(res.success && res.data.length > 0 && mapContainer) {
                        // Mock positions for demo since API doesn't have coordinates
                        const positions = [
                            {t: '30%', l: '40%'}, {t: '50%', l: '60%'}, {t: '70%', l: '30%'}, 
                            {t: '20%', l: '70%'}, {t: '60%', l: '20%'}, {t: '40%', l: '80%'}
                        ];
                        
                        res.data.slice(0, 6).forEach((item, index) => {
                            const pos = positions[index] || {t: Math.random()*80+'%', l: Math.random()*80+'%'};
                            const isAvailable = Math.random() > 0.3; // Mock availability for variety if API returns all true
                            const statusColor = isAvailable ? 'bg-azure-500' : 'bg-red-500';
                            const statusText = isAvailable ? 'Available' : 'Booked';

                            const pin = document.createElement('div');
                            pin.className = 'absolute cursor-pointer group/pin hover:z-50';
                            pin.style.top = pos.t;
                            pin.style.left = pos.l;
                            
                            pin.innerHTML = `
                                <div class="w-6 h-6 -ml-3 -mt-3 ${statusColor} rounded-full border-2 border-midnight-900 shadow-[0_0_15px_currentColor] transition hover:scale-125"></div>
                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-3 w-40 bg-midnight-900/90 backdrop-blur-md p-3 rounded-xl border border-white/10 opacity-0 group-hover/pin:opacity-100 transition duration-300 pointer-events-none transform translate-y-2 group-hover/pin:translate-y-0 text-center z-50">
                                    <h4 class="font-bold text-white text-sm">${item.nama}</h4>
                                    <p class="text-[10px] text-gray-300 mt-1">Cap: ${item.kapasitas} Pax</p>
                                    <span class="inline-block mt-1 px-2 py-0.5 rounded text-[10px] ${isAvailable ? 'bg-azure-500/20 text-azure-400' : 'bg-red-500/20 text-red-400'} border border-white/5">
                                        ${statusText}
                                    </span>
                                </div>
                            `;
                            mapContainer.appendChild(pin);
                        });
                    }
                });
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