<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test get all companies as guest.
     *
     * @return void
     */
    public function testGetAllCompanies()
    {
        factory(\App\Company::class, 5)->create();

        $response = $this->get('/api/companies');

        $data = $response->json();

        $response->assertOk();

        $this->assertCount(5, $data['data']);
    }

    /**
     * Test get all companies as guest with their email address.
     *
     * @return void
     */
    public function testGetAllCompaniesWithEmail()
    {
        factory(\App\Company::class, 5)->create();

        $response = $this->get('/api/companies');

        $data = $response->json();

        $this->assertCount(5, $data['data']);
        $this->assertArrayHasKey('email', $data['data'][0]);
    }

    /**
     * Test get all companies as guest paginated.
     *
     * @return void
     */
    public function testGetAllCompaniesPaginated()
    {
        factory(\App\Company::class, 13)->create();

        $response = $this->get('/api/companies');

        $data = $response->json();

        $response->assertOk();

        $this->assertCount(5, $data['data']);
    }



    /**
     * Test get 2nd page of all companies as guest paginated.
     *
     * @return void
     */
    public function testGetLastPageCompaniesPaginated()
    {
        $companies = factory(\App\Company::class, 13)->create();

        $response = $this->get('/api/companies?page=3');

        $data = $response->json();

        $response->assertOk();
        $this->assertCount(3, $data['data']);
    }

    public function testPaginationLinks()
    {
        $companies = factory(\App\Company::class, 13)->create();

        $response = $this->get('/api/companies?page=3');

        $data = $response->json();

        $response->assertOk();
        $this->assertArrayHasKey('data', $data);
        $this->assertCount(3, $data['data']);
        $this->assertArrayHasKey('links', $data);
        $this->assertArrayHasKey('first', $data['links']);
        $this->assertArrayHasKey('prev', $data['links']);
        $this->assertNull($data['links']['next']);
    }

    public function testAdminAuthRedirect()
    {
        $response = $this->get('/api/admin/users');

        $response->assertStatus(302);
    }
}
