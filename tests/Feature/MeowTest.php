<?php

namespace Tests\Feature;

use App\Models\Meow;
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
     * Test content too short
     * POST /api/meows
     * Redirect
     *
     * @return void
     */
    public function test_post_create_meow_too_short()
    {
        $user = User::factory()->create(['agreed_terms' => now()]);
        $content = 'M';
        $response = $this->actingAs($user)
            ->post('/api/meows', ['content' => $content]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['content']);
    }

    /**
     * Test content too short
     * POST /api/meows
     * Redirect
     *
     * @return void
     */
    public function test_post_create_meow_too_long()
    {
        $user = User::factory()->create(['agreed_terms' => now()]);
        $content = str_repeat('M', 161);
        $response = $this->actingAs($user)
            ->post('/api/meows', ['content' => $content]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['content']);
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
     * GET /user/my-meow/{id}
     * 200
     *
     * @return void
     */
    public function test_get_created_meow_for_edit()
    {
        $user = User::factory()->create(['agreed_terms' => now()]);
        $user->createMeow('Meow Meow Meow ... Meow?');
        $meow = $user->meows()->first();

        $response = $this->actingAs($user)
            ->get("/user/meow/$meow->id");
        $response->assertStatus(200);
    }

    /**
     * User can update their meow
     * PUT /user/meow/{id}
     * 302
     *
     * @return void
     */
    public function test_update_meow()
    {
        $user = User::factory()->create(['agreed_terms' => now()]);
        $user->createMeow('Meow Meow Meow ... Meow?');
        $meow = $user->meows()->first();


        $response = $this->actingAs($user)
            ->put("/user/meow/$meow->id", ['content' => 'Just 1 Meow.']);
        $response->assertSessionHas('success', 'Meow Updated');
    }

    /**
     * User cannot update a Meow belonging to another User
     * PUT /user/meow/{id}
     * 401
     */
    public function test_update_meow_fails_not_owner()
    {
        $user1 = User::factory()->create(['agreed_terms' => now()]);
        $user1->createMeow('Meow Meow Meow ... Meow?');
        $meow = $user1->meows()->first();

        $user2 = User::factory()->create(['agreed_terms' => now()]);

        $response = $this->actingAs($user2)
            ->put("/user/meow/$meow->id", ['content' => 'Just 1 Meow.']);
        $response->assertStatus(401);
    }

    /**
     * Cannot update meow that doesn't exist
     * PUT /user/meow/id
     * 404
     */
    public function test_update_id_not_found_404()
    {
        $user = User::factory()->create(['agreed_terms' => now()]);
        $response = $this->actingAs($user)
            ->put("/user/meow/2", ['content' => 'Just 1 Meow.']);
        $response->assertStatus(404);
    }

    /**
     * DELETE /user/meow/{id}
     * 302
     *
     * @return void
     */
    public function test_delete_meow()
    {
        $user = User::factory()->create(['agreed_terms' => now()]);
        $user->createMeow('Meow Meow Meow ... Meow?');
        $meow = $user->meows()->first();

        $response = $this->actingAs($user)
            ->delete("/user/meow/$meow->id");
        $response->assertStatus(200);
    }

    /**
     * User cannot delete a Meow belonging to another User
     * DELETE /user/meow/{id}
     * 401
     *
     * @return void
     */
    public function test_delete_meow_fails_not_owner()
    {
        $user1 = User::factory()->create(['agreed_terms' => now()]);
        $user1->createMeow('Meow Meow Meow ... Meow?');
        $meow = $user1->meows()->first();

        $user2 = User::factory()->create(['agreed_terms' => now()]);

        $response = $this->actingAs($user2)
            ->delete("/user/meow/$meow->id");
        $response->assertStatus(401);
    }

    /**
     * Cannot delete meow that doesn't exist
     * DELETE /user/meow/{id}
     * 404
     */
    public function test_delete_meow_id_not_found_404()
    {
        $user = User::factory()->create(['agreed_terms' => now()]);
        $response = $this->actingAs($user)
            ->delete("/user/meow/1");
        $response->assertStatus(404);
    }
}
