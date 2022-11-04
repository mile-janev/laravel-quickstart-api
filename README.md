# Laravel Quickstart API Package

Laravel Quickstart API is a boilerplate for developing Laravel REST API with typical packages preinstalled and configured. It includes everything you need to start building REST API in Laravel. We tried to make it as minimal as possible.



# Installation
You have 2 option to setup the project:

## 1. Local server
### Requirements
- [Composer](https://getcomposer.org/download/)
- PHP 8.1+
- MySql 8.0+
- Node.js v16+

## 2. [Docker]((https://docs.docker.com/engine/install/)) + [Sail](https://laravel.com/docs/9.x/sail)
### Requirements:
- [Docker](https://docs.docker.com/engine/install/)
- [Composer](https://getcomposer.org/download/)


# Installation steps Local server

## 1. Execute the following commands to clone the project, setup environment file, install libraries and generate key:

Clone the project:
```bash
git clone https://github.com/mile-janev/laravel-quickstart-api.git
```
Navigate to the project:
```bash
cd laravel-quickstart-api
```
Copy environment file:
```bash
cp .env.example .env
```
Install libraries:
```bash
composer install
```
Generate app key:
```bash
php artisan key:generate
```

## 2. Create your local DB.

## 3. Update .env file according to your local server credentials.

## 4. Migrate the database, install passport and change caching folders permissions:

Migrate database:
```bash
php artisan migrate
```
Install Passport:
```bash
php artisan passport:install
```
Change caching folders permissions:
```bash
sudo chmod -R 777 storage && chmod -R 777 bootstrap/cache
```

## 5. Navigate to your [localhost project](http://localhost/laravel-quickstart-api/public/) or create [virtual host](https://httpd.apache.org/docs/2.4/vhosts/examples.html) 

# Installation steps Docker + Sail

## 1. Run Docker and execute the following commands in terminal to clone the project, setup environment file and install libraries:

```bash
git clone https://github.com/mile-janev/laravel-quickstart-api.git
cp .env.example .env
composer install
./vendor/bin/sail up
```

## 2. SSH into your server in different tab with:
```bash
./vendor/bin/sail root-shell
```

## 3. Generate artisan key and migrate the database:
```bash
php artisan key:generate
php artisan migrate
```

# Generating API documentation
Run the following command in terminal in order to regenerate the documentation
```bash
php artisan l5-swagger:generate
```


# Running tests
Tests are written using [PEST](https://pestphp.com/). You can run them using 
```bash
composer test:integration
or
composer test:unit
```

To run the coverage, make sure you have Xdebug 3 set up (v3 is super important, because v2 was super slow for code coverage).

In order to run code coverage
```bash
composer test:integration -- --coverage
```

# Libraries included in this package
- OpenAPI [Swagger](https://swagger.io/) [library](https://github.com/DarkaOnLine/L5-Swagger) with examples inside the code.
- [Passport](https://github.com/laravel/passport) Authentication;
- [Pest](https://github.com/pestphp/pest-plugin-laravel) Testing with examples inside the code;
- Laravel [Sail](https://github.com/laravel/sail);
- Github pipeline;
- APIs versioning sturucture;
- User Register, Login, Logout, Profile endpoints;
- [Codesniffer](https://github.com/squizlabs/php_codesniffer) for standards check;

# License

The Quickstart API is open-sourced software licensed under the  [MIT license](https://opensource.org/licenses/MIT).
