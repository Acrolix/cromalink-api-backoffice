<?php

namespace Database\Factories;

use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicationFactory extends Factory
{
    public function definition()
    {
        $title = $this->faker->sentence(rand(2, 4));
        if (strlen($title) > 50) $title = substr($title, 0, 50);
        return [
            'title' => $title,
            'content' => $this->faker->text(rand(100, 500)),
            'published_by' => UserProfile::all()->random()->user_id,
        ];
    }
}
