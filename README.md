# FlipPlay API

REST API untuk aplikasi **FlipPlay**, dikembangkan menggunakan Laravel sebagai bagian dari Praktikum Web Modul 4.

Proyek ini merupakan pengembangan dari simulasi FlipPlay berbasis terminal menjadi aplikasi berbasis REST API yang dapat mengelola data media dan koleksi media pengguna.

## Teknologi yang Digunakan

- PHP 8.2
- Laravel 12
- MySQL
- Composer
- Postman untuk pengujian API

## Fitur Utama

1. CRUD data media (Create, Read, Update, Delete).
2. Pencarian media berdasarkan judul.
3. Pengelolaan data pengguna.
4. Relasi many-to-many antara pengguna dan media.
5. Menambahkan media ke koleksi pengguna.
6. Melihat koleksi media pengguna.
7. Menghapus media dari koleksi pengguna.
8. Validasi input menggunakan Form Request.
9. Format respons API menggunakan API Resources.

## Struktur Relasi Database

Proyek ini menggunakan relasi **many-to-many** antara tabel `users` dan `media`, dengan tabel pivot `media_user`.

- Satu pengguna dapat memiliki banyak media dalam koleksinya.
- Satu media dapat dimiliki oleh banyak pengguna.
- Penghapusan data pengguna atau media akan menghapus relasi terkait pada tabel pivot.

## Persiapan dan Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/sasti006/flipplay-api.git
cd flipplay-api
```

### 2. Install Dependency

```bash
composer install
```

### 3. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`.

Pada Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Kemudian buat application key:

```bash
php artisan key:generate
```

### 4. Konfigurasi Database MySQL

Buat database dengan nama `flipplay` melalui phpMyAdmin.

Sesuaikan konfigurasi berikut pada file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=flipplay
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan username dan password jika konfigurasi MySQL berbeda.

### 5. Jalankan Migration

```bash
php artisan migrate
```

### 6. Jalankan Server Laravel

```bash
php artisan serve
```

API dapat diakses melalui:

```text
http://127.0.0.1:8000
```

## Daftar Endpoint API

Semua endpoint menggunakan prefix `/api`.

### A. Media

| Method | Endpoint | Fungsi |
|---|---|---|
| GET | `/api/media` | Menampilkan semua media |
| GET | `/api/media/{medium}` | Menampilkan detail media |
| POST | `/api/media` | Menambahkan media baru |
| PUT/PATCH | `/api/media/{medium}` | Mengubah data media |
| DELETE | `/api/media/{medium}` | Menghapus media |
| GET | `/api/media-search?search=judul` | Mencari media berdasarkan judul |

Pencarian juga dapat dilakukan melalui `/api/media?search=judul`.

Contoh JSON untuk menambahkan media:

```json
{
    "title": "Avengers Endgame",
    "type": "Movie",
    "genre": "Action",
    "release_year": 2019,
    "description": "Film superhero Marvel."
}
```

### B. User

| Method | Endpoint | Fungsi |
|---|---|---|
| GET | `/api/users` | Menampilkan semua pengguna |
| GET | `/api/users/{user}` | Menampilkan detail pengguna |
| POST | `/api/users` | Menambahkan pengguna baru |

Contoh JSON untuk menambahkan pengguna:

```json
{
    "name": "Sasti",
    "email": "sasti@example.com",
    "password": "password123"
}
```

### C. Koleksi Media Pengguna

| Method | Endpoint | Fungsi |
|---|---|---|
| POST | `/api/users/{user}/collection/{media}` | Menambahkan media ke koleksi |
| GET | `/api/users/{user}/collection` | Melihat koleksi media pengguna |
| DELETE | `/api/users/{user}/collection/{media}` | Menghapus media dari koleksi |

Contoh:

```text
POST /api/users/1/collection/1
```

Endpoint tersebut menambahkan media dengan ID 1 ke koleksi pengguna dengan ID 1.

## Validasi dan Penanganan Error

API menerapkan validasi untuk memastikan data yang dikirim sesuai ketentuan.

Beberapa contoh penanganan error:

| Status Code | Keterangan |
|---|---|
| 201 | Data berhasil dibuat |
| 404 | Data tidak ditemukan |
| 409 | Media sudah ada di koleksi pengguna |
| 422 | Data tidak memenuhi validasi |

Validasi media mencakup:
- Judul wajib diisi.
- Judul media harus unik.
- Jenis media wajib diisi.
- Genre wajib diisi.
- Tahun rilis harus berupa angka dan berada dalam rentang yang ditentukan.

## Pengujian API

Pengujian endpoint dilakukan menggunakan Postman dengan header:

```text
Accept: application/json
Content-Type: application/json
```

Pengujian mencakup:

1. Menambahkan pengguna baru.
2. Menambahkan media baru.
3. Menampilkan seluruh media.
4. Menampilkan detail media.
5. Mencari media berdasarkan judul.
6. Mengubah data media.
7. Menghapus media.
8. Menambahkan media ke koleksi pengguna.
9. Menampilkan koleksi pengguna.
10. Menghapus media dari koleksi.
11. Menguji validasi judul kosong dan judul duplikat.
12. Menguji penambahan media yang sudah ada di koleksi.
13. Menguji penghapusan media yang tidak ada di koleksi.
14. Menguji akses ke data yang tidak ditemukan.

## Repository

GitHub: https://github.com/sasti006/flipplay-api

---

**FlipPlay API — Praktikum Web Modul 4**