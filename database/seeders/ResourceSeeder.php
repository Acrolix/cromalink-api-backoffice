<?php

namespace Database\Seeders;

use App\Models\Resource;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            Resource::factory(30)->create();
        } catch (\Exception $e) {
            $this->command->info($e->getMessage());
        }
    }
}
