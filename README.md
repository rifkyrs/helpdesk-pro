# Helpdesk Pro - Sistem Pelaporan Tiket Terpusat

## 1. Deskripsi Proyek
**Helpdesk Pro** merupakan aplikasi berbasis web yang dikembangkan untuk mendukung proses pelaporan, pengelolaan, dan pemantauan tiket permasalahan (*issue tracking*) secara terpusat.

Aplikasi ini ditujukan untuk memudahkan pengguna dalam menyampaikan keluhan atau permintaan layanan, serta membantu tim pengelola IT support dalam menindaklanjuti, memonitor status, dan mendokumentasikan setiap tiket secara sistematis. Helpdesk Pro menyediakan fitur autentikasi pengguna, pembuatan tiket, pelacakan status tiket, serta dashboard ringkasan yang menampilkan kondisi tiket secara real-time.

---

## 2. Teknologi yang Digunakan

Aplikasi Helpdesk Pro dikembangkan dengan memanfaatkan teknologi open source yang teruji stabilitas dan reliabilitasnya, serta banyak diadopsi pada lingkungan sistem enterprise.

### 2.1 Arsitektur Aplikasi
*   **Jenis Aplikasi**: Web Application
    Helpdesk Pro diakses melalui web browser menggunakan protokol HTTP/HTTPS. Seluruh proses bisnis, autentikasi, validasi input, pengelolaan sesi, serta kontrol keamanan diimplementasikan dan dieksekusi pada sisi server (*server-side processing*) untuk keamanan terpusat.
*   **Software Design Pattern**: MVC (Model–View–Controller)
    Memisahkan logika bisnis, tampilan, dan pengelolaan data untuk meningkatkan keamanan dan struktur kode.
*   **System Architecture**: 3 Tier Architecture
    1.  **Presentation Layer**: Antarmuka pengguna (Web Browser).
    2.  **Application Layer**: Server aplikasi (Laravel + Apache) yang menangani logika bisnis.
    3.  **Data Layer**: Database PostgreSQL yang berfungsi sebagai penyimpanan data.

### 2.2 Technology Stack
Berikut adalah teknologi yang digunakan untuk membangun Helpdesk Pro:

| Komponen | Teknologi | Fungsi Teknis |
| :--- | :--- | :--- |
| **Backend Framework** | Laravel 9.x | Framework PHP berbasis MVC untuk routing, controller, & business logic |
| **Bahasa Pemrograman** | PHP >= 8.0 | Bahasa server-side untuk memproses request |
| **Web Server** | Apache HTTP Server | Menangani request HTTP/HTTPS |
| **Database** | PostgreSQL 17.0 | RDBMS untuk menyimpan data pengguna & tiket |
| **ORM** | Eloquent ORM | Abstraksi database & query builder |
| **Frontend** | HTML, CSS, JavaScript | Struktur dan interaksi antarmuka pengguna |
| **UI Framework** | Bootstrap 5 | Framework CSS untuk tampilan responsif |
| **Dependency Manager** | Composer | Mengelola library & dependency PHP |
| **File Storage** | Laravel Storage | Penyimpanan file lampiran yang aman (Private) |
| **OS** | Linux / Windows | Sistem operasi server tempat aplikasi dijalankan |

---

## 3. Fitur Aplikasi

### 3.1 Authentikasi Pengguna
*   **Login**: Mekanisme autentikasi aman digunakan untuk masuk ke sistem. Dilengkapi dengan validasi input dan perlindungan terhadap serangan brute-force.
*   **Forgot Password**: Fitur pemulihan akun yang memungkinkan pengguna mereset kata sandi melalui tautan yang dikirim ke email terdaftar.
*   **Sign Up**: Pendaftaran mandiri untuk pengguna baru. Password divalidasi kekuatannya dan dikonfirmasi ulang untuk mencegah kesalahan input.

### 3.2 Dashboard
Halaman utama yang menyajikan ringkasan aktivitas pengguna, seperti jumlah total tiket yang dibuat dan tiket yang masih berstatus terbuka (Open), serta akses cepat ke menu utama.

### 3.3 Daftar Tiket (Ticket List)
Menampilkan tabel seluruh tiket yang dimiliki pengguna. Dilengkapi dengan informasi ringkas (Judul, Status, Tanggal), fitur pencarian tiket, dan tombol aksi untuk melihat detail.

### 3.4 Detail Tiket
Halaman yang menampilkan informasi lengkap dari sebuah tiket, termasuk deskripsi permasalahan, metadata tiket, dan status terkini. Pengguna juga dapat mengunduh lampiran file jika ada.

### 3.5 Buat Tiket Baru
Formulir untuk melaporkan masalah baru. Pengguna wajib mengisi Subjek dan Deskripsi kejadian. Pengguna juga dapat menyertakan lampiran file (seperti screenshot atau dokumen log) untuk membantu analisis masalah.

---

## 4. Aspek Security yang Telah Dibangun

Aplikasi ini menerapkan prinsip *Security by Design* dengan detail sebagai berikut:

### A. Autentikasi dan Manajemen Sesi
1.  **Password Hashing**: Aplikasi tidak menyimpan password dalam bentuk teks asli. Menggunakan hashing **Bcrypt** yang kuat.
2.  **Secure Session Management**:
    *   `http_only = true`: Mencegah pembacaan session ID melalui XSS (JavaScript).
    *   `same_site = lax`: Memitigasi risiko serangan CSRF.
    *   `secure = true`: Mengamankan cookie pada transmisi HTTPS.
    *   **Regenerate ID**: Session ID diperbarui saat login untuk mencegah *Session Fixation*.
    *   **Invalidate on Logout**: Session dimatikan sepenuhnya saat pengguna logout.
3.  **CAPTCHA / Security Check**: Implementasi pengecekan (seperti soal matematika sederhana) pada form Login dan Registrasi untuk membedakan manusia dan bot.

### B. Validasi dan Sanitasi Input
1.  **Input Validation**: Semua input divalidasi secara ketat di sisi server (*Server-Side Validation*). Aturan mencakup tipe data, panjang karakter, format email, dan file MIME type.
2.  **Sanitasi Filename**: Nama file yang diunggah dibersihkan dari karakter spesial berbahaya untuk mencegah eksploitasi pada sistem file (*Path Traversal* atau *Double Extension*).

### C. Keamanan Upload File
1.  **Storage Isolation**: File lampiran disimpan di direktori privat (`storage/app/attachments`) yang **tidak dapat diakses langsung** melalui URL publik browser.
2.  **Secure Download**: Pengunduhan file dilayani melalui route khusus yang memverifikasi hak akses pengguna (apakah pengguna adalah pemilik tiket tersebut) sebelum mengirimkan file.

### D. Otorisasi dan Kontrol Akses
1.  **Ticket Ownership**: Logika otorisasi memastikan pengguna hanya dapat melihat dan mengakses tiket yang mereka buat sendiri. Akses ilegal ke tiket pengguna lain akan ditolak (Error 403 Forbidden).

### E. Perlindungan dari SQL Injection
1.  Interaksi dengan database sepenuhnya menggunakan **Eloquent ORM** dan **Parameter Binding**. Input pengguna tidak pernah digabungkan langsung (concatenated) ke dalam string query SQL.

### F. Perlindungan Cross-Site Scripting (XSS)
1.  Output data pada antarmuka menggunakan mekanisme **Blade Escaping** (`{{ $variable }}`). Karakter HTML berbahaya dikonversi menjadi entitas aman, sehingga script tidak dapat dieksekusi di browser pengguna.

### G. Perlindungan Cross-Site Request Forgery (CSRF)
1.  Setiap form perubahan data (POST/PUT/DELETE) dilindungi oleh token CSRF unik. Middleware Laravel memvalidasi token ini untuk memastikan permintaan berasal dari aplikasi yang sah.

### H. Audit Logging
1.  Setiap aktivitas kritis (seperti Login sukses, Pembuatan Tiket) dicatat ke dalam database `audit_logs`. Informasi yang dicatat meliputi User ID, Action, IP Address, dan User Agent untuk keperluan audit forensik.

---

## Cara Menjalankan Aplikasi

Berikut langkah-langkah untuk menjalankan aplikasi di lingkungan lokal (Apache/XAMPP):

### Prasyarat
*   PHP >= 8.0 (Pastikan ekstensi `pdo_pgsql` aktif jika menggunakan PostgreSQL)
*   Composer
*   PostgreSQL 17.0 (Pastikan service berjalan)
*   Node.js & NPM

### Langkah Instalasi
1.  **Persiapan Database**:
    *   Buat database baru di PostgreSQL, misalnya `helpdesk_db`.
2.  **Clone & Install Dependencies**:
    *   Masuk ke direktori proyek:
        ```bash
        cd c:\xampp\htdocs\minisecureapp
        ```
    *   Install library PHP:
        ```bash
        composer install
        ```
    *   Install library Frontend:
        ```bash
        npm install && npm run dev
        ```
3.  **Konfigurasi Environment**:
    *   Salin file konfigurasi:
        ```bash
        cp .env.example .env
        ```
    *   Buka file `.env` dan sesuaikan koneksi database (contoh untuk PostgreSQL):
        ```env
        DB_CONNECTION=pgsql
        DB_HOST=127.0.0.1
        DB_PORT=5432
        DB_DATABASE=helpdesk_db
        DB_USERNAME=postgres
        DB_PASSWORD=password_anda
        ```
4.  **Setup Aplikasi**:
    *   Generate App Key:
        ```bash
        php artisan key:generate
        ```
    *   Jalankan Migrasi Database:
        ```bash
        php artisan migrate
        ```
5.  **Akses Aplikasi**:
    *   Buka browser dan akses melalui URL Apache local Anda, misalnya:
        `http://localhost/minisecureapp/public`
