Laravel Project Setup
Requirements

Make sure your system has the following installed:

PHP >= 8.1

Composer >= 2.x

MySQL or any supported database

Node.js & NPM (for frontend assets, if used)

Git (optional but recommended)

Installation

Clone the repository:

git clone https://github.com/isabekoviskandar/Tabib
cd your-project


Install PHP dependencies:

composer install

Copy .env.example to .env:

cp .env.example .env


Generate the application key:

php artisan key:generate

Database Setup

Create a new database in MySQL (or your chosen DB):

CREATE DATABASE your_database_name;


Update .env file with your database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password


Run migrations:

php artisan migrate


(Optional) Run seeders for sample data:

php artisan db:seed

Running the Application

Start the local development server:

php artisan serve


The application will be available at:

http://127.0.0.1:8000

Useful Artisan Commands

Clear cache:

php artisan cache:clear


Run migrations fresh:

php artisan migrate:fresh --seed


Create a new controller:

php artisan make:controller ExampleController


Create a new model with migration:

php artisan make:model Example -m

Deployment Notes

Set APP_ENV=production and APP_DEBUG=false in .env on production.

Run:

php artisan config:cache
php artisan route:cache
php artisan view:cache
