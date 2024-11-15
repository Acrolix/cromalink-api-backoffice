<?php

namespace Database\Seeders;

use App\Models\EventParticipant;
use Illuminate\Database\Seeder;

class EventParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            EventParticipant::factory(30)->create();
        } catch (\Exception $e) {
            $this->command->info('EventParticipantSeeder already has data!');
        }
    }
}
