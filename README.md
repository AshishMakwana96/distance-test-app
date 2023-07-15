Project Install Steps
1) Setup Xampp Server (PHP Version 8.0 or higher) and Composer.
2) In the htdocs folder, Paste this folder.
3) Composer install
4) Add the databse details into .env file.
5) Run php artisan migrate command (Once setup .env file with database details)
6) Run php artisan server command

#Update DB details into .env file:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

