<h1 align="center">BukuJadul-App</h1>

This app is created by me as personal project portofolio. This app like selling an old book to people who wants to find limited edition classic book that not sell in any marketplace that they know.

## Built With

[![Laravel 7](https://img.shields.io/badge/Laravel-7.x-red.svg?style=rounded-square)](https://laravel.com/docs/7.x)
[![Vue 2](https://img.shields.io/badge/Vue-2.x-green.svg?style=rounded-square)](https://vuejs.org/guide/introduction.html)
[![MariaDB](https://img.shields.io/badge/MariaDB-v.11.x-orange.svg?style=rounded-square)](https://mariadb.org/download/)


## Requirements

1. Laravel (version 7)
2. Vue 2
3. Postman
4. Web Server (ex. localhost)
5. MariaDB / MySQL Database

## How to run the app ?

1. Clone this github repository
2. Open app's directory in CMD or Terminal
3. Type `composer install` to install composer on directory
4. Make new file a called **.env**, set up first [here](#set-up-env-file) then copy the content from `.env.example` file
5. Generate key app by type `php artisan key:generate` in directory with terminal
6. Migrate table from project by type `php artisan migrate` in directory with terminal
7. Open Postman desktop application or Chrome web app extension that has installed before
8. Choose HTTP Method and enter request url.(ex. localhost:3000/)
9. You can see all the end point [here](https://documenter.getpostman.com/view/14780095/2sAYJ6Ayk4)
10. Type `php artisan serve` to activated the server.

## Set up .env file

Open .env file on your favorite code editor, and copy paste this code below :

```
DB_CONNECTION=[DATABASE_CONNECTION]
DB_HOST=[DATABASE_HOST]
DB_PORT=[DATABASE_PORT]
DB_DATABASE=[DATABASE_NAME]
DB_USERNAME=[DATABASE_USERNAME]
DB_PASSWORD=[DATABASE_PASSWORD]
```

For `DATABASE_CONNECTION`, it's based on your database that using on your local server (for example: 'mysql').

## Feature

1. Backend
    1. Login and Register API
    2. Admin API :
        1. Users
        2. Books
        3. Books Category
        4. Carts
        5. Invoice
        6. Payment
        7. Balance Payment   
    3. Users API :
        1. Users
        2. Books
        3. Books Category
        4. Carts
        5. Invoice
        6. Payment
        7. Balance Payment 

2. Frontend
Coming Soon..

## License

© [MIT license](https://opensource.org/licenses/MIT)
© [Muhammad Akbar Saladin Siregar](https://github.com/akbarsaladin36/)


