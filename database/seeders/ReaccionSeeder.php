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
        Reaccion::factory(400)->create();
    }
}
