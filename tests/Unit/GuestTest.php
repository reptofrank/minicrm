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
     * Test get all companies as guest paginated.
     *
     * @return void
     */
    public function testGetAllCompaniesPaginated()
    {
        factory(\App\Company::class, 13)->create();

        $response = $this->get('/companies');

        $data = $response->json();

        $this->assertCount(5, $data['data']);
    }
}
