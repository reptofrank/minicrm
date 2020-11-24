<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetAllCompanies()
    {
        factory(\App\Company::class, 5)->create();

        $response = $this->get('/companies');

        $data = $response->json();

        $this->assertCount(5, $data);
    }
}
