<?php

namespace Database\Factories;

use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReaccionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'publication_id' => $this->faker->numberBetween(1, count(Publicacion::all())),
            'reaction_by' => $this->faker->numberBetween(1, count(User::all())),
        ];
    }
}
