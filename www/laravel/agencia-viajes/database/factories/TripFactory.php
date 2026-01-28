<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'destination' => fake()->city(), 
        'slug' => fake()->slug(),        // La url
        'description' => fake()->paragraph(3), 
        'price' => fake()->randomFloat(2, 100, 3000), 
        'start_date' => fake()->dateTimeBetween('now', '+2 months'),
        'end_date' => fake()->dateTimeBetween('+3 months', '+4 months'), 
    ];
    }
}
