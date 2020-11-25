<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Get Company employees.
     *
     * @return void
     */
    public function testGetEmployees()
    {
        $company = factory(\App\Company::class)->create();

        $employees = $company->employees()->createMany(factory(\App\Employee::class, 3)->make()->toArray());

        $this->be($company->user);

        $response = $this->get('/employees');

        $data = $response->json();

        $this->assertCount(3, $data);
    }

    /**
     * Get employees belonging to another company
     */
    public function testNotGetAnotherCompanyEmployee()
    {
        $companies = factory(\App\Company::class, 2)->create();

        $companyOneEmployees = $companies[0]->employees()->createMany(factory(\App\Employee::class, 3)->make()->toArray());

        $this->be($companies[1]->user);

        $response = $this->get('/employees');

        $this->assertCount(0, $response->json());
    }


    public function testGetCompany()
    {
        $company = factory(\App\Company::class)->create();

        $response = $this->get('/companies/' . $company->id);

        $response->assertOk();
    }
}
