<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Artist::class;
    public function definition(): array

    {
        return [
            'name' => 'fake name',
            'category_id' => Category::factory()->create(),
            'avatar' => 'fire avatar',
            'background' => 'fake background'
        ];
    }
}
