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

        $repeat = UserProfile::where('user_id', $follower->user_id)->where('user_id', $followed->user_id)->count() > 0;
        $count = 0;
        while ($follower->user_id === $followed->user_id && !$repeat && $count < 1000) {
            $followed = UserProfile::all()->random();
            $count++;
        }

        return [
            'follower_id' => $follower->user_id,
            'followed_id' => $followed->user_id,
        ];
    }
}
