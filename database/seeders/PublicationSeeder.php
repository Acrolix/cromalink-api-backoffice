<?php

namespace Database\Seeders;

use App\Models\Publication;
use Illuminate\Database\Seeder;

class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            Publication::factory(100)->create();
        } catch (\Exception $e) {
            $this->command->info($e->getMessage());
        }
    }
}
