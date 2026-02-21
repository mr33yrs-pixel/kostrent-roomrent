<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visit>
 */
class VisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ip_address' => $this->faker->ipv4,
            'url' => $this->faker->url,
            'user_agent' => $this->faker->userAgent,
            'user_id' => null,
            'meta' => [],
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
