<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Company::class, 20)->create()->each(function($company){
            $company->employees()->createMany(factory(App\Employee::class, 3)->make()->toArray());
        });
    }
}
