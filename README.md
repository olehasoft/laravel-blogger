# Simple blog management system

This is a simple blog management system implementation powered by [Laravel 11](https://laravel.com/docs/11.x).

To run the project locally, you must have [PHP >= 8.2](https://laravel.com/docs/11.x/deployment#server-requirements) and [Composer](https://getcomposer.org/) installed.

Clone this repository and run the following commands in the project folder:

```sh
cp .env.example .env
touch database/database.sqlite

composer install
php artisan key:generate
php artisan migrate --seed

php artisan serve
```

The application should be available on `http://127.0.0.1:8000` address.
