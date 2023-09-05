<?php

namespace Database\Factories;

use App\Models\Notebooks;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notes>
 */
class NotesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'notebook_id' => Notebooks::factory(),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph
        ];
    }
}
