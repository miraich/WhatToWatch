<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->jobTitle,
            'status' => 'ready',
            'description' => fake()->text,
            'director' => fake()->name,
            'starring' => [fake()->name, fake()->name],
            'run_time' => random_int(60, 240),
            'released' => fake()->year,
            'imdb_id' => Str::random(5)
        ];
    }
}
