<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HostingDetail>
 */
class HostingDetailFactory extends Factory
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
            'host_name' => $this->faker->company(),
            'host_username' => $this->faker->userName(),
            'host_password' => $this->faker->password(7),
            'host_port_number' => $this->faker->numberBetween(1000,65535),
            'server_supplier_lookup_id' => $this->faker->numberBetween(1,4),
            'connection_type_lookup_id' => $this->faker->numberBetween(1,4),
        ];
    }
}