<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClientContactFactory extends Factory
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
            'client_primary_contact' => $this->faker->numberBetween(1,0),
            'client_contact_first_name' => $this->faker->firstName,
            'client_contact_surname' => $this->faker->lastName,
            'client_email_address' => fake()->unique()->safeEmail(),
            'client_phone_number' => $this->faker->phoneNumber
        ];
    }
}
