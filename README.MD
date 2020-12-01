# MiniCRM

To start, clone repository

* git clone https://github.com/reptofrank/minicrm

## Install dependencies

* composer install


## Environment Variables

cp .env.example .env

php artisan key:generate

## Setup DB

create database and set environment variables DB_DATABASE, DB_USERNAME and DB_PASSWORD

## Run Migrations

php artisan migrate

## Seed Database

* php artisan db:seed







# Testing

create test database

cp .env.example .env .env.testing

php artisan key:generate --env=testing

set env vars for test DB

## Run Migrations for tests

php artisan migrate --env=testing

## Run Tests

php artisan test