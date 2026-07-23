# AutoStock — Sistem Manajemen Inventaris Showroom Mobil

AutoStock adalah aplikasi web manajemen inventaris untuk showroom mobil, dibangun menggunakan Laravel 11. Aplikasi ini memungkinkan pengelolaan data unit mobil, tipe mobil, dealer/distributor, serta pencatatan transaksi stok masuk dan keluar secara real-time, dilengkapi dashboard statistik, export laporan PDF, dan REST API.

Dibuat sebagai tugas Ujian Akhir Semester (UAS) mata kuliah Pemrograman Web Lanjut.

## Identitas

- **Nama**: Denis Febriansyah
- **NIM**: 230170156
- **Program Studi**: Teknik Informatika, Universitas Malikussaleh

## Fitur Utama

- **Autentikasi & Verifikasi Email** — Login dan registrasi menggunakan Laravel Breeze, dengan verifikasi email aktif.
- **Role-Based Access Control** — Dua jenis pengguna dengan hak akses berbeda:
  - **Admin**: akses penuh (kelola Tipe Mobil, Dealer, Unit Mobil, edit/hapus transaksi).
  - **Staff**: dapat melihat data dan mencatat transaksi stok masuk/keluar, namun tidak dapat mengubah/menghapus data master.
- **CRUD Lengkap** — Pengelolaan data Tipe Mobil, Dealer/Distributor, dan Unit Mobil.
- **Manajemen Stok** — Pencatatan transaksi mobil masuk (dari dealer) dan keluar (terjual), dengan penyesuaian stok otomatis.
- **Dashboard** — Statistik ringkas (total unit, tipe mobil, dealer, nilai inventaris) dan grafik transaksi 7 hari terakhir menggunakan Chart.js.
- **Export Laporan PDF** — Unduh laporan daftar unit mobil dalam format PDF.
- **REST API** — Endpoint API (dengan autentikasi token Laravel Sanctum) untuk integrasi eksternal, teruji melalui Postman.
- **Responsive Design** — Tampilan menyesuaikan baik di desktop maupun perangkat mobile.

## Teknologi yang Digunakan

- **Framework**: Laravel 11
- **Autentikasi**: Laravel Breeze
- **Role & Permission**: Spatie Laravel Permission
- **Export PDF**: barryvdh/laravel-dompdf
- **REST API**: Laravel Sanctum
- **Frontend**: Blade, Tailwind CSS
- **Grafik**: Chart.js
- **Database**: MySQL (XAMPP)

## Cara Instalasi dan Menjalankan Aplikasi

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- XAMPP (MySQL & Apache)

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/missjok/autostock-showroom.git
   cd autostock-showroom
   ```

2. **Install dependency PHP**
   ```bash
   composer install
   ```

3. **Install dependency JavaScript**
   ```bash
   npm install
   ```

4. **Salin file environment**
   ```bash
   cp .env.example .env
   ```

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Buat database**
   
   Buat database baru bernama `db_inventaris` melalui phpMyAdmin (atau nama lain sesuai keinginan).

7. **Konfigurasi database di file `.env`**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_inventaris
   DB_USERNAME=root
   DB_PASSWORD=
   ```

8. **Jalankan migrasi dan seeder**
   ```bash
   php artisan migrate --seed
   ```
   
   Perintah ini akan membuat seluruh tabel database sekaligus akun demo (lihat bagian [Akun Demo](#akun-demo)).

9. **Build asset frontend**
   ```bash
   npm run build
   ```

10. **Jalankan server**
    ```bash
    php artisan serve
    ```

11. Buka browser dan akses `http://127.0.0.1:8000`

## Akun Demo

| Role  | Email                  | Password      |
|-------|-------------------------|----------------|
| Admin | admin@mobil.com         | mobilbaru18   |
| Staff | customer@mobil.com      | belimobil18   |


## Dokumentasi REST API

Base URL: `http://127.0.0.1:8000/api`

| Method | Endpoint         | Keterangan                          | Autentikasi |
|--------|-------------------|--------------------------------------|-------------|
| POST   | `/login`          | Login dan mendapatkan token akses    | Tidak       |
| POST   | `/logout`         | Logout (menghapus token aktif)       | Ya          |
| GET    | `/products`       | Menampilkan daftar unit mobil        | Ya          |
| POST   | `/products`       | Menambahkan unit mobil baru          | Ya          |
| GET    | `/products/{id}`  | Menampilkan detail unit mobil        | Ya          |
| PUT    | `/products/{id}`  | Memperbarui data unit mobil          | Ya          |
| DELETE | `/products/{id}`  | Menghapus unit mobil                 | Ya          |

Autentikasi menggunakan Bearer Token (Laravel Sanctum). Token diperoleh dari endpoint `/login`, kemudian disertakan pada header `Authorization: Bearer {token}` untuk mengakses endpoint yang memerlukan autentikasi.

## Dokumentasi Screenshot

> Screenshot berikut membuktikan seluruh fitur telah berjalan dengan baik.

### 1. Halaman Login & Autentikasi
![Login](docs/screenshot/Login_awal.png)

### 2. Verifikasi Email
![Verif Admin](docs/screenshot/Verif_admin.png)
![Verif Staff](docs/screenshot/Verif_staff.png)

### 3. Dashboard
![Dashboard Admin](docs/screenshot/Dashboard_Admin.png)
![Dashboard Admin](docs/screenshot/Dashboard_staff.png)

### 4. CRUD (Tipe Mobil, Dealer, Unit Mobil)
![CRUD](docs/screenshot/Tipe_Mobil.png)
![CRUD](docs/screenshot/Unit_Mobil.png)
![CRUD](docs/screenshot/Dealer.png)
![CRUD](docs/screenshot/Riwayat_Transaksi.png)

### 5. REST API — Pengujian di Postman
![REST API](docs/screenshot/Login_API.png)
![REST API](docs/screenshot/GET_Products.png)
![REST API](docs/screenshot/GET_TanpaToken.png)
![REST API](docs/screenshot/POST_Products.png)

### 6. Pemisahan Hak Akses Admin & Staff
![CRUD](docs/screenshot/Tipe_Mobil.png)
![CRUD](docs/screenshot/Unit_Mobil.png)
![CRUD](docs/screenshot/Dealer.png)
![CRUD](docs/screenshot/Riwayat_Transaksi.png)
![STAFF](docs/screenshot/TIPEMOBIL_STAFF.png)
![STAFF](docs/screenshot/DEALER_STAFF.png)
![STAFF](docs/screenshot/UNITMOBIL_STAFF.png)
![STAFF](docs/screenshot/RIWAYAT_STAFF.png)


### 7. Tampilan Responsive (Desktop & Mobile)
![Dashboard Admin](docs/screenshot/Dashboard_Admin.png)
![Dashboard Staff](docs/screenshot/mobile.jpeg)

### 8. Hasil Export PDF
![PDF](docs/screenshot/Export_PDF.png)

## Struktur Role & Hak Akses

| Fitur                     | Admin | Staff |
|----------------------------|:-----:|:-----:|
| Lihat data (Tipe Mobil, Dealer, Unit Mobil) | ✅ | ✅ |
| Tambah/Edit/Hapus data master | ✅ | ❌ |
| Lihat riwayat transaksi | ✅ | ✅ |
| Tambah transaksi (stok masuk/keluar) | ✅ | ✅ |
| Edit/Hapus transaksi | ✅ | ❌ |
| Export laporan PDF | ✅ | ✅ |
| Akses dashboard | ✅ | ✅ (data terbatas) |

## Lisensi

Project ini dibuat untuk keperluan akademik (Ujian Akhir Semester) dan tidak dimaksudkan untuk penggunaan komersial.
