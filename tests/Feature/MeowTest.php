<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class MeowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Fails on not auth redirect to Login
     * POST /api/meows
     * Redirect
     *
     * @return void
     */
    public function test_post_create_meow_non_auth()
    {
        $content = 'Meow Meow Meow Meow Meow... Meow';
        $response = $this->post('/api/meows', ['content' => $content]);
        $response->assertRedirect('/login');
    }

    /**
     * Will fail with redirect to terms if not agreed
     * POST /api/meows
     * Redirect
     *
     * @return void
     */
    public function test_post_create_meow_not_agreed()
    {
        $user = User::factory()->create();
        $content = 'Meow Meow Meow Meow Meow... Meow';
        $response = $this->actingAs($user)
            ->post('/api/meows', ['content' => $content]);
        $response->assertRedirect('/user/terms');
    }

    /**
     * Can Post when auth and agreed
     * POST /api/meows
     * Redirect
     *
     * @return void
     */
    public function test_post_create_meow_agreed()
    {
        $user = User::factory()->create(['agreed_terms' => now()]);
        $content =
            'Meow Meow Meow Meow Meow... Meow';
        $response = $this->actingAs($user)
            ->post('/api/meows', ['content' => $content]);
        $response->assertRedirect('/user/my-meows');
    }

    /**
     * Redirects if not auth
     * GET /users/meows/create
     * Success
     *
     * @return void
     */
    public function test_get_create_meow_not_auth()
    {
        $response = $this->get('/user/meows/create');
        $response->assertRedirect('/login');
    }

    /**
     * Redirects if not agreed to terms
     * GET /users/meows/create
     * Success
     *
     * @return void
     */
    public function test_get_create_meow_not_agreed()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get('/user/meows/create');
        $response->assertRedirect('/user/terms');
    }

    /**
     * GET /users/meows/create
     * 200
     *
     * @return void
     */
    public function test_get_create_meow()
    {
        $user = User::factory()->create(['agreed_terms' => now()]);
        $response = $this->actingAs($user)
            ->get('/user/meows/create');
        $response->assertStatus(200);
    }

    /**
     * GET /meows
     * 200
     *
     * @return void
     */
    public function test_get_meows()
    {
        $user = User::factory()->create(['agreed_terms' => now()]);
        $response = $this->actingAs($user)
            ->get('/meows');
        $response->assertStatus(200);
    }

    /**
     * GET /user/my-meows
     * 200
     *
     * @return void
     */
    public function test_get_user_meows()
    {
        $user = User::factory()->create(['agreed_terms' => now()]);
        $response = $this->actingAs($user)
            ->get('/user/my-meows');
        $response->assertStatus(200);
    }

    /**
     * POST /user/terms
     * redirect if agreed
     *
     * @return void
     */
    public function test_post_accept_terms()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->post('/user/terms', ['agree' => 'yes']);
        $response->assertRedirect('/meows');
    }

    /**
     * POST /user/terms
     * error on not agree
     *
     * @return void
     */
    public function test_post_not_accept_terms()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->post('/user/terms', ['agree' => null]);
        $response->assertSessionHasErrors('agree');
    }
}
