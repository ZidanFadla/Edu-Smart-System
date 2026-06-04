# Smart Edu System

**Smart Edu System** adalah aplikasi web berbasis Laravel yang dirancang untuk membantu proses pengelolaan nilai siswa secara terkomputerisasi. Sistem ini dibuat untuk memudahkan pihak sekolah dalam mengelola data siswa, data guru, data mata pelajaran, input nilai, perhitungan nilai akhir, penentuan status kelulusan, serta penyajian laporan hasil nilai siswa.

Aplikasi ini memiliki tiga jenis pengguna, yaitu **Admin**, **Guru**, dan **Siswa**. Setiap pengguna memiliki hak akses yang berbeda sesuai dengan perannya. Admin dapat mengelola seluruh data dan laporan, Guru dapat menginput serta memvalidasi nilai siswa, sedangkan Siswa dapat melihat nilai pribadi dan status kelulusannya.

## Fitur Utama

* Login dan autentikasi pengguna menggunakan Laravel Breeze.
* Hak akses berdasarkan role Admin, Guru, dan Siswa.
* Pengelolaan data siswa.
* Pengelolaan data guru.
* Pengelolaan data mata pelajaran.
* Input dan validasi nilai siswa.
* Perhitungan nilai akhir secara otomatis.
* Penentuan status kelulusan berdasarkan nilai akhir.
* Laporan hasil nilai siswa.
* Tampilan dashboard modern, minimalis, dan mudah digunakan.

## Hak Akses Pengguna

### Admin

Admin memiliki hak akses penuh untuk menambah, melihat, mengubah, dan menghapus data siswa, data guru, data mata pelajaran, serta data nilai. Admin juga dapat mengelola dan melihat laporan hasil nilai siswa.

### Guru

Guru dapat menginput nilai siswa, melihat rekap nilai, serta memvalidasi nilai siswa sesuai dengan mata pelajaran yang diampu.

### Siswa

Siswa hanya dapat melihat nilai pribadi, seperti nilai tugas, nilai UTS, nilai UAS, nilai akhir, serta status kelulusan.

## Rumus Perhitungan Nilai

Nilai akhir dihitung secara otomatis menggunakan rumus:

```text
Nilai Akhir = (30% × Nilai Tugas) + (30% × Nilai UTS) + (40% × Nilai UAS)
```

Ketentuan kelulusan:

```text
Nilai Akhir >= 70 = Lulus
Nilai Akhir < 70  = Tidak Lulus
```

## Tech Stack

* PHP
* Laravel
* Laravel Breeze
* MySQL
* Blade Template
* Tailwind CSS
* Laragon sebagai local development server
* Visual Studio Code sebagai text editor

## Struktur Sistem

Sistem ini menggunakan konsep **MVC (Model, View, Controller)** dari Laravel. Model digunakan untuk mengelola data dan relasi database, View digunakan untuk menampilkan halaman antarmuka, sedangkan Controller digunakan untuk mengatur proses request dan response. Selain itu, sistem juga menggunakan Middleware untuk membatasi akses pengguna berdasarkan role.

## Alur Menjalankan Program

### 1. Clone atau Download Project

Jika project berada di GitHub, clone repository dengan perintah berikut:

```bash
git clone https://github.com/username/smart-edu-system.git
```

Masuk ke folder project:

```bash
cd smart-edu-system
```

Jika project belum diupload ke GitHub, cukup buka folder project melalui Visual Studio Code.

### 2. Install Dependency Laravel

Jalankan perintah berikut untuk menginstall dependency Laravel:

```bash
composer install
```

### 3. Install Dependency Frontend

Karena project menggunakan Laravel Breeze dan Tailwind CSS, jalankan:

```bash
npm install
```

Kemudian jalankan build frontend:

```bash
npm run dev
```

### 4. Buat File Environment

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Jika menggunakan Windows dan command tersebut tidak berjalan, gunakan:

```bash
copy .env.example .env
```

### 5. Generate Application Key

Jalankan perintah berikut:

```bash
php artisan key:generate
```

### 6. Buat Database

Buka Laragon, lalu pastikan Apache/Nginx dan MySQL sudah berjalan.

Buat database baru melalui phpMyAdmin atau HeidiSQL dengan nama:

```text
smart_edu_system
```

### 7. Konfigurasi Database

Atur koneksi database pada file `.env` seperti berikut:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smart_edu_system
DB_USERNAME=root
DB_PASSWORD=
```

Jika MySQL kamu menggunakan password, isi bagian `DB_PASSWORD` sesuai password yang digunakan.

### 8. Jalankan Migration

Jalankan migration untuk membuat tabel di database:

```bash
php artisan migrate
```

Jika project sudah menyediakan seeder dan ingin langsung mengisi data awal, gunakan:

```bash
php artisan migrate --seed
```

Jika ingin menghapus semua tabel dan menjalankan ulang migration dari awal, gunakan:

```bash
php artisan migrate:fresh
```

Jika ingin reset database sekaligus menjalankan seeder, gunakan:

```bash
php artisan migrate:fresh --seed
```

### 9. Jalankan Server Laravel

Jalankan aplikasi Laravel dengan command berikut:

```bash
php artisan serve
```

Setelah itu buka browser dan akses:

```text
http://127.0.0.1:8000
```

### 10. Login ke Sistem

Jika seeder akun default sudah tersedia, gunakan akun berikut:

```text
Admin
Email    : admin@example.com
Password : password
```

```text
Guru
Email    : guru@example.com
Password : password
```

```text
Siswa
Email    : siswa@example.com
Password : password
```

Setelah login, pengguna akan diarahkan ke dashboard sesuai role masing-masing.

## Alur Penggunaan Sistem

1. Pengguna melakukan login ke sistem.
2. Sistem memeriksa role pengguna.
3. Admin dapat mengelola data siswa, guru, mata pelajaran, nilai, dan laporan.
4. Guru dapat menginput nilai, memvalidasi nilai, dan melihat rekap nilai.
5. Siswa dapat melihat nilai pribadi dan status kelulusan.
6. Sistem menghitung nilai akhir secara otomatis berdasarkan nilai tugas, UTS, dan UAS.
7. Sistem menentukan status kelulusan berdasarkan nilai akhir.
8. Laporan nilai dapat dilihat melalui menu laporan.

## Catatan Pengembangan

Project ini dibuat untuk kebutuhan pembelajaran dan dokumentasi tugas pengembangan aplikasi web. Sistem difokuskan pada fitur utama pengolahan nilai siswa, sehingga belum mencakup fitur lain seperti absensi, jadwal pelajaran, pembayaran, notifikasi, atau integrasi sistem akademik lainnya.

## Tujuan Project

Tujuan dari project ini adalah untuk membuat sistem pengolahan nilai siswa yang lebih terstruktur, cepat, dan akurat. Dengan adanya sistem ini, proses input nilai, validasi nilai, perhitungan nilai akhir, penentuan status kelulusan, serta pembuatan laporan dapat dilakukan dengan lebih mudah dan efisien.
