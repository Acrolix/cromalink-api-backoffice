<?php

namespace Database\Factories;

use App\Models\Publication;
use App\Models\User;
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
            'reaction_by' => User::all()->random()->id,
        ];
    }
}
