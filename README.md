# SIAkad - Sistem Informasi Akademik

Dibuat oleh:
- **Rafi Akbar** - 24082010269
- **Faris Rasyid Setyono** - 24082010259
- **Savira Fitri Az Zahra** - 24082010227

---

## Deskripsi

SIAkad (Sistem Informasi Akademik) adalah aplikasi web untuk mengelola data mahasiswa secara digital. Aplikasi ini memungkinkan pengguna untuk menambah, mengubah, menghapus, dan melihat data mahasiswa, serta menampilkan statistik mahasiswa dalam bentuk grafik yang interaktif.

---

## Fitur

- Tambah data mahasiswa
- Ubah data mahasiswa
- Hapus data mahasiswa
- Daftar mahasiswa dalam bentuk tabel
- Grafik mahasiswa per Program Studi (Bar Chart)
- Grafik mahasiswa per Angkatan (Line Chart)
- Grafik mahasiswa lulus per Angkatan (Bar Chart)
- Grafik mahasiswa per Jenis Kelamin (Doughnut Chart)

---

## Tech Stack

| Teknologi | Kegunaan |
|---|---|
| Laravel 13 | Backend Framework |
| MySQL | Database |
| Tailwind CSS | Styling / UI |
| Alpine.js | Interaktivitas modal (tambah & edit) |
| Chart.js | Visualisasi grafik statistik |
| Vite | Build tool untuk asset |
| XAMPP | Local server (Apache + MySQL) |

---

## Cara Menjalankan

1. Clone repository ini
2. Install dependencies:
```bash
composer install
npm install
```
3. Copy file `.env`:
```bash
cp .env.example .env
php artisan key:generate
```
4. Import file `laravel.sql` ke database MySQL melalui phpMyAdmin
5. Sesuaikan konfigurasi database di file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
6. Jalankan aplikasi (2 terminal berbeda):
```bash
# Terminal 1
npm run dev

# Terminal 2
php artisan serve
```
7. Buka browser dan akses:
```
http://127.0.0.1:8000/student
```
