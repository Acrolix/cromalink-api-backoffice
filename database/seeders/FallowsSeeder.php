<?php

namespace Database\Seeders;

use App\Models\Fallows;
use Illuminate\Database\Seeder;

class FallowsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            Fallows::factory(100)->create();
        } catch (\Throwable $th) {
            $this->command->info($th->getMessage());
        }
    }
}
