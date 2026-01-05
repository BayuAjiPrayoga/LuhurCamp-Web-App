# Panduan Setup Firebase (Bahasa Indonesia)

Berikut adalah langkah-langkah lengkap untuk mendapatkan **Service Account** (Backend) dan **google-services.json** (Mobile).

## 1. Membuat Project Baru
1.  Buka [Firebase Console](https://console.firebase.google.com/).
2.  Klik **"Add Project"**.
3.  Beri nama project (misal: `LuhurCamp`).
4.  Matikan Google Analytics (opsional, biar cepat) dan klik **"Create Project"**.

## 2. Setup Authentication
1.  Di menu kiri, klik **Build** -> **Authentication**.
2.  Klik **"Get Started"**.
3.  Pilih tab **Sign-in method**.
4.  Klik **Google**, lalu aktifkan switch **Enable**.
5.  Pilih email support project, lalu klik **Save**.
6.  (Opsional) Aktifkan juga **Email/Password** jika ingin login biasa via Firebase nanti.

## 3. Setup Untuk Backend (Laravel)
Kita butuh file "Service Account" agar Laravel bisa berkomunikasi dengan Firebase.

1.  Klik icon **Gear (⚙️)** di samping "Project Overview", pilih **Project settings**.
2.  Pilih tab **Service accounts**.
3.  Scroll ke bawah, klik tombol biru **Generate new private key**.
4.  Klik **Generate key**.
5.  File JSON akan terdownload otomatis.
6.  **PENTING**: Rename file ini menjadi `firebase_credentials.json`.
7.  Simpan file ini di folder project Laravel: `storage/app/firebase_credentials.json`.

## 4. Setup Untuk Mobile (Flutter)
Kita butuh file konfigurasi agar aplikasi Android bisa connect.

1.  Kembali ke **Project settings** (tab General).
2.  Scroll ke bawah ke bagian "Your apps", klik icon **Android** (robot ijo).
3.  Isi **Android package name**:
    -   Buka project Flutter Anda: `android/app/build.gradle`.
    -   Cari `applicationId`, biasanya `com.example.arkanta_skycamp` (atau nama lain yang Anda set).
    -   Copy dan paste ke kolom package name di Firebase.
4.  (Opsional) Kolom "Debug signing certificate SHA-1" **WAJIB DIISI** agar Google Sign-In berfungsi saat development.
    -   Buka terminal di folder project Flutter.
    -   Ketik: `cd android` lalu `./gradlew signingReport` (Mac/Linux) atau `gradlew signingReport` (Windows).
    -   Cari baris `SHA1` di bagian `Variant: debug`.
    -   Copy kode SHA1 tersebut ke Firebase.
5.  Klik **Register app**.
6.  Klik **Download google-services.json**.
7.  Simpan file ini di folder project Flutter: `android/app/google-services.json`.

---

## Ringkasan File
Setelah langkah ini, pastikan Anda punya 2 file:
1.  **Backend**: `c:\laragon\www\LuhurCamp\storage\app\firebase_credentials.json`
2.  **Mobile**: `c:\laragon\www\LuhurCamp\arkanta_skycamp\android\app\google-services.json`

Selamat! Setup Firebase selesai. 🚀
