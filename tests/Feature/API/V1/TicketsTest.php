<?php

namespace Tests\Feature\API\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a new ticket
     */
    public function test_create_new_ticket()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/v1/tickets', [
            'customer_name' => 'Test User',
            'email' => 'test@gmail.com',
            'phone' => '0771234567',
            'description' => 'Test issue',
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'data' => [
                'email' => 'test@gmail.com',
            ]
        ]);
    }
}
