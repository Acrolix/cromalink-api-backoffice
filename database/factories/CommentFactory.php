<?php

namespace Database\Factories;

use App\Models\Publication;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
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
            'published_by' => UserProfile::all()->random()->user_id,
            'content' => $this->faker->text(rand(50, 200)),
        ];
    }
}
