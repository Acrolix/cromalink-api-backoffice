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
            'publication_id' => Publicacion::all()->random()->id,
            'reaction_by' => User::all()->random()->id,
        ];
    }
}
