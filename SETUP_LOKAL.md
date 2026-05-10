# Setup Aplikasi Lokal dengan XAMPP

Panduan ini menjelaskan cara menjalankan Order Management System secara lokal menggunakan XAMPP tanpa Docker.

## Persyaratan

- **XAMPP** (dengan PHP 8.2+, MySQL, dan Apache) - Download dari https://www.apachefriends.org/
- **Composer** - Download dari https://getcomposer.org/
- **Node.js** (versi 16+) - Download dari https://nodejs.org/
- **Git** (opsional)

## Instalasi & Setup

### 1. Nyalakan XAMPP

```bash
# Buka XAMPP Control Panel
# Klik "Start" untuk Apache dan MySQL
```

Pastikan:
- Apache berjalan di port 80
- MySQL berjalan di port 3306

### 2. Buat Database

```bash
# Akses MySQL melalui phpMyAdmin
# http://localhost/phpmyadmin

# ATAU melalui command line:
mysql -u root -p
CREATE DATABASE order_management;
EXIT;
```

**Catatan:** Untuk XAMPP standar, password MySQL kosong (hanya ketik Enter)

### 3. Clone/Download Project

```bash
# Jika menggunakan Git
git clone <repository-url> order-management
cd order-management

# ATAU copy folder project ke direktori
cd order-management
```

### 4. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Build frontend assets
npm run build
```

### 5. Setup Environment

```bash
# Copy .env.example ke .env (sudah dikonfigurasi untuk XAMPP)
cp .env.example .env

# Jika file .env sudah ada dengan konfigurasi Neon DB, hapus dan copy ulang
# ATAU edit .env dengan konfigurasi berikut:
```

Buka `.env` dan pastikan konfigurasi database seperti ini:

```env
APP_ENV=local
APP_DEBUG=true
APP_KEY=base64:JM2gmVd1XGsGdRCkTPvrVhonXePVzODC1Eo9Ypp+wiY=
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=order_management
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Generate Application Key (jika belum)

```bash
php artisan key:generate
```

### 7. Jalankan Migrasi Database

```bash
php artisan migrate --force
php artisan permission:cache-reset
```

### 8. Setup Storage Link

```bash
php artisan storage:link --force
```

### 9. Jalankan Development Server

```bash
# Terminal 1 - Artisan Development Server
php artisan serve

# Buka: http://localhost:8000

# ATAU Terminal 2 - Vite Dev Server (untuk live reload)
npm run dev
```

Aplikasi akan tersedia di: **http://localhost:8000**

## Troubleshooting

### Error: "PDOException: could not find driver"
- Pastikan PHP MySQL extension sudah diaktifkan
- Edit `php.ini` di XAMPP, cari dan uncomment: `extension=pdo_mysql`

### Error: "Database connection refused"
- Pastikan MySQL sudah running di XAMPP
- Periksa konfigurasi DB_HOST, DB_PORT, DB_USERNAME, DB_PASSWORD di `.env`

### Error: "Class 'NeonPostgresConnector' not found"
- Class ini sudah dihapus dari AppServiceProvider
- Clear cache: `php artisan config:clear`

### Port 8000 sudah terpakai
```bash
# Jalankan dengan port berbeda
php artisan serve --port=8001
```

### NPM build error
```bash
# Clear node_modules dan reinstall
rm -rf node_modules package-lock.json
npm install
npm run build
```

## Commands yang Berguna

```bash
# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Fresh migration (HATI-HATI: menghapus data!)
php artisan migrate:fresh --force

# Seed database
php artisan db:seed

# Tinker console (interactive shell)
php artisan tinker

# List routes
php artisan route:list

# Queue work (jika menggunakan queue)
php artisan queue:work
```

## Catatan Penting

1. **Neon DB Connector Dihapus**: Class `NeonPostgresConnector` tidak lagi digunakan. Aplikasi sekarang menggunakan MySQL lokal.

2. **Docker Files**: File Docker (Dockerfile, docker-compose.yml) tetap ada untuk referensi. Jika ingin menggunakan Docker di masa depan, files ini masih tersedia.

3. **Environment Variables**: Pastikan `.env` tidak di-commit ke repository (sudah ada di `.gitignore`).

4. **PHP Version**: Pastikan XAMPP menggunakan PHP 8.2 atau lebih tinggi. Cek dengan `php --version`.

5. **Port Conflicts**: Jika port 8000 sudah digunakan, gunakan port lain dengan flag `--port`.

## Migrasi dari Docker

Jika sebelumnya menggunakan Docker, perubahan yang dilakukan:

- ✅ Database: `pgsql` (Neon) → `mysql` (XAMPP lokal)
- ✅ Host: `ep-quiet-moon-a1qjrh8u.ap-southeast-1.aws.neon.tech` → `127.0.0.1`
- ✅ Port: `5432` → `3306`
- ✅ Username: `neondb_owner` → `root`
- ✅ Password: `npg_9FTvfAhJ2EHO` → (kosong untuk XAMPP default)
- ✅ AppServiceProvider: NeonPostgresConnector binding dihapus

## Support

Untuk pertanyaan atau issue, silakan hubungi developer atau dokumentasi Laravel di https://laravel.com/docs.
