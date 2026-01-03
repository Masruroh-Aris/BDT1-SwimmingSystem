# Swimming Competition System (BDT-K1)

Sistem pendaftaran dan manajemen lomba renang berbasis web menggunakan Laravel 11.

## 📋 Prasyarat
Pastikan Anda telah menginstal:
- PHP >= 8.2
- Composer
- Node.js & NPM
- Git
- MySQL / MariaDB

## � Cara Instalasi (Clone dari GitHub)

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer lokal Anda:

### 1. Clone Repository
Buka terminal atau Git Bash, lalu jalankan perintah berikut:

```bash
git clone https://github.com/Masruroh-Aris/BDT1-SwimmingSystem.git
cd BDT1-SwimmingSystem
```

### 2. Install Dependencies (Backend)
Install library PHP yang dibutuhkan menggunakan Composer:

```bash
composer install
```

### 3. Install Dependencies (Frontend)
Install library JavaScript dan compile aset frontend:

```bash
npm install
npm run build
```

### 4. Konfigurasi Environment (.env)
Salin file `.env.example` menjadi `.env` dan generate application key:

```bash
cp .env.example .env
php artisan key:generate
```

Buka file `.env` di text editor Anda, lalu sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=
```
*Pastikan Anda telah membuat database kosong di MySQL dengan nama yang sesuai.*

### 5. Setup Database & Storage
Jalankan migrasi untuk membuat tabel database dan seeder (jika ada data awal), serta buat link storage untuk gambar:

```bash
php artisan migrate --seed
php artisan storage:link
```
*Catatan: Jika `php artisan storage:link` gagal, coba jalankan terminal sebagai Administrator/Run as Administrator.*

### 6. Jalankan Aplikasi
Jalankan server lokal Laravel:

```bash
php artisan serve
```

Aplikasi dapat diakses melalui browser di: `http://127.0.0.1:8000`

## 🔑 Akun Default (Seeder)
Jika Anda menjalanan seeder, berikut adalah akun default yang biasanya tersedia (sesuaikan dengan DatabaseSeeder.php):

- **Superadmin**: superadmin@gmail.com / password
- **Admin**: admin@gmail.com / password
- **Operator**: operator@gmail.com / password

## 🛠️ Fitur Utama
- **Multi-Role**: Superadmin, Admin, Operator, User (Club/School/Individu)
- **Pendaftaran Lomba**: Menggunakan QR Code / Form
- **Pembayaran**: Upload bukti transfer/QRIS dengan verifikasi Admin
- **Sertifikat**: Generate sertifikat otomatis untuk peserta
- **Manajemen Event**: Kelola meet, event (nomor lomba), dan hasil

## � Catatan Tambahan
- Untuk **Operator**, login melalui halaman khusus: `/login-operator`
- Jika gambar tidak muncul, pastikan `APP_URL` di `.env` sesuai dengan URL browser (misal `http://127.0.0.1:8000`).
