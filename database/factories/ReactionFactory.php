<?php

namespace Database\Factories;

use App\Models\Publication;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'publication_id' => Publication::all()->random()->id,
            'reaction_by' => UserProfile::all()->random()->user_id,
            'type' => $this->faker->randomElement(['MG', 'ME', 'MD']),
        ];
    }
}
