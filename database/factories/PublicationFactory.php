<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicationFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(rand(5, 10)),
            'content' => $this->faker->text(rand(200, 500)),
            'published_by' => User::all()->random()->id,
        ];
    }
}
