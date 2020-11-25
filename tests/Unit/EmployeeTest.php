<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetEmployees()
    {
        $employees = factory(\App\Company::class)->create()
            ->employees()->createMany(factory(\App\Employee::class, 3)->make()->toArray());
        
        $this->be($employees[0]->user);

        $response = $this->get('/employees');

        $response->assertStatus(403);
    }

    /**
     * Test to get own details.
     *
     * @return void
     */
    public function testGetSelf()
    {
        $employee = factory(\App\Company::class)->create()
            ->employees()->create(factory(\App\Employee::class)->make()->toArray());
        
        $this->be($employee->user);

        $response = $this->get('/employees/' . $employee->id);
        $data = $response->json();

        $response->assertOk();
        $this->assertEquals($employee->name, $data['name']);
    }

    /**
     * Test to get other employee details.
     *
     * @return void
     */
    public function testGetOtherEmployeeForbidden()
    {
        $employees = factory(\App\Company::class)->create()
            ->employees()->createMany(factory(\App\Employee::class, 2)->make()->toArray());
        
        $this->be($employees[0]->user);

        $response = $this->get('/employees/' . $employees[1]->id);

        $response->assertStatus(403);
    }

    /**
     * Test update self
     * 
     */
    public function testUpdateSelf()
    {
        $employee = factory(\App\Company::class)->create()
            ->employees()->create(factory(\App\Employee::class)->make()->toArray());
        
        $this->be($employee->user);

        $name = 'Updated Name';

        $response = $this->put('/employees/' . $employee->id, array_merge($employee->toArray(), ['name' => $name]));

        $updated = $response->json();
        
        $response->assertOk();

        $this->assertEquals($name, $updated['name']);
    }
}
