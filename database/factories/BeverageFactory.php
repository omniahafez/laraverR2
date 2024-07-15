<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
           'content' => fake()->text(),
           'published' => fake()->boolean(),
           'special' => fake()->boolean(),
           // use default image from my folder 
           'image' => 'default.jpg',
           'taq_id' => fake()->numberBetween(1, 3),
        ];
    }
}
