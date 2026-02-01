<?php

namespace Database\Factories;

use App\Models\Category;
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

    $imageNumber = fake()->numberBetween(1, 6);
    
      return [
        'destination' => fake()->city(),
        'slug' => fake()->slug(), //La url
        'image_url' => '/images/trips/trip-' . $imageNumber . '.jpg',
        'description' => fake()->paragraph(4), 
        'price' => fake()->randomFloat(2, 500, 4000),
        'start_date' => fake()->dateTimeBetween('now', '+3 months'),
        'end_date' => fake()->dateTimeBetween('+4 months', '+5 months'),
        'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
    ];
    }
}
