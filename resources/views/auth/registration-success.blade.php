<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Berhasil - LuhurCamp</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #0a1628 0%, #1e3a5f 50%, #0a1628 100%);
            color: white;
            overflow-x: hidden;
        }
        /* Dot pattern overlay */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 30px 30px;
            pointer-events: none;
            z-index: 0;
        }
        /* Glow effects */
        .glow-1 {
            position: fixed;
            top: 20%;
            left: 10%;
            width: 400px;
            height: 400px;
            background: rgba(59, 130, 246, 0.3);
            border-radius: 50%;
            filter: blur(100px);
            z-index: 0;
        }
        .glow-2 {
            position: fixed;
            bottom: 20%;
            right: 10%;
            width: 300px;
            height: 300px;
            background: rgba(14, 165, 233, 0.2);
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
        }
        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(10, 22, 40, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
        }
        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .logo-section img {
            height: 40px;
        }
        .logo-section span {
            font-weight: 700;
            font-size: 1.25rem;
        }
        .btn-outline {
            padding: 8px 20px;
            border: 1px solid #3b82f6;
            color: #60a5fa;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.3s;
        }
        .btn-outline:hover {
            background: rgba(59, 130, 246, 0.1);
        }
        /* Main content */
        .main {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 100px 2rem 2rem;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }
        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .mockup-section {
                display: none;
            }
        }
        /* Success badge */
        .success-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(34, 197, 94, 0.2);
            border: 1px solid rgba(34, 197, 94, 0.3);
            padding: 8px 16px;
            border-radius: 50px;
            margin-bottom: 1.5rem;
        }
        .success-badge svg {
            width: 20px;
            height: 20px;
            color: #22c55e;
        }
        .success-badge span {
            color: #4ade80;
            font-weight: 500;
            font-size: 0.875rem;
        }
        /* Heading */
        h1 {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1rem;
        }
        h1 .gradient {
            background: linear-gradient(90deg, #60a5fa, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .welcome-name {
            font-size: 1.25rem;
            color: #e2e8f0;
            margin-bottom: 0.5rem;
        }
        .welcome-email {
            color: #94a3b8;
            margin-bottom: 1.5rem;
        }
        .description {
            color: #94a3b8;
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 2rem;
            max-width: 500px;
        }
        /* Countdown */
        .countdown-box {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: rgba(59, 130, 246, 0.2);
            border: 1px solid rgba(59, 130, 246, 0.3);
            padding: 16px 24px;
            border-radius: 16px;
            margin-bottom: 2rem;
        }
        .countdown-box .spinner {
            width: 24px;
            height: 24px;
            border: 3px solid rgba(96, 165, 250, 0.3);
            border-top-color: #60a5fa;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .countdown-box .text {
            color: #93c5fd;
        }
        .countdown-box .number {
            font-size: 2rem;
            font-weight: 700;
            color: white;
        }
        /* Buttons */
        .buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        @media (max-width: 768px) {
            .buttons {
                justify-content: center;
            }
        }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 32px;
            background: linear-gradient(90deg, #2563eb, #3b82f6);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
        }
        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 40px rgba(59, 130, 246, 0.4);
        }
        .btn-primary svg {
            width: 24px;
            height: 24px;
        }
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 16px 32px;
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 500;
            font-size: 1.1rem;
            transition: all 0.3s;
        }
        .btn-secondary:hover {
            background: rgba(255,255,255,0.05);
        }
        .btn-secondary svg {
            width: 20px;
            height: 20px;
        }
        /* Mockup */
        .mockup-section {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .mockup-glow {
            position: absolute;
            width: 350px;
            height: 350px;
            background: rgba(59, 130, 246, 0.4);
            border-radius: 50%;
            filter: blur(80px);
        }
        .mockup-section img {
            position: relative;
            z-index: 10;
            max-width: 100%;
            max-height: 650px;
            width: auto;
            filter: drop-shadow(0 25px 50px rgba(0,0,0,0.5));
            animation: float 4s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .mockup-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .app-info {
            text-align: center;
            margin-top: 2rem;
            position: relative;
            z-index: 10;
        }
        .app-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
        }
        .app-founder {
            color: #94a3b8;
            font-size: 0.9rem;
        }
        .app-founder span {
            color: #60a5fa;
            font-weight: 600;
        }
        /* Features section */
        .features {
            position: relative;
            z-index: 10;
            padding: 80px 2rem;
            background: linear-gradient(180deg, rgba(10,22,40,0.8), rgba(30,58,95,0.9));
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .features-container {
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
        }
        .features h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .features .subtitle {
            color: #94a3b8;
            margin-bottom: 3rem;
        }
        .steps {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
        }
        @media (max-width: 768px) {
            .steps {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        .step {
            text-align: center;
        }
        .step-number {
            width: 60px;
            height: 60px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
            transition: transform 0.3s;
        }
        .step:hover .step-number {
            transform: scale(1.1);
        }
        .step h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .step p {
            color: #94a3b8;
            font-size: 0.875rem;
        }
        /* Footer */
        .footer {
            position: relative;
            z-index: 10;
            padding: 2rem;
            text-align: center;
            border-top: 1px solid rgba(255,255,255,0.1);
            background: rgba(10,22,40,0.95);
        }
        .footer p {
            color: #64748b;
            font-size: 0.875rem;
        }
        .success-message {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #4ade80;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <!-- Glow effects -->
    <div class="glow-1"></div>
    <div class="glow-2"></div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo-section">
            <img src="{{ asset('images/logoskycamp.png') }}" alt="Logo">
            <span>LuhurCamp</span>
        </div>
        <a href="{{ route('home') }}" class="btn-outline">Beranda</a>
    </nav>

    <!-- Main Content -->
    <main class="main">
        <div class="container">
            <!-- Left: Content -->
            <div class="content-section">
                <div class="success-badge">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Registrasi Berhasil!</span>
                </div>

                <h1>
                    Selamat Datang di<br>
                    <span class="gradient">LuhurCamp</span>
                </h1>

                @if(session('registered_user'))
                    <p class="welcome-name">Halo, <strong>{{ session('registered_user')['name'] }}</strong>! 🎉</p>
                    <p class="welcome-email">{{ session('registered_user')['email'] }}</p>
                @else
                    <p class="welcome-name">Akun Anda telah berhasil dibuat.</p>
                @endif

                <p class="description">
                    Akun Anda siap digunakan untuk melakukan booking kavling camping. Silakan install aplikasi di smartphone Anda, lalu login dengan email dan password yang telah didaftarkan untuk menikmati kemudahan reservasi kapan saja.
                </p>

                <!-- Countdown -->
                <div class="countdown-box" id="countdown-section">
                    <div class="spinner"></div>
                    <span class="text">Download otomatis dalam</span>
                    <span class="number" id="countdown">5</span>
                    <span class="text">detik</span>
                </div>

                @php
                    $localApkPath = 'downloads/SkyCamp_luhurcamp-mobile-app.apk';
                    $apkExistsLocally = file_exists(public_path($localApkPath));
                    $downloadUrl = $apkExistsLocally 
                        ? asset($localApkPath) 
                        : 'https://drive.google.com/file/d/1YHtHR5pU1Ug3XNpyxEp-vHu7Y3XQVSUZ/view?usp=sharing';
                    $isDirectDownload = $apkExistsLocally;
                @endphp

                <!-- Buttons -->
                <div class="buttons">
                    <a href="{{ $downloadUrl }}" id="download-btn" class="btn-primary" {{ $isDirectDownload ? 'download' : 'target="_blank"' }}>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download APK
                    </a>
                    <a href="{{ route('home') }}" class="btn-secondary">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>

            <!-- Right: Mockup -->
            <div class="mockup-section">
                <div class="mockup-container">
                    <div class="mockup-glow"></div>
                    <img src="{{ asset('images/mockup-hp.png') }}" alt="Sky Camp Mobile App">
                    <div class="app-info">
                        <p class="app-name">Sky Camp</p>
                        <p class="app-founder">Dibuat oleh: <span>Bayu Aji Prayoga</span> (Founder)</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Features Section -->
    <section class="features">
        <div class="features-container">
            <h2>Cara Install APK</h2>
            <p class="subtitle">Ikuti langkah-langkah berikut untuk menginstall aplikasi</p>
            
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Download APK</h3>
                    <p>Klik tombol download di atas</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Buka File APK</h3>
                    <p>Buka file yang sudah didownload</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Izinkan Instalasi</h3>
                    <p>Izinkan dari sumber tidak dikenal</p>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <h3>Login & Nikmati</h3>
                    <p>Gunakan akun yang baru dibuat</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} LuhurCamp. All rights reserved.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isDirectDownload = {{ $isDirectDownload ? 'true' : 'false' }};
            let countdown = 5;
            const countdownEl = document.getElementById('countdown');
            const countdownSection = document.getElementById('countdown-section');
            const downloadBtn = document.getElementById('download-btn');
            const downloadUrl = downloadBtn.href;

            const timer = setInterval(function() {
                countdown--;
                countdownEl.textContent = countdown;

                if (countdown <= 0) {
                    clearInterval(timer);
                    countdownSection.innerHTML = `
                        <span class="success-message">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            ${isDirectDownload ? 'Download dimulai!' : 'Membuka download...'}
                        </span>
                    `;
                    
                    if (isDirectDownload) {
                        const a = document.createElement('a');
                        a.href = downloadUrl;
                        a.download = 'SkyCamp_luhurcamp-mobile-app.apk';
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                    } else {
                        window.open(downloadUrl, '_blank');
                    }
                }
            }, 1000);
        });
    </script>
</body>
</html>