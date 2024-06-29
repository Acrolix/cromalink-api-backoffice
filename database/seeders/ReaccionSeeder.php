<?php

namespace Database\Seeders;

use App\Models\Reaccion;
use Illuminate\Database\Seeder;

class ReaccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            Reaccion::factory(1000)->create();
        } catch (\Throwable $th) {
            
        }
    }
}
