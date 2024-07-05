<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Beverage>
 */
class BeverageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
           'price' => fake()->randomFloat(2, 10, 100),
           'content' => fake()->numberBetween(3, 5),
           'published' => fake()->boolean(),
           'special' => fake()->boolean(),
           'image' => fake()->imageUrl(),
           'taq_id' => fake()->numberBetween(1, 3),
        ];
    }
}
