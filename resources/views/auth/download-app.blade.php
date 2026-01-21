<x-layouts.guest title="Download App">
    <!-- Success Icon -->
    <div class="text-center mb-8">
        <div
            class="inline-flex items-center justify-center w-24 h-24 mb-6 bg-green-100 rounded-full animate-bounce-slow">
            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-slate-900">Registrasi Berhasil! 🎉</h1>
        @if(session('registered_user'))
            <p class="text-slate-500 mt-2">Selamat datang, <span
                    class="font-semibold text-slate-700">{{ session('registered_user')['name'] }}</span>!</p>
            <p class="text-sm text-slate-400 mt-1">{{ session('registered_user')['email'] }}</p>
        @else
            <p class="text-slate-500 mt-2">Akun Anda telah berhasil dibuat.</p>
        @endif
    </div>

    <!-- Countdown Section -->
    <div id="countdown-section"
        class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6 mb-6 text-center">
        <div class="flex items-center justify-center gap-2 mb-3">
            <svg class="w-5 h-5 text-blue-600 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
            <span class="text-blue-700 font-medium">Download otomatis dalam</span>
        </div>
        <div class="text-5xl font-bold text-blue-600" id="countdown">5</div>
        <p class="text-blue-500 text-sm mt-2">detik</p>
    </div>

    <!-- Download Section -->
    <div class="bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6 mb-6">
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0">
                <div
                    class="w-14 h-14 bg-green-600 rounded-2xl flex items-center justify-center shadow-lg shadow-green-600/30">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.523 2H6.477C5.66 2 5 2.66 5 3.477v17.046C5 21.34 5.66 22 6.477 22h11.046c.817 0 1.477-.66 1.477-1.477V3.477C19 2.66 18.34 2 17.523 2zM12 20c-.69 0-1.25-.56-1.25-1.25S11.31 17.5 12 17.5s1.25.56 1.25 1.25S12.69 20 12 20zm5-3.5H7v-12h10v12z" />
                    </svg>
                </div>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-slate-900 text-lg">LuhurCamp Mobile App</h3>
                <p class="text-slate-600 text-sm mt-1">Login di aplikasi mobile dengan email dan password yang baru saja
                    Anda buat.</p>
            </div>
        </div>
    </div>

    @php
        // Check if APK exists on server first, fallback to Google Drive
        $localApkPath = 'downloads/SkyCamp_luhurcamp-mobile-app.apk';
        $apkExistsLocally = file_exists(public_path($localApkPath));
        $downloadUrl = $apkExistsLocally
            ? asset($localApkPath)
            : 'https://drive.google.com/file/d/1YHtHR5pU1Ug3XNpyxEp-vHu7Y3XQVSUZ/view?usp=sharing';
        $isDirectDownload = $apkExistsLocally;
    @endphp

    <!-- Download Button (Manual) -->
    <a href="{{ $downloadUrl }}" id="download-btn" {{ $isDirectDownload ? 'download' : 'target="_blank"' }}
        class="btn-gradient w-full py-4 px-6 text-white font-semibold rounded-xl flex items-center justify-center gap-3 mb-4 hover:shadow-lg transition-all">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
        Download APK Sekarang
    </a>

    @if(!$isDirectDownload)
        <p class="text-center text-slate-400 text-xs mb-4">
            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Anda akan diarahkan ke Google Drive untuk download
        </p>
    @endif

    <!-- Instructions -->
    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6">
        <div class="flex gap-3">
            <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div class="text-sm">
                <p class="font-semibold text-amber-800">Cara Install APK:</p>
                <ol class="text-amber-700 mt-1 list-decimal list-inside space-y-1">
                    <li>Download file APK</li>
                    <li>Buka file APK yang sudah didownload</li>
                    <li>Izinkan instalasi dari sumber tidak dikenal</li>
                    <li>Login dengan akun yang baru dibuat</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Back to Home -->
    <a href="{{ route('home') }}"
        class="w-full py-3 px-6 text-slate-600 font-medium rounded-xl flex items-center justify-center gap-2 border border-slate-200 hover:bg-slate-50 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke Beranda
    </a>

    <!-- Footer -->
    <p class="text-center text-slate-400 text-sm mt-8">
        &copy; {{ date('Y') }} LuhurCamp. All rights reserved.
    </p>

    <style>
        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 2s ease-in-out infinite;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const isDirectDownload = {{ $isDirectDownload ? 'true' : 'false' }};
            let countdown = 5;
            const countdownEl = document.getElementById('countdown');
            const countdownSection = document.getElementById('countdown-section');
            const downloadBtn = document.getElementById('download-btn');
            const downloadUrl = downloadBtn.href;

            const timer = setInterval(function () {
                countdown--;
                countdownEl.textContent = countdown;

                if (countdown <= 0) {
                    clearInterval(timer);
                    // Update countdown section to show download started
                    countdownSection.innerHTML = `
                        <div class="flex items-center justify-center gap-2 text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="font-semibold">${isDirectDownload ? 'Download dimulai!' : 'Membuka Google Drive...'}</span>
                        </div>
                        <p class="text-slate-500 text-sm mt-2">Jika tidak terbuka, klik tombol di bawah.</p>
                    `;
                    countdownSection.classList.remove('from-blue-50', 'to-indigo-50', 'border-blue-200');
                    countdownSection.classList.add('from-green-50', 'to-emerald-50', 'border-green-200');

                    // Trigger download
                    if (isDirectDownload) {
                        // Direct download via hidden link click
                        const a = document.createElement('a');
                        a.href = downloadUrl;
                        a.download = 'SkyCamp_luhurcamp-mobile-app.apk';
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                    } else {
                        // Open Google Drive in new tab
                        window.open(downloadUrl, '_blank');
                    }
                }
            }, 1000);
        });
    </script>
</x-layouts.guest>