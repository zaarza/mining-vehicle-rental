<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->domainName(),
            'company' => fake()->company(),
            'brand' => fake()->company(),
            'fuel_usage_per_hour' => fake()->numberBetween(10, 50),
            'category_id' => fake()->numberBetween(1, 2),
        ];
    }
}
