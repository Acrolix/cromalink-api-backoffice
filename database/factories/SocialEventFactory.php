<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Publication;
use DateInterval;
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
        $start_at = $this->faker->dateTimeBetween(now(), '+1 month');
        $publication = Publication::all()->random();

        while ($publication->social_events()->exists()) {
            $publication = Publication::all()->random();
        }

        return [
            'name' => $this->faker->sentence(3),
            'publication_id' => $publication->id,
            'starts_at' => $start_at,
            'ends_at' => (clone $start_at)->modify('+' . rand(1, 3) . ' hours'),
            'description' => $this->faker->text(rand(50, 200)),
            'country_code' => Country::all()->random()->code,
            'longitude' => $this->faker->longitude(),
            'latitude' => $this->faker->latitude(),
        ];
    }
}
