````markdown
# 📦 REST API Stock Management – Laravel 12

Proyek ini adalah RESTful API untuk manajemen stok produk menggunakan Laravel 12. Mendukung fitur user management, lokasi penyimpanan, mutasi stok (in/out), dan relasi produk–lokasi.

---

## 🚀 Fitur Utama

- Autentikasi dengan token (Bearer Token)
- CRUD Users, Products, Locations, Categories
- Relasi Many-to-Many produk & lokasi (dengan `stock`)
- Mutasi stok: masuk/keluar
- History mutasi per user dan per produk
- Dokumentasi Postman

---

## 📋 Spesifikasi Teknologi

- PHP >= 8.2
- Laravel 12.x
- Passport (autentikasi API token)
- MySQL atau PostgreSQL

---

## ⚙️ Cara Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/agungwahyu23/stock_management.git
cd stock-management
````

### 2. Install Dependency

```bash
composer install
```

### 3. Copy File `.env`

```bash
cp .env.example .env
```

### 4. Generate Key

```bash
php artisan key:generate
```

### 5. Atur Konfigurasi Database

Buka `.env` lalu sesuaikan bagian:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stock_db
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Jalankan Migrasi

```bash
php artisan migrate
```

### 7. (Opsional) Jalankan Seeder

```bash
php artisan db:seed
```

### 8. Jalankan Server

```bash
php artisan serve
```

Server berjalan di: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---
## 🚀 Menjalankan Project dengan Docker

1. **Clone Repository**
```bash
git clone https://github.com/username/laravel-stock-app.git
cd laravel-stock-app
```

2. **Copy .env**
```bash
cp .env.example .env
```
3. **Jalankan Docker**
```bash
docker-compose up -d --build
```
4. **Jalankan migrasi (opsional)**
```bash
docker exec -it laravel_app bash
php artisan migrate
```
5. **Akses di browser**
```bash
http://localhost:8000
```
---

## 🔐 Autentikasi

Semua endpoint (kecuali register & login) menggunakan token:

```
Authorization: Bearer {token}
```

---

## 📮 Dokumentasi API (Postman)

📄 Kamu dapat mengakses dokumentasi API lengkap di sini:
👉 [Lihat Dokumentasi di Postman](https://www.postman.com/agungwahyu23699/workspace/mypublicworkspace/collection/10654538-e738315d-c8b2-4a04-8399-4b134660fb07?action=share&source=copy-link&creator=10654538)

Jika ingin mengimpor ke Postman, gunakan link `Run in Postman` atau file `.json` koleksi.

---

## 📁 Struktur Folder Penting

* `app/Models/` – berisi model utama (`User`, `Product`, `Location`, `Mutation`, dsb)
* `app/Http/Controllers/` – berisi controller API
* `routes/api.php` – definisi route API
* `database/migrations/` – migrasi tabel
* `database/seeders/` – data dummy opsional

---

## 🧪 Testing API (Opsional)

Kamu dapat menggunakan Postman dan mencoba endpoint berikut:

* Login: `POST /api/login`
* Tambah Produk: `POST /api/products`
* Tambah Mutasi: `POST /api/mutations`
* Lihat Riwayat Mutasi Produk: `GET /api/products/{id}/mutations`

---