<?php

namespace Database\Factories\Tenant;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    { //'name', 'description', 'body', 'price', 'slug'
        return [
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'body' => fake()->text(200),
            'price' => fake()->randomFloat(2, 1, 1000),
            'in_stock' => 10
        ];
    }
}
