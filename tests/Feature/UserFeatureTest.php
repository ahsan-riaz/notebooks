<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class UserFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_with_valid_credentials()
    {
        // Create a user to test with
        $user = User::factory()->create([
            'password' => bcrypt($password = 'secret'),
        ]);

        $response = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);
    }

    public function test_fetch_authenticated_user()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson('/api/v1/user');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'email' => $user->email
        ]);
    }

    public function test_logout_authenticated_user()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/v1/logout');

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Logged out']);
        $this->assertGuest();
    }
}
