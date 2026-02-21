<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'type' => $this->faker->randomElement(['standard', 'premium']),
            'price' => $this->faker->numberBetween(1000000, 5000000),
            'price_6_months' => $this->faker->numberBetween(5000000, 25000000),
            'price_yearly' => $this->faker->numberBetween(10000000, 50000000),
            'description' => $this->faker->paragraphs(3, true),
            'facilities' => $this->faker->words(5), // stored as json
            'images' => [], // empty array or fake paths
            'is_available' => true,
        ];
    }
}
