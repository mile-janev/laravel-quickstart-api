# D66 App

This is the repository containing the code for D66 API app. The app's main purpose is to help D66 to map all citizens and analyze their inclination to vote for them.

## Requirements

1. PHP 8.1+
2. MySql 8.0+
3. Node.js v 16+

## Development
You can setup local server and run the project, or you can use Docker container.
If you are using Docker, just type `./vendor/bin/sail up` or just `sail up` if you have configured an alias in terminal, and the app will be served on http://localhost/ (i.e. https://laravel.com/docs/9.x/sail)


Once you have the database set up, clone the repo and run

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Modify the `.env` file with correct database details. You can then run the migrations

```bash
php artisan migrate
```

You can also seed the dummy data

```bash
php artisan db:seed
```

## Running tests

In order to run the integration tests you'll need to set up sqlite database so that the tests will use an in memory database.

Tests are written using [PEST](https://pestphp.com/). You can run them using

```bash
composer test:integration
```

or `test:unit` for unit tests.

To run the coverage, make sure you have Xdebug 3 set up (v3 is super important, because v2 was super slow for code coverage).

In order to run code coverage run

```bash
XDEBUG_MODE=coverage composer test:integration -- --coverage
```

## Architecture

## Useful commands:
`./vendor/bin/sail shell` => to ssh into the project
`./vendor/bin/sail root-shell` => to ssh into the project as root
