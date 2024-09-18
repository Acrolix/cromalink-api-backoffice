<?php

namespace Database\Seeders;

use App\Models\User;
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
        if (User::count() === 0) {
            $this->call(UserSeeder::class);
        }
        $this->call(FollowsSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(PublicationSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(ReactionSeeder::class);
        $this->call(ResourceSeeder::class);
        $this->call(SocialEventSeeder::class);

    }
}
