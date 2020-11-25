<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test admin can view all employees.
     *
     * @return void
     */
    public function testViewEmployees()
    {
        factory(\App\Company::class, 2)->create()->each(function($company){
            $company->employees()->createMany(factory(\App\Employee::class, 3)->make()->toArray());
        });

        $adminUser = factory(\App\User::class)->create();

        $this->be($adminUser);

        $response = $this->get('/employees');

        $data = $response->json();

        $this->assertCount(6, $data);
    }
}
