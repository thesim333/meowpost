<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MeowTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * POST /users/{id}/meows.
     * Success
     *
     * @return void
     */
    public function test_post_create_meow()
    {
        $content = 'Meow Meow Meow Meow Meow... Meow';
        $response = $this->post('/users/123/meows', ['content' => $content]);
        $response->assertStatus(200);
    }

    /**
     * POST /users/{id}/meows.
     * 403 - invalid user id
     *
     * @return void
     */
    public function test_post_create_meow_invalid_id()
    {
        $content =
            'Meow Meow Meow Meow Meow... Meow';
        $response = $this->post('/users/3djhz/meows', ['content' => $content]);
        $response->assertStatus(403);
    }

    /**
     * POST /users/{id}/meows.
     * test strip_tags - read db result
     * 
     * @return void
     */
    public function test_post_create_meow_strip()
    {
        $content = '<script>alert("warning, you got scripted!");</script>';
        $response = $this->post('/users/123/meows', ['content' => $content]);
        $response->assertStatus(200);
    }
}