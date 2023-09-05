<?php

namespace Tests\Feature;

use App\Models\Notebooks;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotebookTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_create_a_notebook()
    {
        $this->withoutExceptionHandling();
        
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/notebooks', [
            'title' => 'Test Notebook',
            'description' => 'Test Notebook Description'
        ]);

        $response->assertStatus(201);
        $this->assertCount(1, Notebooks::all());
    }

    public function test_a_notebook_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $notebook = Notebooks::factory()->create(['user_id' => $user->id]);

        $this->assertEquals(1, $notebook->user->count());
    }
}
