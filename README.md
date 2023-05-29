## Requirements
- php 8.1 atau php 8.2

## Setup
- clone
- jalankan perintah ini diterminal : `composer install`
- `cp .env-example .env` copy paste file .env dari file .env.example
- `php artisan key:generate` generate key umum laravel untuk .env
- sesuaikan nilai database di .env
- `php artisan migrate` migrasi database
- `php artisan db:seed` generate users data
- `php artisan serve` start server

## Enkripsi nilai .env

- generate enkripsi 'localhost:8000/encrypt'.
- paste nilai enkripsi ke .env
- sebagai contoh , buka 'config/database.php'
- dekripsi nilai dari .env anda di file 'database.php' , sebagai contoh : `decryptStr(env('DB_CONNECTION'))`
