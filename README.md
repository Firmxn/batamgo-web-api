# BatamGo Web API

API untuk Sistem Informasi Transportasi Publik yang dibangun dengan Laravel 12. Aplikasi ini menyediakan data rute, halte, dan bus beserta relasinya untuk kebutuhan integrasi klien (mobile/web).

## Fitur Utama

- Endpoint API untuk daftar rute, halte, dan bus.
- Relasi data rute–halte (many-to-many) dan rute–bus (one-to-many).
- Panel admin berbasis Filament (dependensi disiapkan).

## Teknologi

- PHP 8.2+
- Laravel 12
- Filament 3
- Vite + Tailwind CSS (untuk aset front-end)

## Prasyarat

- PHP 8.2+
- Composer
- Node.js + npm
- Database (MySQL/PostgreSQL/SQLite sesuai konfigurasi `.env`)

## Instalasi

1. Salin file environment dan sesuaikan konfigurasi database.
   ```bash
   cp .env.example .env
   ```
2. Install dependensi backend.
   ```bash
   composer install
   ```
3. Generate application key.
   ```bash
   php artisan key:generate
   ```
4. Jalankan migrasi database.
   ```bash
   php artisan migrate
   ```
5. Install dependensi frontend.
   ```bash
   npm install
   ```

## Menjalankan Aplikasi

- Jalankan server Laravel:
  ```bash
  php artisan serve
  ```
- Jalankan Vite (opsional untuk aset frontend):
  ```bash
  npm run dev
  ```
- Mode development lengkap (server, queue, log, vite):
  ```bash
  composer run dev
  ```

## Endpoint API

Base URL: `/api`

| Method | Endpoint | Deskripsi |
| --- | --- | --- |
| GET | `/transportasi/routes` | Daftar rute beserta halte terkait |
| GET | `/transportasi/shelters` | Daftar halte |
| GET | `/transportasi/buses` | Daftar bus beserta rute |
| GET | `/user` | Profil user terautentikasi (Sanctum) |

Contoh respons `GET /api/transportasi/routes`:
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "name": "Koridor 1",
      "description": "Pelabuhan - Bandara",
      "shelters": [
        {
          "id": 10,
          "name": "Shelter A",
          "latitude": "1.12345678",
          "longitude": "104.12345678",
          "address": "Jl. Contoh"
        }
      ]
    }
  ]
}
```

## Struktur Data Singkat

- **routes**: `name`, `description`
- **shelters**: `name`, `latitude`, `longitude`, `address`
- **buses**: `plate_number`, `route_id`, `capacity`, `departure_time`, `duration_in_minutes`, `arrival_time`
- **route_shelter**: pivot relasi rute–halte

## Testing

```bash
composer test
```

## Lisensi

Project ini menggunakan lisensi MIT.
