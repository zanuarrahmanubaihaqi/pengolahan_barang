# Sistem Informasi Klinik

| Laravel Version | Branch |
| --------------- | ------ |
| 7.0             | master |
| 6.0             | v6.0   |
| 5.8             | v5.8   |

## Requirements

-   PHP >= 7.2.5
-   BCMath PHP Extension
-   Ctype PHP Extension
-   JSON PHP Extension
-   Mbstring PHP Extension
-   OpenSSL PHP Extension
-   PDO PHP Extension
-   Tokenizer PHP Extension
-   XML PHP Extension

## Installation

-   Clone repository
-   Jalankan `composer install`
-   Rename or copy `.env.example` file to `.env`
-   Jalankan `php artisan key:generate`
-   Set koneksi database pada file `.env`
-   Jalankan `php artisan migrate`
-   Jalankan `php artisan db:seed`

## Note

-   Sebelum melakukan proses login mohon untuk merubah methode username() di file AuthenticatesUsers.php
    vendor/laravel/ui/auth-backend/AuthenticatesUsers.php
    return 'email' ubah ke return 'username'
-   Untuk menjalankan di environtment local jangan lupa jalankan `php artisan serve`
-   Akun admin : username -> admin & password -> passw0rd
