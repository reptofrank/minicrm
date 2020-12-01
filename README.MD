# MiniCRM

To start, clone repository

* git clone https://github.com/reptofrank/minicrm

## Install dependencies

```bash
composer install
```


## Environment Variables

```bash
cp .env.example .env
php artisan key:generate
```


## Setup DB

create database and set environment variables DB_DATABASE, DB_USERNAME and DB_PASSWORD

## Run Migrations

```bash
php artisan migrate
```

## Seed Database

```bash
php artisan db:seed
```



# Testing

create test database

```bash
cp .env.example .env .env.testing

php artisan key:generate --env=testing
```



set env vars for test DB

## Run Migrations for tests

```bash
php artisan migrate --env=testing
```


## Run Tests

```bash
php artisan test
```
