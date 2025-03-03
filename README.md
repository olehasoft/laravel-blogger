# Simple blog management system

This is a simple blog management system implementation powered by [Laravel](https://laravel.com/).

To run the project locally, clone this repository and run the following commands in the project folder:

```sh
cp .env.example .env
touch database/database.sqlite

composer install
php artisan key:generate
php artisan migrate --seed

php artisan serve
```

The application should be available on `http://127.0.0.1:8000` address.
