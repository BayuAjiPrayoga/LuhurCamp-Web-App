# Dokumen Sistem Manajemen Keamanan Informasi (ISMS) - LuhurCamp

## BAB I

### PENDAHULUAN

#### 1.1 Latar Belakang

LuhurCamp adalah platform manajemen reservasi perkemahan yang mengelola data sensitif, termasuk informasi pribadi pengguna, data transaksi pemesanan (_booking_), dan status ketersediaan kavling serta peralatan. Mengingat pentingnya integritas data dan ketersediaan layanan bagi operasional perkemahan, penerapan Sistem Manajemen Keamanan Informasi (SMKI/ISMS) menjadi krusial untuk melindungi aset informasi dari ancaman siber, kebocoran data, dan akses yang tidak sah. Dokumen ini disusun sebagai panduan strategis dan teknis dalam menjaga postur keamanan aplikasi LuhurCamp.

#### 1.2 Tujuan

Tujuan utama dokumen ISMS ini adalah:

1.  **Kerahasiaan (Confidentiality):** Memastikan data pengguna dan kredensial (seperti Firebase key) hanya dapat diakses oleh pihak yang berwenang.
2.  **Integritas (Integrity):** Menjamin keakuratan data pemesanan, stok peralatan, dan status pembayaran dari manipulasi yang tidak sah.
3.  **Ketersediaan (Availability):** Memastikan sistem LuhurCamp dapat diakses oleh pengguna dan administrator kapan saja dibutuhkan dengan downtime minimal.
4.  **Kepatuhan:** Memenuhi standar praktik terbaik pengembangan perangkat lunak yang aman (Secure Software Development Life Cycle).

#### 1.3 Ruang Lingkup

Ruang lingkup ISMS ini mencakup:

-   **Aplikasi Web & API:** Backend berbasis Laravel (framework PHP) dan API endpoints.
-   **Infrastruktur:** Konfigurasi server (Nginx), database, dan container (Docker).
-   **Manajemen Data:** Penyimpanan data pengguna, transaksi, dan aset file.
-   **Pengguna:** Administrator sistem dan pengguna akhir (User).

---

## BAB II

### Metodologi

#### 2.1 Identifikasi Aset dan Risiko

Langkah pertama adalah menginventarisasi aset kritis dan potensi risiko:

| Aset              | Deskripsi                                          | Risiko Utama                                                           |
| :---------------- | :------------------------------------------------- | :--------------------------------------------------------------------- |
| **Database**      | Menyimpan data user, booking, dan pembayaran.      | SQL Injection, Kebocoran Data, Ransomware.                             |
| **Source Code**   | Logika bisnis aplikasi LuhurCamp.                  | Kesenjangan keamanan (_bugs_), eksposur rahasia (_hardcoded secrets_). |
| **API Endpoints** | Jalur akses data untuk aplikasi frontend/mobile.   | Unauthorized Access, DDoS, Parameter Tampering.                        |
| **Kredensial**    | File `firebase_credentials.json`, `.env`.          | Pencurian identitas layanan, penyalahgunaan fasilitas cloud.           |
| **Server**        | Instance Docker/Hosting yang menjalankan aplikasi. | Port scanning, OS vulnerabilities.                                     |

#### 2.2 Implementasi Kontrol Keamanan

Kontrol keamanan diterapkan menggunakan pendekatan _defense-in-depth_:

-   **Autentikasi & Otorisasi:** Menggunakan **Laravel Sanctum** untuk manajemen token API dan pembagian peran (**UserRole Enum**: Admin, User).
-   **Network Security:** Konfigurasi Nginx untuk membatasi akses file sensitif dan menerapkan header keamanan.
-   **Validasi Input:** Seluruh input pengguna divalidasi ketat melalui _Form Requests_ Laravel untuk mencegah injeksi berbahaya.

#### 2.3 Audit Internal

Audit dilakukan secara berkala mencakup:

-   Static Application Security Testing (SAST) pada kode sumber.
-   Review konfigurasi server (Nginx, Docker).
-   Pemeriksaan manajemen dependensi (Composer).

#### 2.4 Evaluasi dan Dokumentasi

Hasil audit dievaluasi untuk menentukan tindakan perbaikan. Setiap insiden keamanan dan perubahan konfigurasi didokumentasikan untuk keperluan pelacakan dan audit di masa depan.

---

## BAB III

### IMPLEMENTASI

#### 3.1 Kontrol akses

Sistem menerapkan kontrol akses berbasis peran (RBAC):

1.  **Middleware Autentikasi:** Route sensitif dilindungi oleh middleware `auth:sanctum`.
    -   _Path:_ `routes/api.php`
    -   Aksi seperti `logout`, `updateProfile`, dan `booking` hanya bisa diakses user terautentikasi.
2.  **Pemisahan Peran:**
    -   Didefinisikan dalam `app/Enums/UserRole.php`.
    -   User biasa tidak memiliki akses ke fitur administratif (pengelolaan kavling/peralatan).
3.  **Endpoint Publik:** Endpoint informasi (`/kavlings`, `/announcements`) bersifat _read-only_ untuk publik, meminimalkan permukaan serangan.

#### 3.2 Backup data

Strategi backup mencakup:

-   **Database:** Dump terjadwal dari database MySQL/MariaDB yang tersimpan di volume Docker atau layanan managed database.
-   **Kode dan Konfigurasi:** Version control (Git) digunakan untuk seluruh source code. File `.env` dan kredensial (seperti `firebase_credentials.json`) **tidak** disertakan dalam repositori publik (masuk `.gitignore`).

#### 3.3 Enkripsi

1.  **Data at Rest (Data Disimpan):**
    -   Password pengguna di-hash menggunakan algoritma kuat (Bcrypt/Argon2) bawaan Laravel Authentication.
    -   Token API disimpa dalam bentuk hash di database.
2.  **Data in Transit (Data Dikirim):**
    -   Aplikasi diwajibkan berjalan di atas HTTPS (TLS).
    -   Nginx dikonfigurasi (`docker/nginx.conf`) untuk menyembunyikan versi server (`fastcgi_hide_header X-Powered-By`) dan mencegah _sniffing_ (`X-Content-Type-Options: nosniff`).

---

## BAB IV

### HASIL AUDIT INTERNAL

Berdasarkan analisis terhadap kode sumber `LuhurCamp`, berikut adalah temuan audit keamanan:

| No  | Area                 | Temuan                                                                                                                                                                                             | Tingkat Risiko | Status                   |
| :-- | :------------------- | :------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | :------------- | :----------------------- |
| 1   | **Konfigurasi CORS** | File `config/cors.php` mengizinkan `allowed_origins` => `['*']`. Ini terlalu permisif untuk produksi.                                                                                              | Medium         | **Perlu Perbaikan**      |
| 2   | **Debug Endpoint**   | Endpoint `/health` (di `routes/api.php`) menampilkan pesan error database mentah (`$e->getMessage()`) saat terjadi kegagalan koneksi. Ini bisa membocorkan struktur DB.                            | Low            | **Perlu Perbaikan**      |
| 3   | **Proteksi File**    | Konfigurasi Nginx (`docker/nginx.conf`) sudah memblokir akses ke file tersembunyi (`location ~ /\.(?!well-known).* { deny all; }`).                                                                | N/A            | **Aman** (Good Practice) |
| 4   | **Manajemen Secret** | `.gitignore` sudah mencakup `.env` dan `/storage/*.key`. Perlu dipastikan `firebase_credentials.json` di `storage/app/` juga ter-ignore (standar Laravel biasanya mengabaikan isi folder storage). | High           | **User Check Required**  |
| 5   | **Header Keamanan**  | Header `X-Frame-Options: SAMEORIGIN` sudah aktif di Nginx untuk mencegah serangan Clickjacking.                                                                                                    | N/A            | **Aman**                 |

---

## BAB V

### ANALISIS

Secara keseluruhan, arsitektur keamanan LuhurCamp dibangun di atas fondasi yang solid menggunakan standar industri Laravel framework.

-   **Kekuatan:** Penggunaan fitur bawaan framework yang aman (Sanctum, Eloquent ORM untuk cegah SQL Injection, Validasi Request). Struktur kode yang rapi dengan pemisahan _concern_ (Controller, Service, Repository) memudahkan audit. Penggunaan Docker mempermudah isolasi lingkungan.
-   **Kelemahan:** Konfigurasi default (seperti CORS) masih berorientasi pada kemudahan pengembangan (_development mode_) dan belum sepenuhnya diketatkan untuk produksi. Eksposur pesan error detail pada endpoint health check perlu ditangani agar tidak memberikan informasi kepada penyerang.

---

## BAB VI

### KESIMPULAN

Implementasi ISMS pada proyek LuhurCamp telah mencakup aspek-aspek fundamental keamanan informasi. Kontrol akses telah diterapkan melalui autentikasi token dan pembatasan peran. Infrastruktur server web (Nginx) telah dikonfigurasi dengan praktik keamanan dasar yang baik.

Untuk meningkatkan postur keamanan menuju lingkungan produksi, direkomendasikan untuk:

1.  Membatasi `allowed_origins` pada CORS hanya ke domain frontend yang sah.
2.  Menghapus detail pesan error database pada endpoint publik `/health` dan menggantinya dengan log internal.
3.  Memastikan prosedur backup database otomatis berjalan secara berkala.
4.  Melakukan pengujian penetrasi (Penetration Testing) sederhana sebelum peluncuran resmi.

Dengan menerapkan rekomendasi tersebut, LuhurCamp akan memiliki tingkat keamanan yang memadai untuk melindungi data pengguna dan operasional bisnisnya.
