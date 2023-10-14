<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deal>
 */
class DealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'client_id' => $this->faker->numberBetween(1, 100),
            'deal_stage_id' => $this->faker->numberBetween(1, 5),
            'estimated_deal' => $this->faker->numberBetween(10000, 100000),
            'created_at' => $this->faker->dateTimeBetween('-3 years', now(), config('app.timezone')),
        ];
    }
}
