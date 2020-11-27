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

        $response = $this->get('/admin/users');

        $data = $response->json();

        $response->assertOk();
        $this->assertCount(19, $data);
    }

    public function testCreateCompany()
    {
        $adminUser = factory(\App\User::class)->create();

        $this->be($adminUser);

        $company = [
            'name' => 'Jobberman',
            'email' => 'info@jobberman.com',
            'password' => 'Tomorrow',
            'url' => 'https://www.jobberman.com',
            'logo' => 'https://www.jobberman.com/images/logo.png'
        ];

        $response = $this->post('/companies', $company);

        $data = $response->json();

        $response->assertStatus(201);
        $response->assertHeader('Location');
        $this->assertArrayHasKey('name', $data);
        $this->assertArrayHasKey('user_id', $data);
        $this->assertArrayNotHasKey('email', $data);
    }

    public function testUpdateCompany()
    {
        $adminUser = factory(\App\User::class)->create();
        
        $company = factory(\App\Company::class)->create();

        $company->name = $newName = 'Edison Electrical';

        $this->be($adminUser);

        $response = $this->put('/companies/' . $company->id, $company->toArray());
        $data = $response->json();
        $response->assertOk();
        $this->assertEquals($newName, $data['name']);
    }

    public function testAddAdminUser()
    {
        $adminUser = factory(\App\User::class)->create();
        $user = [
            'email' => 'admin@minicrm.com',
            'password' => 'Yesterday'
        ];

        $this->be($adminUser);

        $response = $this->post('/admin/users', $user);

        $response->assertStatus(201);

        $data = $response->json();

        $this->assertEquals($user['email'], 'admin@minicrm.com');
        $this->assertEquals('admin', $data['role']);
    }

    public function testDeleteUser()
    {
        $adminUser = factory(\App\User::class)->create();
        
        $user = factory(\App\Company::class)->create()->user;

        $this->be($adminUser);

        $response = $this->delete('/admin/users/' . $user->id);
        
        $response->assertStatus(204);
    }

    public function testDeleteCompany()
    {
        $adminUser = factory(\App\User::class)->create();
        
        $company = factory(\App\Company::class)->create();

        $this->be($adminUser);

        $response = $this->delete('/companies/' . $company->id);

        $response->assertStatus(204);
    }
}
