<?php

namespace Database\Factories;

use App\Models\SocialEvent;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventParticipantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $social_event = SocialEvent::all()->random();
        $participant = UserProfile::all()->random();

        while ($social_event->participants()->where('participant_id', $participant->user_id)->exists()) {
            $participant = UserProfile::all()->random();
        }

        return [
            'social_event_id' => $social_event->publication_id,
            'participant_id' => $participant->user_id,
        ];
    }
}
