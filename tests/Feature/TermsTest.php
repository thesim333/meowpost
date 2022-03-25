<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class TermsTest extends TestCase
{
    use RefreshDatabase;

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
