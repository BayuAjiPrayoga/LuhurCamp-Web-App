# LuhurCamp - Camping Ground Booking System

![LuhurCamp Logo](https://via.placeholder.com/150x150.png?text=LuhurCamp)

**LuhurCamp** adalah sistem manajemen reservasi _camping ground_ modern yang terdiri dari Aplikasi Mobile (untuk pelanggan) dan Panel Admin Web (untuk pengelola). Proyek ini bertujuan untuk mendigitalkan proses pemesanan kavling, penyewaan peralatan, dan operasional harian di lokasi camping.

---

## 📚 Dokumentasi Lengkap

Dokumen teknis detail tersedia terpisah:

-   **[SRS (Software Requirement Specification)](docs/SRS.md)**: Detail kebutuhan fungsional sistem.
-   **[SDD (System Design Document)](docs/SDD.md)**: Arsitektur sistem, ERD, dan Topologi.
-   **[Technical Specification](docs/Technical_Spec.md)**: Stack teknologi dan standar kode.
-   **[Business Logic](docs/Business_Logic.md)**: Alur bisnis, flowchart, dan logika sistem.
-   **[Project Plan](docs/Project_Plan.md)**: Timeline dan roadmap pengembangan.

---

## 🌟 Fitur Utama

### 📱 Mobile App (Pelanggan)

-   **Booking Mudah**: Pilih tanggal check-in/out dan lihat ketersediaan kavling secara _real-time_.
-   **Sewa Peralatan**: Tambahkan tenda, matras, dan alat masak langsung ke dalam pesanan.
-   **Manajemen Profil**: Ganti foto profil, update info data diri, dan ganti password.
-   **Riwayat Pesanan**: Pantau status booking (Pending, Menunggu Konfirmasi, Confirmed, Selesai).
-   **Upload Bukti Bayar**: Konfirmasi pembayaran manual dengan upload struk transfer.
-   **QR Code Ticket**: Dapatkan tiket masuk digital berupa QR Code setelah pembayaran diverifikasi.
-   **Galeri & Info**: Lihat foto-foto lokasi dan informasi terbaru.

### � Screenshots Mobile App

|                              Login/Register                              |                              Dashboard                              |
| :-------------------------------------------------------------: | :----------------------------------------------------------------: |
| ![Login](docs/img%20asset/Screenshot%202026-01-09%20221832.png) | ![Register](docs/img%20asset/Screenshot%202026-01-09%20221917.png) |

|                              Kavling                              |                              Peralatan                              |
| :------------------------------------------------------------: | :-----------------------------------------------------------------: |
| ![Home](docs/img%20asset/Screenshot%202026-01-09%20221953.png) | ![Dashboard](docs/img%20asset/Screenshot%202026-01-09%20222043.png) |

|                              Daftar Booking                              |                              Verifikasi                              |
| :--------------------------------------------------------------------: | :----------------------------------------------------------------------: |
| ![Kavling List](docs/img%20asset/Screenshot%202026-01-09%20222112.png) | ![Kavling Detail](docs/img%20asset/Screenshot%202026-01-09%20222254.png) |

|                              Galeri                              |                              Laporan                              |
| :--------------------------------------------------------------------: | :-------------------------------------------------------------------: |
| ![Booking Form](docs/img%20asset/Screenshot%202026-01-09%20222534.png) | ![My Bookings](docs/img%20asset/Screenshot%202026-01-09%20222558.png) |

|                              Profil                              |                              Pengumuman                              |
| :---------------------------------------------------------------: | :------------------------------------------------------------------: |
| ![Gallery](docs/img%20asset/Screenshot%202026-01-09%20222617.png) | ![Pengumuman](docs/img%20asset/Screenshot%202026-01-09%20222636.png) |

### �💻 Web Admin (Pengelola)

-   **Dashboard**: Ringkasan okupansi, pendapatan, dan booking terbaru.
-   **Manajemen Master Data**: CRUD Kavling (foto, harga) dan Peralatan (stok).
-   **Verifikasi Pembayaran**: Terima atau tolak bukti bayar pelanggan.
-   **Smart Scanner System**:
    -   Scan QR Code tamu untuk Check-in & Check-out.
    -   Optimized Camera View (Larger Scan Area).
    -   Support Re-scanning flow.
-   **Laporan**: Cetak laporan pendapatan dan tingkat hunian (PDF).
-   **Manajemen Galeri**: Moderasi foto yang diupload pengguna.

---

## 🛠️ Technology Stack

### Backend (API & Web Panel)

-   **Framework**: [Laravel 10](https://laravel.com)
-   **Language**: PHP 8.1+
-   **Database**: Posgresql
-   **Styling**: Tailwind CSS (via Vite)
-   **Auth**: Laravel Sanctum Session Cookie

### Frontend (Mobile App)

-   **Framework**: [Flutter](https://flutter.dev) (Dart 3.x)
-   **State Management**: Riverpod
-   **Routing**: GoRouter
-   **HTTP Client**: Dio

---

## 🚀 Cara Instalasi

### Prasyarat

-   PHP >= 8.1, Composer
-   Node.js & NPM
-   Flutter SDK
-   MySQL Server

### 1. Setup Backend (Laravel)

```bash
# Clone repository
git clone https://github.com/username/luhurcamp.git
cd luhurcamp

# Install dependencies
composer install
npm install && npm run build

# Setup Environment
cp .env.example .env
# Edit .env sesuaikan database DB_DATABASE, DB_USERNAME, dll.

# Generate Key & Migrate
php artisan key:generate
php artisan migrate --seed
php artisan storage:link

# Jalankan Server
php artisan serve --host=0.0.0.0 --port=8000
```

### 2. Setup Mobile App (Flutter)

> 📱 **Mobile App sekarang berada di repository terpisah:** [SkyCamp_Mobile](https://github.com/BayuAjiPrayoga/SkyCamp_Mobile)

```bash
# Clone repository mobile
git clone https://github.com/BayuAjiPrayoga/SkyCamp_Mobile.git
cd SkyCamp_Mobile

# Install dependencies
flutter pub get

# Konfigurasi API
# Buka lib/core/config/api_config.dart dan sesuaikan baseUrl dengan IP server Laravel.

# Jalankan App
flutter run
```

---

## 📂 Repository Terkait

| Repository                                                               | Deskripsi                         |
| :----------------------------------------------------------------------- | :-------------------------------- |
| [LuhurCamp-Web-App](https://github.com/BayuAjiPrayoga/LuhurCamp-Web-App) | Backend Laravel + Web Admin Panel |
| [SkyCamp_Mobile](https://github.com/BayuAjiPrayoga/SkyCamp_Mobile)       | Aplikasi Mobile Flutter           |

---

## 👥 Kontributor

-   **Tim Pengembang LuhurCamp**

---

© 2025 LuhurCamp. All Rights Reserved.
