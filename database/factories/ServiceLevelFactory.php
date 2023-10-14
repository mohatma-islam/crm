<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceLevel>
 */
class ServiceLevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'website_id' => $this->faker->numberBetween(1,50),
            
            'service_level_lookup_id' => $this->faker->numberBetween(1,3),

            'maintenance_lookup_id' => $this->faker->numberBetween(1,2),
        ];
    }
}
