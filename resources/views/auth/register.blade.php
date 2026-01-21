<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - LuhurCamp</title>
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

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 30px 30px;
            pointer-events: none;
            z-index: 0;
        }

        .glow-1 {
            position: fixed;
            top: 10%;
            right: 20%;
            width: 400px;
            height: 400px;
            background: rgba(59, 130, 246, 0.25);
            border-radius: 50%;
            filter: blur(100px);
            z-index: 0;
        }

        .glow-2 {
            position: fixed;
            bottom: 10%;
            left: 10%;
            width: 300px;
            height: 300px;
            background: rgba(14, 165, 233, 0.2);
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(10, 22, 40, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
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
            text-decoration: none;
            color: white;
        }

        .logo-section img {
            height: 40px;
        }

        .logo-section span {
            font-weight: 700;
            font-size: 1.25rem;
            color: white;
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

        .main {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 100px 2rem 2rem;
        }

        .register-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            max-width: 1100px;
            width: 100%;
            align-items: center;
        }

        @media (max-width: 900px) {
            .register-container {
                grid-template-columns: 1fr;
            }

            .info-section {
                display: none;
            }
        }

        .info-section {
            padding-right: 2rem;
        }

        .info-section h1 {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .info-section h1 .gradient {
            background: linear-gradient(90deg, #60a5fa, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .info-section p {
            color: #94a3b8;
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 2rem;
        }

        .features {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: rgba(59, 130, 246, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .feature-text {
            color: #e2e8f0;
            font-weight: 500;
        }

        .form-section {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 2.5rem;
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-header h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: #94a3b8;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #e2e8f0;
            margin-bottom: 0.5rem;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3b82f6;
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .form-group input::placeholder {
            color: #64748b;
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(90deg, #2563eb, #3b82f6);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(59, 130, 246, 0.4);
        }

        .form-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #94a3b8;
        }

        .form-footer a {
            color: #60a5fa;
            text-decoration: none;
            font-weight: 600;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }

        .error-message ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .error-message li {
            margin-bottom: 4px;
        }

        .error-message li:last-child {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <div class="glow-1"></div>
    <div class="glow-2"></div>

    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo-section">
            <img src="{{ asset('images/logoskycamp.png') }}" alt="Logo">
            <span>LuhurCamp</span>
        </a>
        <a href="{{ route('login') }}" class="btn-outline">Login</a>
    </nav>

    <main class="main">
        <div class="register-container">
            <!-- Left: Info -->
            <div class="info-section">
                <h1>
                    Mulai Petualangan<br>
                    <span class="gradient">Camping Anda</span>
                </h1>
                <p>
                    Bergabunglah dengan ribuan camper lainnya. Daftar sekarang untuk menikmati kemudahan booking kavling
                    camping melalui aplikasi mobile kami.
                </p>
                <div class="features">
                    <div class="feature">
                        <div class="feature-icon">⛺</div>
                        <span class="feature-text">Booking kavling dengan mudah</span>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">🌤️</div>
                        <span class="feature-text">Cek cuaca lokasi real-time</span>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">📱</div>
                        <span class="feature-text">QR Code untuk check-in cepat</span>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">🎒</div>
                        <span class="feature-text">Sewa peralatan camping</span>
                    </div>
                </div>
            </div>

            <!-- Right: Form -->
            <div class="form-section">
                <div class="form-header">
                    <h2>Buat Akun Baru</h2>
                    <p>Isi form di bawah untuk mendaftar</p>
                </div>

                @if ($errors->any())
                    <div class="error-message">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="contoh@email.com" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">No. Telepon (Opsional)</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                            placeholder="08xxxxxxxxxx">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" required>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Ulangi password" required>
                    </div>

                    <button type="submit" class="btn-submit">Daftar Sekarang</button>
                </form>

                <div class="form-footer">
                    Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>