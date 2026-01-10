# Panduan Migrasi Hosting LuhurCamp (Web & Mobile)

Dokumen ini menjelaskan langkah-langkah yang harus dilakukan jika Anda ingin memindahkan Web App (Backend Laravel) ke provider hosting lain (misalnya dari Railway ke DigitalOcean, VPS lain, atau Shared Hosting cPanel) dan bagaimana memastikan Mobile App tetap terhubung.

## 📋 Konsep Dasar

Penting untuk diingat bahwa sistem Anda terdiri dari dua bagian terpisah:
1.  **Web App / Backend (Laravel)**: Ini adalah "otak" aplikasi. Menyimpan database, logika bisnis, dan menyediakan API.
2.  **Mobile App (Flutter)**: Ini adalah "tampilan" di HP pengguna. Ia TIDAK menyimpan data utama, melainkan "bertanya" ke Backend melalui **API URL**.

**Kunci Migrasi:** Saat Backend pindah "rumah" (hosting baru), Mobile App harus diberi tahu alamat barunya.

---

## 🛠️ Langkah 1: Migrasi Backend (Web App)

Langkah ini tergantung ke mana Anda akan pindah.

### Opsi A: Pindah ke VPS / Cloud Lain (Disarankan)
*Contoh: DigitalOcean, AWS, Google Cloud, atau VM lain.*

1.  **Push Kode Terbaru**: Pastikan semua perubahan lokal sudah ada di GitHub.
    ```bash
    git push origin main
    ```
2.  **Setup Server Baru**:
    *   Install **Docker** di server baru.
    *   Clone repositori GitHub Anda di sana.
    *   Atau gunakan fitur "App Platform" jika provider menyediakannya (mirip Railway).
3.  **Environment Variables (.env)**:
    *   Copy data dari `.env` lama atau Railway Variables.
    *   **PENTING**: Update `APP_URL` ke domain baru Anda (misal: `https://api-baru.luhurcamp.com`).
    *   Setup Database (PostgreSQL) di server baru dan masukkan kredensialnya ke `.env`.
4.  **Jalankan Aplikasi**:
    *   Gunakan Docker Compose atau script build yang sudah ada.
    *   Jalankan migrasi database: `php artisan migrate --force`.
    *   Jalankan seeder (jika perlu): `php artisan db:seed --force`.

### Opsi B: Pindah ke Koyeb + Supabase (Recommended for Scalability)
Koyeb adalah platform serverless modern (mirip Railway) yang sangat mendukung Docker. Supabase adalah penyedia PostgreSQL gratis yang excellent.

#### 1. Setup Database (Supabase)
Anda memiliki data koneksi berikut (dari URL `postgresql://postgres:kuyalumpat#@db.fakxeitcflcjwnwohkic.supabase.co:5432/postgres`):

- **DB_CONNECTION**: `pgsql`
- **DB_HOST**: `db.fakxeitcflcjwnwohkic.supabase.co`
- **DB_PORT**: `5432`
- **DB_DATABASE**: `postgres`
- **DB_USERNAME**: `postgres`
- **DB_PASSWORD**: `kuyalumpat#` (Hati-hati dengan karakter `#`, jika eror coba apit dengan kutip)

#### 2. Deploy ke Koyeb
1.  Login ke [Koyeb Dashboard](https://app.koyeb.com/).
2.  Create App -> pilih **GitHub**.
3.  Pilih repositori `LuhurCamp-Web-App`.
4.  **Builder**: Pilih **Docker**. (Jangan gunakan Buildpack karena kita sudah punya `Dockerfile` yang optimal).
5.  **Environment Variables**: Masukkan data berikut:
    ```env
    APP_NAME=LuhurCamp
    APP_ENV=production
    APP_DEBUG=false
    APP_URL=https://<nama-aplikasi-anda>.koyeb.app  
    
    # Database (Supabase)
    DB_CONNECTION=pgsql
    DB_HOST=db.fakxeitcflcjwnwohkic.supabase.co
    DB_PORT=5432
    DB_DATABASE=postgres
    DB_USERNAME=postgres
    DB_PASSWORD=kuyalumpat#
    
    # Lainnya
    LOG_CHANNEL=stderr
    ```
6.  Klik **Deploy**.

#### 3. Post-Deploy Setup
Setelah aplikasi statusnya "Healthy":
1.  Buka **Console/Terminal** di dashboard Koyeb.
2.  Jalankan perintah ini satu per satu:
    ```bash
    php artisan migrate --force
    php artisan db:seed --force
    php artisan storage:link
    ```

### Opsi C: Pindah ke Shared Hosting (cPanel)
*Catatan: Shared hosting biasanya lebih sulit untuk setup API modern, tapi bisa dilakukan.*

1.  **Upload File**:
    *   Compress folder project (kecuali `node_modules` dan `vendor`) ke ZIP.
    *   Upload ke File Manager cPanel.
2.  **Setup Database**:
    *   Buat database PostgreSQL/MySQL baru di cPanel.
    *   Import data dari database lama (jika ingin mempertahankan data).
3.  **Konfigurasi `.env`**:
    *   Sesuaikan `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
    *   Ubah `APP_URL` ke domain cPanel Anda.
4.  **Symlink Storage**:
    *   Anda mungkin perlu akses SSH terminal ke cPanel untuk menjalankan `php artisan storage:link` agar gambar bisa muncul.

---

## 📱 Langkah 2: Update Mobile App (Flutter)

Setelah Backend hidup di alamat baru, Mobile App **wajib** diupdate. Kalau tidak, ia akan terus "mengetuk pintu" alamat lama yang sudah kosong.

### 1. Ganti Base URL
Buka project Flutter Anda di VS Code. Cari file konfigurasi konstanta (biasanya di `lib/config/constants.dart` atau file `.env` di Flutter jika pakai).

Ganti URL lama dengan URL baru:

```dart
// SEBELUM (Lama - Contoh)
static const String baseUrl = "https://luhurcamp-web-app-production.up.railway.app/api/v1";

// SESUDAH (Baru - Contoh)
static const String baseUrl = "https://api-baru.luhurcamp.com/api/v1";
```

### 2. Test Koneksi (Debug)
Jalankan aplikasi di emulator/HP debug:
```bash
flutter run
```
Coba Login. Jika berhasil masuk, berarti koneksi ke "rumah baru" sukses.

### 3. Build Versi Rilis
Buat file APK/AAB baru untuk disebar ke pengguna.

```bash
# Untuk Android APK (disebar manual)
flutter build apk --release

# Untuk Google Play Store
flutter build appbundle --release
```

### 4. Distribusi
*   Kirim APK baru ke tim/klien Anda.
*   Minta mereka uninstall aplikasi lama dan install aplikasi baru ini.

---

## ✅ Checklist Migrasi

| Tahap | Aktivitas | Status |
| :--- | :--- | :--- |
| **Backend** | Backup Database Lama | `[ ]` |
| **Backend** | Deploy Kode ke Server Baru | `[ ]` |
| **Backend** | Set Environment Var (`.env`) di Server Baru | `[ ]` |
| **Backend** | Migrasi Database di Server Baru | `[ ]` |
| **Backend** | Verifikasi API `/health` di Server Baru (harus 200 OK) | `[ ]` |
| **Mobile** | Update `baseUrl` di Kodingan Flutter | `[ ]` |
| **Mobile** | Test Login & Fitur Utama di Mode Debug | `[ ]` |
| **Mobile** | Build APK Rilis Baru | `[ ]` |
| **Mobile** | Distribusi ke Pengguna | `[ ]` |

---

## 🆘 Troubleshooting Umum

**1. Gambar tidak muncul di Mobile App?**
*   Cek `APP_URL` di `.env` backend. Pastikan itu alamat domain, bukan `localhost`.
*   Jalankan `php artisan storage:link` di server backend.

**2. Login Gagal / API Error?**
*   Cek apakah `APP_KEY` di `.env` baru sama dengan yang lama? (Jika beda, session user akan reset).
*   Pastikan domain baru sudah support **HTTPS**. Android/iOS modern menolak koneksi HTTP biasa (tidak aman) secara default.

**3. "Not Found" saat akses API?**
*   Pastikan konfigurasi Web Server (Nginx/Apache) mengarahkan semua request ke `index.php` (Pretty URL).
