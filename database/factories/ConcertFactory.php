<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Hall;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\concert>
 */
class ConcertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'artist_id' => Artist::factory()->create(),
            'hall_id' => Hall::factory()->create(),
            'title' => fake()->title,
            'description' => fake()->text,
            'started_at' => now()->format('Y-m-d'),
            'end_at' => now()->format('Y-m-d'),
            'published' => false
        ];
    }
}
