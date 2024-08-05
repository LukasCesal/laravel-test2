<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IsWorkingEndpointTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     */
    public function testResponseStructure(): void
    {
        // Arrange


        // Act
        $response = $this->get('/api/isworkingday/show?day=1&month=4&year=2024&country=cz');

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure(['workingday', 'comment']);
    }
    /**
     * A basic feature test example.
     */
    public function testEaster2024(): void
    {
        // Arrange


        // Act
        $response = $this->get('/api/isworkingday/show?day=1&month=4&year=2024&country=cz');

        // Assert

        $this->assertSame($response->decodeResponseJson()['workingday'],false);
    }

}
