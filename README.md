# Laravel-Absensi

Projek ini merupakan program absensi yang dapat mencatat rekapan absensi siswa atau pegawai secara online, 
didalamnya disediakan 2 role yaitu user dan admin. User dapat melakukan presensi sesuai jadwalnya dan 
Admin dapat mengelola waktu absen hari libur dan melihat catatan kehadiran user.

### Dibuat dengan

Program ini dibuat dengan 
* [Laravel 8](https://laravel.com)
* [Bootstrap](https://getbootstrap.com)
* [JQuery](https://jquery.com)

## Memulai proyek

Instruksi untuk memulai proyek

### Instalasi

1.Clone proyek dari github git 

2.Jalankan composer install
   ```sh
   composer install
   ```
3.Salin .env.example .env

4.Jalankan php artisan key:generate
   ```sh
   php artisan key:generate
   ```
5.Jalankan php artisan migrate
   ```sh
   php artisan migrate
   ```
6.Jalankan php artisan db:seed
   ```sh
   php artisan db:seed
   ```
7.Jalankan php artisan serve
   ```sh
   php artisan serve
   ```
8. Selesai

