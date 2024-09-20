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

        return [
            'name' => $this->faker->sentence(3),
            'publication_id' => Publication::all()->random()->id,
            'starts_at' => $$this->faker->dateTimeBetween('-1 month', '+1 month'),
            'ends_at' => $this->faker->dateTimeBetween('+1 month', '+2 month'),
            'description' => $this->faker->text(rand(50, 200)),
            'country_code' => $this->faker->countryCode(),
            'longitude' => $this->faker->longitude(),
            'latitude' => $this->faker->latitude(),
        ];
    }
}
