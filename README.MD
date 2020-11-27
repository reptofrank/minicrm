clone repository

composer install // to install dependencies


# Environment Variables

cp .env.example .env

php artisan key:generate

# Setup DB
create database and set env variables DB_DATABASE, DB_USERNAME and DB_PASSWORD

# Run Migrations
php artisan migrate







Testing


create test database

cp .env.example .env .env.testing

php artisan key:generate --env=testing

set env vars for test DB

# Run Migrations
php artisan migrate --env=testing

# Run Tests
php artisan test



















/**
     * Get employees belonging to another company
     */
    public function testNotGetAnotherCompanyEmployee()
    {
        list($firstComp, $secondComp) = factory(\App\Company::class, 2)->create();

        $firstComp->employees()->createMany(factory(\App\Employee::class, 3)->make()->toArray());

        $this->be($secondComp->user);

        $response = $this->get('/employees');

        $this->assertCount(0, $response->json());
    }
