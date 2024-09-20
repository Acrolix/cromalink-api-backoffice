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
        $publication = Publication::all()->random();
        $reaction_by = UserProfile::all()->random();
        $type = $this->faker->randomElement(['MG', 'ME', 'MD']);

        while ($publication->reactions()->where('reaction_by', $reaction_by->user_id)->exists()) {
            $publication = Publication::all()->random();
            $reaction_by = UserProfile::all()->random();
        }

        return [
            'publication_id' => $publication->id,
            'reaction_by' => $reaction_by->user_id,
            'type' => $type,
        ];
    }
}
