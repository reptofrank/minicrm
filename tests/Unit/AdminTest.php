<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Get all users 
     */
    public function testViewAllUsers()
    {
        factory(\App\Company::class, 3)->create()->each(function($company){
            $company->employees()->createMany(factory(\App\Employee::class, 5)->make()->toArray());
        });

        $adminUser = factory(\App\User::class)->create();

        $this->be($adminUser);

        $response = $this->get('/users');

        $data = $response->json();

        $response->assertOk();
        $this->assertCount(19, $data);
    }
}
