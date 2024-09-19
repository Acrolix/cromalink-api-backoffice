<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $last_login = $this->faker->dateTimeThisYear();
        return [
            'email' => $this->faker->unique()->safeEmail,
            'last_login' => $this->faker->dateTimeThisYear(),
            'password' => bcrypt($this->faker->password()),
            'active' => true,
            'email_verified_at' => $this->faker->dateTimeBetween('-5 years', $last_login),
        ];
    }


}
