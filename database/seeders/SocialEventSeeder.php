<?php

namespace Database\Seeders;

use App\Models\SocialEvent;
use Illuminate\Database\Seeder;

class SocialEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            SocialEvent::factory(50)->create();
        } catch (\Exception $e) {
            $this->command->info($e->getMessage());
        }
    }
}
