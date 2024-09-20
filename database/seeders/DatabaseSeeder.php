<?php

namespace Database\Seeders;

use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (UserProfile::count() === 0) $this->call(UserProfileSeeder::class);
        $this->call(PublicationSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(FallowsSeeder::class);
        $this->call(ReactionSeeder::class);
        $this->call(ResourceSeeder::class);
        $this->call(SocialEventSeeder::class);
        $this->call(EventParticipantSeeder::class);
    }
}
