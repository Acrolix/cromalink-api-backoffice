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
            Fallows::factory(1000)->create();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
