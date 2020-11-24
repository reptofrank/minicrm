<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetEmployees()
    {
        $company = factory(\App\Company::class)->create();

        $employees = $company->employees()->createMany(factory(\App\Employee::class, 3)->make()->toArray());

        $company_user = $company->user;

        $this->be($company_user);

        $response = $this->get('/employees');

        $data = $response->json();

        // $this->be($company_user);
        $this->assertCount(3, $data);
    }
}
