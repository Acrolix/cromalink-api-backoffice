<?php

namespace Database\Factories;

use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class FallowsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $follower = UserProfile::all()->random();
        $followed = UserProfile::all()->random();

        $repeat = UserProfile::where('id', $follower->id)->where('id', $followed->id)->count() > 0;

        while ($follower->id === $followed->id && !$repeat) {
            $followed = UserProfile::all()->random();
        }


        return [
            'follower_id' => $follower->id,
            'followed_id' => $followed->id,
        ];
    }
}
