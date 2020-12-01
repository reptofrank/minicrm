# MiniCRM

To start, clone repository

* git clone https://github.com/reptofrank/minicrm

## Install dependencies

```bash
composer install
```


## Setup DB

Create database and set environment variables

```bash
cp .env.example .env

DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

## Generate app key

```bash
php artisan key:generate
```

## Run Migrations

```bash
php artisan migrate
```

## Seed Database

```bash
php artisan db:seed
```

# Frontend

Install dependencies and run dev build

```bash
npm install 
npm run dev
```

```bash
php artisan serve
```

Go to http://localhost:8000 to view site


# Testing

Create test database and set env vars for test DB in .env.testing

```bash
cp .env.example .env .env.testing

php artisan key:generate --env=testing
```

## Run Migrations for tests

```bash
php artisan migrate --env=testing
```


## Run Tests

```bash
php artisan test
```
