# CRUD Member 

## 🛠 Instalasi & Setup

Ikuti langkah-langkah berikut untuk menjalankan project di local:

1. **Clone repository**

   ```bash
   git clone https://github.com/deni-akbar/laravel-member-api.git
   cd laravel-member-api
   ```

2. **Install dependensi composer**

    ```bash
    composer install
    ```

3.  **Setup Database**

    ```bash
    cp .env.example .env
    ```
    Sesuaikan dengan database anda

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database
    DB_USERNAME=user_database
    DB_PASSWORD=password_database
    ```
4. **Generate Key**

    ```bash
    php artisan key:generate
    ```
5. **Publish config JWT & generate secret**

    ```bash
    php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
    php artisan jwt:secret
    ```

6. **Jalankan migration dan seed db**

    ```bash
    php artisan migrate --seed
    ```
7. **Jalankan project**

    ```bash
    php artisan serve
    ```

8. **Test Api Import Collection Postman**

    ```bash
    member-api.postman_collection.json
    ```

9. **Route URL Akses UI**

    ```bash
    http://localhost:8000/users
    ```