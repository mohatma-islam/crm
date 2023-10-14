<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'client_id' => $this->faker->numberBetween(1,100),
            'activity_type' => $this->faker->randomElement(['Call Logs', 'New Task', 'Complete Task', 'Issue', 'New Event']),
            'activity_description' => $this->faker->slug(),
            'created_by_id' => $this->faker->numberBetween(1,5)
        ];
    }
}
