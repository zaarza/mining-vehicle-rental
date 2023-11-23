<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VehicleOrder>
 */
class VehicleOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'driver' => fake()->name(),
            'company' => fake()->company(),
            'admin_id' => fake()->numberBetween(1, 100),
            'vehicle_id' => fake()->numberBetween(1, 100),
            'is_approved' => fake()->randomElement([true, false, null])
        ];
    }
}
