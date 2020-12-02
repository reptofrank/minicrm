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

        $response = $this->get('/api/employees');

        $data = $response->json();

        $this->assertCount(3, $data['data']);
    }

    /**
     * Get employees belonging to another company
     */
    public function testNotGetAnotherCompanyEmployee()
    {
        list($firstComp, $secondComp) = factory(\App\Company::class, 2)->create();

        $firstComp->employees()->createMany(factory(\App\Employee::class, 3)->make()->toArray());

        $this->be($secondComp->user);

        $response = $this->get('/api/employees');

        $result = $response->json();

        $this->assertCount(0, $result['data']);
    }


    public function testGetCompany()
    {
        $company = factory(\App\Company::class)->create();
        
        $this->be($company->user);

        $response = $this->get('/api/companies/' . $company->id);

        $response->assertOk();
    }

    public function testPostNewEmployee()
    {
        $company = factory(\App\Company::class)->create();

        $employee = array(
            'name' => 'Mike Okafor', 
            'email' => 'mikeokafor88@gmail.com',
            'password' => '123456',
            'company' => $company->id
        );

        $this->be($company->user);

        $response = $this->post('/api/employees', $employee);

        $result = $response->json();

        $response->assertStatus(201);
        $response->assertHeader('Location');
        $this->assertEquals($employee['name'], $result['name']);
        $this->assertEquals($company->id, $result['company_id']);
        $this->assertArrayNotHasKey('password', $result);
    }

    /**
     * Delete own employee
     */
    public function testDeleteOwnEmployee()
    {
        $company = factory(\App\Company::class)->create();

        $employees = $company->employees()->createMany(factory(\App\Employee::class, 3)->make()->toArray());

        $this->be($company->user);

        $response = $this->delete('/api/employees/' . $employees[0]->id);

        $response->assertStatus(204);
    }

    /**
     * Delete other company's employee
     */
    public function testDeleteOtherCompanyEmployeeForbidden()
    {
        list($firstComp, $secondComp) = factory(\App\Company::class, 2)->create();

        $firstCompEmp = $firstComp->employees()->createMany(factory(\App\Employee::class, 3)->make()->toArray());

        $this->be($secondComp->user);

        $response = $this->delete('/api/employees/' . $firstCompEmp[0]->id);

        $response->assertStatus(403);
    }
}
