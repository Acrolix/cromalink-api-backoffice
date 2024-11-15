<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Faker\Generator as Faker;

class UserProfileFactory extends Factory
{
    protected $model = \App\Models\UserProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'username' => $this->faker->unique()->userName(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'biography' => $this->faker->text(),
            'birth_date' => $this->faker->dateTimeBetween('-70 years', '-18 years'),
            'country_code' => Country::all()->random()->code,
            'avatar' => null,
        ];

    }
}
