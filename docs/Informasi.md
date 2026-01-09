# Informasi Proyek LuhurCamp/SkyCamp

---

## 📦 Tech Stack

### Bahasa Pemrograman & Versi

| Bahasa | Versi |
|--------|-------|
| **PHP** | 8.3.27 |
| **Dart (Flutter)** | SDK ^3.10.4 |
| **Node.js** | 18.8.0 |

---

### Framework

| Komponen | Framework | Versi |
|----------|-----------|-------|
| **Backend (API & Admin Panel)** | Laravel | ^12.0 |
| **Mobile App** | Flutter | SDK ^3.10.4 |
| **Build Tool** | Vite | ^5.0.0 |
| **CSS Framework** | TailwindCSS | ^3.4.0 |

---

### Entry Point

| Komponen | File Entry Point |
|----------|------------------|
| **Laravel Backend** | `public/index.php` → `artisan` |
| **API Routes** | `routes/api.php` (prefix: `/api/v1/`) |
| **Web Routes** | `routes/web.php` (prefix: `/admin/`) |
| **Flutter Mobile** | `arkanta_skycamp/lib/main.dart` |
| **Vite Build** | `vite.config.js` |

---

### Dependencies Khusus

#### Backend (Laravel) - `composer.json`

| Paket | Versi | Fungsi |
|-------|-------|--------|
| `laravel/sanctum` | ^4.0 | API Authentication (Token-based) |
| `kreait/laravel-firebase` | ^6.2 | Firebase Integration (FCM Push Notification & Auth) |
| `barryvdh/laravel-dompdf` | ^3.1 | PDF Generation (Laporan) |
| `maatwebsite/excel` | ^3.1 | Excel Export (Laporan) |
| `simplesoftwareio/simple-qrcode` | ^4.2 | QR Code Generation (Booking Check-in) |

#### Frontend (Node.js) - `package.json`

| Paket | Versi | Fungsi |
|-------|-------|--------|
| `laravel-vite-plugin` | ^1.0.0 | Vite integration untuk Laravel |
| `tailwindcss` | ^3.4.0 | CSS utility framework |
| `autoprefixer` | ^10.4.16 | CSS autoprefixer |
| `postcss` | ^8.4.32 | CSS post-processing |
| `axios` | ^1.11.0 | HTTP client |
| `concurrently` | ^9.0.1 | Menjalankan multiple process |

#### Mobile (Flutter) - `pubspec.yaml`

| Paket | Versi | Fungsi |
|-------|-------|--------|
| `flutter_riverpod` | ^2.5.1 | State Management |
| `dio` | ^5.4.1 | HTTP Client |
| `go_router` | ^13.2.0 | Navigation/Routing |
| `shared_preferences` | ^2.2.2 | Local Storage |
| `flutter_secure_storage` | ^9.0.0 | Secure Token Storage |
| `firebase_core` | ^4.3.0 | Firebase Core |
| `firebase_auth` | ^6.1.3 | Firebase Authentication |
| `firebase_messaging` | ^16.1.0 | Push Notifications |
| `google_sign_in` | ^6.2.1 | Google Sign-In |
| `cached_network_image` | ^3.3.1 | Image Caching |
| `qr_flutter` | ^4.1.0 | QR Code Display |
| `flutter_animate` | ^4.5.2 | Animations |

---

## 🗄️ Detail Database (PostgreSQL)

### Konfigurasi

| Parameter | Nilai |
|-----------|-------|
| **DBMS** | PostgreSQL |
| **Versi** | 18.1 |
| **Host** | 127.0.0.1 (local) |
| **Port** | 5432 |
| **Database Name** | `luhurcamp` |
| **Username** | `postgres` |
| **Driver Laravel** | `pgsql` |

### Ekstensi

> Tidak ada ekstensi khusus yang terdeteksi. Database menggunakan fitur standar PostgreSQL.

### Ukuran Database

> Ukuran database tidak dapat diquery secara otomatis (memerlukan autentikasi psql interaktif). Jalankan query berikut untuk mendapatkan ukuran:
> ```sql
> SELECT pg_size_pretty(pg_database_size('luhurcamp'));
> ```

### Struktur Tabel (Migrations)

| File Migration | Tabel | Deskripsi |
|----------------|-------|-----------|
| `0001_01_01_000000_create_users_table.php` | `users` | User accounts |
| `0001_01_01_000001_create_cache_table.php` | `cache` | Cache storage |
| `0001_01_01_000002_create_jobs_table.php` | `jobs`, `job_batches`, `failed_jobs` | Queue jobs |
| `2025_12_30_000001_create_kavlings_table.php` | `kavlings` | Camping plots/kavlings |
| `2025_12_30_000002_create_peralatan_table.php` | `peralatan` | Equipment/peralatan |
| `2025_12_30_000003_create_bookings_table.php` | `bookings` | Booking reservations |
| `2025_12_30_000004_create_booking_items_table.php` | `booking_items` | Booking line items |
| `2025_12_30_000005_create_galleries_table.php` | `galleries` | User photo galleries |
| `2025_12_30_000006_create_announcements_table.php` | `announcements` | System announcements |
| `2025_12_30_180304_create_personal_access_tokens_table.php` | `personal_access_tokens` | Sanctum tokens |
| `2026_01_05_151818_add_firebase_columns_to_users_table.php` | `users` | Firebase UID & provider columns |
| `2026_01_06_093112_add_fcm_token_to_users_table.php` | `users` | FCM token column |

---

## ⚙️ Konfigurasi Environment (.env)

### Daftar Kunci Environment Variables

#### App Configuration
| Key | Deskripsi |
|-----|-----------|
| `APP_NAME` | Nama aplikasi |
| `APP_ENV` | Environment (local/production) |
| `APP_KEY` | Application encryption key |
| `APP_DEBUG` | Debug mode (true/false) |
| `APP_URL` | Base URL aplikasi |
| `APP_LOCALE` | Locale default |
| `APP_FALLBACK_LOCALE` | Fallback locale |
| `APP_FAKER_LOCALE` | Faker locale untuk seeding |
| `APP_MAINTENANCE_DRIVER` | Driver untuk maintenance mode |

#### Security
| Key | Deskripsi |
|-----|-----------|
| `BCRYPT_ROUNDS` | Bcrypt hashing rounds |

#### Logging
| Key | Deskripsi |
|-----|-----------|
| `LOG_CHANNEL` | Log channel (stack) |
| `LOG_STACK` | Stack log driver |
| `LOG_DEPRECATIONS_CHANNEL` | Deprecation log channel |
| `LOG_LEVEL` | Log level (debug/info/warning/error) |

#### Database
| Key | Deskripsi |
|-----|-----------|
| `DB_CONNECTION` | Database driver (pgsql) |
| `DB_HOST` | Database host |
| `DB_PORT` | Database port |
| `DB_DATABASE` | Nama database |
| `DB_USERNAME` | Database username |
| `DB_PASSWORD` | Database password |

#### Session & Cache
| Key | Deskripsi |
|-----|-----------|
| `SESSION_DRIVER` | Session driver (database) |
| `SESSION_LIFETIME` | Session lifetime (minutes) |
| `SESSION_ENCRYPT` | Session encryption |
| `SESSION_PATH` | Session cookie path |
| `SESSION_DOMAIN` | Session cookie domain |
| `CACHE_STORE` | Cache store (database) |

#### Queue & Broadcasting
| Key | Deskripsi |
|-----|-----------|
| `BROADCAST_CONNECTION` | Broadcast driver |
| `QUEUE_CONNECTION` | Queue driver (database) |
| `FILESYSTEM_DISK` | Default filesystem disk |

#### Redis (Optional)
| Key | Deskripsi |
|-----|-----------|
| `REDIS_CLIENT` | Redis client |
| `REDIS_HOST` | Redis host |
| `REDIS_PASSWORD` | Redis password |
| `REDIS_PORT` | Redis port |
| `MEMCACHED_HOST` | Memcached host |

#### Mail
| Key | Deskripsi |
|-----|-----------|
| `MAIL_MAILER` | Mail driver |
| `MAIL_SCHEME` | Mail scheme |
| `MAIL_HOST` | SMTP host |
| `MAIL_PORT` | SMTP port |
| `MAIL_USERNAME` | SMTP username |
| `MAIL_PASSWORD` | SMTP password |
| `MAIL_FROM_ADDRESS` | Default from address |
| `MAIL_FROM_NAME` | Default from name |

#### AWS (Optional)
| Key | Deskripsi |
|-----|-----------|
| `AWS_ACCESS_KEY_ID` | AWS access key |
| `AWS_SECRET_ACCESS_KEY` | AWS secret key |
| `AWS_DEFAULT_REGION` | AWS region |
| `AWS_BUCKET` | S3 bucket name |
| `AWS_USE_PATH_STYLE_ENDPOINT` | S3 path style |

#### External APIs
| Key | Deskripsi |
|-----|-----------|
| `OPENWEATHER_API_KEY` | OpenWeatherMap API key untuk cuaca |

#### Vite
| Key | Deskripsi |
|-----|-----------|
| `VITE_APP_NAME` | App name untuk Vite |

---

## 📁 Struktur Proyek

```
LuhurCamp/
├── app/                     # Laravel application code
├── arkanta_skycamp/         # Flutter mobile app
├── bootstrap/               # Laravel bootstrap
├── config/                  # Laravel configuration
├── database/                # Migrations & seeders
├── docker/                  # Docker configuration
├── docs/                    # Documentation
├── public/                  # Public assets
├── resources/               # Views, JS, CSS
├── routes/                  # API & Web routes
├── storage/                 # Storage & logs
├── tests/                   # PHPUnit tests
├── vendor/                  # Composer dependencies
├── node_modules/            # NPM dependencies
├── composer.json            # PHP dependencies
├── package.json             # Node dependencies
├── vite.config.js           # Vite configuration
├── tailwind.config.js       # TailwindCSS configuration
├── Dockerfile               # Docker build
├── railway.json             # Railway deployment
└── .env                     # Environment variables
```

---

*Dokumen ini dibuat pada: 07 Januari 2026*
