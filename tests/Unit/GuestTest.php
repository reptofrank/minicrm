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

        $response = $this->get('/companies');

        $data = $response->json();

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

        $response = $this->get('/companies');

        $data = $response->json();

        $this->assertCount(5, $data);
        $this->assertArrayHasKey('email', $data['data']);
    }
}
