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
           return [
                'email' => $this->faker->unique()->safeEmail,
                'first_name' => $this->faker->firstName,
                'last_name' => $this->faker->lastName,
                'username' => $this->faker->userName,
                'date_of_birth' => $this->faker->date(),
                'biography' => $this->faker->text(),
                'phone' => $this->faker->phoneNumber,
                'country' => $this->faker->country,
                'picture' => $this->faker->imageUrl(),
                'last_login' => $this->faker->dateTime(),
                'password' => bcrypt('password'),
                'staff' => $this->faker->boolean(),
                'active' => $this->faker->boolean(),
                'created_at' => $this->faker->dateTime(),
            ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
