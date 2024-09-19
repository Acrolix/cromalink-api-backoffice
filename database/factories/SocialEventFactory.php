<?php

namespace Database\Factories;

use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\Factory;

class SocialEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $starts_at = $this->faker->dateTimeBetween('now', '+1 year');
        $ends_at = $this->faker->dateTimeBetween($starts_at, '+3 hours');
        return [
            'name' => $this->faker->sentence(3),
            'publication_id' => Publication::all()->random()->id,
            'starts_at' => $starts_at,
            'ends_at' => $ends_at,
            'description' => $this->faker->text(rand(50, 200)),
            'country_code' => $this->faker->countryCode(),
            'longitude' => $this->faker->longitude(),
            'latitude' => $this->faker->latitude(),
        ];
    }
}
