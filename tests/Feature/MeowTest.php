<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MeowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * POST /users/{id}/meows/create.
     * Success
     *
     * @return void
     */
    public function test_post_create_meow()
    {
        $content = 'Meow Meow Meow Meow Meow... Meow';
        $response = $this->post('/users/123/meows/create', ['content' => $content]);
        $response->assertStatus(200);
    }
}