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
        $this->call(PublicacionSeeder::class);
        $this->call(ComentarioSeeder::class);
        $this->call(ReaccionSeeder::class);
    }
}
