# UTS Rekayasa Web — GOWES Rental Sepeda

Aplikasi web frontend **Rental Sepeda** (tema NIM akhir 6) menggunakan Laravel, Blade Template, dan Bootstrap.

|             |                                             |
| ----------- | ------------------------------------------- |
| Nama        | Rizky Yulianto                              |
| NIM         | 251011701206                                |
| Kelas       | SIFM003                                     |
| Mata Kuliah | Rekayasa Web                                |
| Dosen       | Afif Efendi                                 |
| Kampus      | Universitas Pamulang — Sistem Informasi S-1 |

## Fitur

- Halaman beranda, daftar sepeda (filter tipe + pencarian merek), dan detail sepeda
- Data sepeda berasal dari **migration + seeder** (tabel `bikes`)
- Layout Blade (`@extends`, `@section`, `@include`) dan Bootstrap lokal (`public/Bootstrap`)
- Gambar produk di `public/assets/images/`

## Struktur tabel `bikes`

`id, brand, type, rent_price, gear_count, image, available`

## Cara menjalankan

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Buat database `db_uts_251011701206` terlebih dahulu, lalu buka http://127.0.0.1:8000
