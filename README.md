# One Movies - Project Film (Laravel kelas XII)

Aplikasi web film berbasis Laravel dengan dua jenis pengguna.

## Aturan aplikasi

**User biasa**
1. Melihat list film yang tampil langsung di dashboard (`/`) dan halaman `/movies` (ada pencarian & filter genre).
2. Memberi komentar/kritik + rating pada film (halaman detail film).
3. Melihat dan mengubah halaman profil sendiri (`/profile`).

**User administrator**
1. CRUD data film, cast, genre & peran (`/admin`).
2. TIDAK bisa memberikan komentar pada film (dicek di tampilan dan di controller).
3. Melihat list data user (`/admin/users`, hanya lihat).

## Akun demo (password semua: `12345678`)
| Role  | Email             |
|-------|-------------------|
| Admin | admin@example.com |
| User  | user@example.com  |

## Cara menjalankan
```bash
cp .env.example .env
# atur koneksi database di .env (MySQL: DB_CONNECTION=mysql, DB_DATABASE, DB_USERNAME, DB_PASSWORD)
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```
Buka http://127.0.0.1:8000

Catatan:
- Gambar poster bawaan ada di `public/template/images` (tidak perlu disalin ke storage).
- Poster hasil upload admin disimpan di `public/uploads/posters`.
- Seeder mengisi: 19 genre, 50 cast, 128 film (dari `database/data/movies.csv`) beserta sinopsis, peran, 11 user, 1 admin, dan komentar.

## Struktur penting
- `app/Http/Middleware/AdminMiddleware.php` : membatasi halaman admin
- `app/Http/Controllers/Admin/*` : CRUD film, cast, genre, peran + list user
- `app/Http/Controllers/KritikController.php` : komentar (admin ditolak)
- `app/Http/Controllers/ProfileController.php` : profil sendiri
- `routes/web.php` : semua rute
