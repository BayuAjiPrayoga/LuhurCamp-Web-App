# 🏕️ LuhurCamp Web App - Project Context

> File ini berisi konteks proyek untuk membantu AI Agent memahami codebase dengan cepat.

---

## 📋 Ringkasan Proyek

**LuhurCamp Web App** adalah backend API + Admin Panel untuk sistem reservasi camping ground. Dibangun dengan Laravel 10 dan menyediakan:

-   RESTful API untuk aplikasi mobile Flutter
-   Web Admin Panel untuk pengelola camping ground
-   Sistem autentikasi dengan Laravel Sanctum
-   Integrasi Firebase Cloud Messaging (FCM) untuk push notification

---

## 🛠️ Technology Stack

| Layer             | Teknologi                        |
| :---------------- | :------------------------------- |
| Framework         | Laravel 10.x                     |
| Language          | PHP 8.1+                         |
| Database          | MySQL 8.0                        |
| Authentication    | Laravel Sanctum (API Token)      |
| Frontend Admin    | Blade + Tailwind CSS + Alpine.js |
| Build Tool        | Vite                             |
| Push Notification | Firebase Admin SDK               |
| Export            | Maatwebsite Excel, DomPDF        |
| QR Code           | Simple QRCode                    |

---

## 📁 Struktur Folder Penting

```
app/
├── Enums/                    # Enum untuk status (BookingStatus, UserRole, dll)
├── Exports/                  # Export Excel (BookingExport, PeralatanExport)
├── Http/
│   ├── Controllers/
│   │   ├── Api/              # ⭐ Controller untuk REST API (mobile app)
│   │   └── Admin/            # Controller untuk Web Admin Panel
│   ├── Requests/             # Form Request Validation
│   └── Resources/            # API Resources (JSON transformation)
├── Models/                   # Eloquent Models
├── Policies/                 # Authorization Policies
├── Repositories/             # Repository Pattern (opsional)
└── Services/                 # Business Logic Services

routes/
├── api.php                   # ⭐ Routes untuk REST API (prefix: /api/v1)
└── web.php                   # Routes untuk Web Admin

resources/views/
├── admin/                    # Blade views untuk Admin Panel
├── components/               # Blade Components
└── layouts/                  # Layout templates

database/
├── migrations/               # Database migrations
└── seeders/                  # Data seeders
```

---

## 🔑 Model & Relasi Utama

### User

-   `hasMany` Booking
-   `hasMany` Gallery
-   Role: `admin` | `user`

### Kavling (Camping Spot)

-   `hasMany` Booking
-   Fields: `nama`, `kapasitas`, `harga_per_malam`, `fasilitas`, `foto`, `status`
-   Status: `tersedia` | `tidak_tersedia` | `maintenance`

### Booking

-   `belongsTo` User, Kavling
-   `belongsToMany` Peralatan (pivot: `booking_peralatan` dengan `jumlah`)
-   Status flow: `pending` → `dikonfirmasi` | `ditolak` → `selesai` | `dibatalkan`
-   Fields: `tanggal_checkin`, `tanggal_checkout`, `total_harga`, `bukti_bayar`, `qr_code`

### Peralatan (Equipment)

-   `belongsToMany` Booking
-   Fields: `nama`, `harga_sewa`, `stok`, `kondisi`

### Pengumuman (Announcement)

-   Broadcast ke semua user via FCM topic

### Gallery

-   `belongsTo` User
-   Status: `pending` | `approved` | `rejected`

---

## 🌐 API Endpoints (Prefix: `/api/v1`)

### Authentication

| Method | Endpoint               | Deskripsi                   |
| :----- | :--------------------- | :-------------------------- |
| POST   | `/auth/register`       | Registrasi user baru        |
| POST   | `/auth/login`          | Login dengan email/password |
| POST   | `/auth/firebase-login` | Login via Google (Firebase) |
| POST   | `/auth/logout`         | Logout (revoke token)       |

### User

| Method | Endpoint          | Deskripsi                         |
| :----- | :---------------- | :-------------------------------- |
| GET    | `/user`           | Get current user profile          |
| PUT    | `/user`           | Update profile                    |
| PUT    | `/user/fcm-token` | Update FCM token untuk push notif |
| POST   | `/user/avatar`    | Upload avatar                     |

### Kavling

| Method | Endpoint              | Deskripsi                              |
| :----- | :-------------------- | :------------------------------------- |
| GET    | `/kavlings`           | List semua kavling                     |
| GET    | `/kavlings/{id}`      | Detail kavling                         |
| GET    | `/kavlings/available` | Kavling tersedia pada tanggal tertentu |

### Booking

| Method | Endpoint                      | Deskripsi          |
| :----- | :---------------------------- | :----------------- |
| GET    | `/bookings`                   | List booking user  |
| POST   | `/bookings`                   | Buat booking baru  |
| GET    | `/bookings/{id}`              | Detail booking     |
| POST   | `/bookings/{id}/upload-bukti` | Upload bukti bayar |
| POST   | `/bookings/{id}/cancel`       | Batalkan booking   |

### Peralatan, Gallery, Pengumuman

| Method | Endpoint      | Deskripsi               |
| :----- | :------------ | :---------------------- |
| GET    | `/peralatan`  | List peralatan          |
| GET    | `/galeri`     | List gallery (approved) |
| POST   | `/galeri`     | Upload foto ke gallery  |
| GET    | `/pengumuman` | List pengumuman         |

---

## 🔐 Authentication Flow

1. **Mobile App** mengirim request login ke `/api/v1/auth/login`
2. Backend memvalidasi credentials
3. Jika valid, generate **Sanctum Token** dan return ke mobile
4. Mobile menyimpan token di Secure Storage
5. Setiap request API, mobile mengirim header: `Authorization: Bearer {token}`
6. Middleware `auth:sanctum` memvalidasi token

---

## 📬 Push Notification (FCM)

### Konfigurasi

-   File credentials: `storage/app/firebase/firebase-credentials.json`
-   Service: `app/Services/FirebaseService.php`

### Trigger Notifikasi

| Event                | Target                 | Implementasi                 |
| :------------------- | :--------------------- | :--------------------------- |
| Booking dikonfirmasi | User (by FCM token)    | `BookingController@confirm`  |
| Booking ditolak      | User (by FCM token)    | `BookingController@reject`   |
| Pengumuman baru      | Topic: `announcements` | `PengumumanController@store` |

---

## ⚙️ Environment Variables Penting

```env
# Database
DB_DATABASE=luhurcamp
DB_USERNAME=root
DB_PASSWORD=

# App URL (untuk generate QR Code, dll)
APP_URL=https://your-domain.com

# Firebase (path ke credentials JSON)
FIREBASE_CREDENTIALS=firebase/firebase-credentials.json

# Sanctum (domain untuk SPA jika ada)
SANCTUM_STATEFUL_DOMAINS=localhost
```

---

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter BookingTest
```

---

## 📝 Konvensi Kode

1. **Controller API** → Return `ApiResource` atau `JsonResponse`
2. **Validation** → Gunakan `FormRequest` class
3. **Business Logic** → Taruh di `Services/` atau `Repositories/`
4. **Enum** → Gunakan PHP 8.1 Enum di `app/Enums/`
5. **Response Format**:
    ```json
    {
      "success": true,
      "message": "Pesan sukses",
      "data": { ... }
    }
    ```

---

## 🚀 Deployment

Proyek ini di-deploy ke **Railway** dengan konfigurasi:

-   File: `railway.json`, `Dockerfile`
-   Build: `docker/run.sh`
-   Web server: Nginx + PHP-FPM (Supervisor)

---

## 📂 File Dokumentasi Terkait

-   [docs/SRS.md](docs/SRS.md) - Software Requirement Specification
-   [docs/SDD.md](docs/SDD.md) - System Design Document
-   [docs/Technical_Spec.md](docs/Technical_Spec.md) - Technical Specification
-   [docs/Business_Logic.md](docs/Business_Logic.md) - Business Logic & Flowchart
-   [docs/Project_Plan.md](docs/Project_Plan.md) - Project Plan & Timeline

---

## 🔗 Repository Terkait

| Repository                                                               | Deskripsi            |
| :----------------------------------------------------------------------- | :------------------- |
| [LuhurCamp-Web-App](https://github.com/BayuAjiPrayoga/LuhurCamp-Web-App) | Backend ini          |
| [SkyCamp_Mobile](https://github.com/BayuAjiPrayoga/SkyCamp_Mobile)       | Mobile App (Flutter) |

---

_Last updated: January 2026_
