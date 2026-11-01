# Pelaporan dan Pemantauan Kebakaran Hutan dan Lahan

Mini Project Proyek 3 Kasus B. Aplikasi web komunitas untuk melaporkan indikasi kebakaran hutan dan lahan, lalu laporan ditinjau oleh relawan dan diteruskan ke pihak terkait oleh koordinator.

## Identitas

- Nama: Muhamad Haikal Dwi Arya
- NIM: 251511018
- Kelas: D3-2A

## Fitur per Role

- Pelapor: membuat laporan dengan lokasi dan bukti, melihat dan mengubah laporan miliknya selama status masih baru.
- Relawan: melihat semua laporan, menulis catatan, mengubah status laporan, melihat rekap.
- Koordinator: melihat semua laporan, mencatat penerusan ke pihak terkait, mengelola data pihak terkait, melihat rekap.

## Kebutuhan

- PHP 8.3 atau lebih baru
- Composer
- MySQL (Laragon atau XAMPP)
- Git

## Instalasi

1. Clone repository

```
git clone https://github.com/haikaldwiaryaa/Pelaporan-dan-Pemantauan-Kebakaran-Hutan-dan-Lahan.git
cd Pelaporan-dan-Pemantauan-Kebakaran-Hutan-dan-Lahan
```

2. Install dependency

```
composer install
```

3. Salin file `.env.example` menjadi `.env`, lalu buat app key

```
copy .env.example .env
php artisan key:generate
```

## Database

1. Nyalakan MySQL, lalu buat database kosong

```
CREATE DATABASE db_karhutla;
```

2. Kalau username atau password MySQL berbeda, ubah `DB_USERNAME` dan `DB_PASSWORD` di file `.env`.

3. Jalankan migration dan seeder

```
php artisan migrate --seed
```

Kalau ingin mengulang data dari awal, jalankan `php artisan migrate:fresh --seed`.

4. Buat link storage supaya file bukti bisa dibuka

```
php artisan storage:link
```

## Menjalankan Aplikasi

```
php artisan serve
```

Buka `http://127.0.0.1:8000` di browser.

## Akun Demo

Semua akun memakai password `password`.

| Role        | Nama             | Username     |
| ----------- | ---------------- | ------------ |
| Pelapor     | Haikal           | xall         |
| Pelapor     | Daffa            | Angpaboy     |
| Relawan     | Andi Relawan     | relawan1     |
| Koordinator | Rina Koordinator | koordinator1 |
