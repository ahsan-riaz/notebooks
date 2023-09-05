<?php

namespace Tests\Feature;

use App\Models\Notebooks;
use App\Models\Notes;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_create_a_note_in_a_notebook()
    {
        $this->withoutExceptionHandling();
        
        $user = User::factory()->create();
        $this->actingAs($user);

        $notebook = Notebooks::factory()->create(['user_id' => $user->id]);

        $response = $this->post("/notebooks/{$notebook->id}/notes", [
            'content' => 'This is a test note.'
        ]);

        $response->assertStatus(201);
        $this->assertCount(1, Notes::all());
    }

    public function test_a_note_belongs_to_a_notebook_and_user()
    {
        $user = User::factory()->create();
        $notebook = Notebooks::factory()->create(['user_id' => $user->id]);
        $note = Notes::factory()->create(['user_id' => $user->id, 'notebook_id' => $notebook->id]);

        $this->assertEquals(1, $note->notebook->count());
        $this->assertEquals(1, $note->user->count());
    }
}
