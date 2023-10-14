<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'client_name' => $this->faker->company(),
            'client_account_manager_id' => $this->faker->numberBetween(1,5),
            'client_postal_address' => $this->faker->text($maxNbChars = 20),
            'created_at' => $this->faker->dateTimeBetween('-3 years', now(), config('app.timezone')),
        ];
    }
}
