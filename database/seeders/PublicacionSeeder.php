<?php

namespace Database\Seeders;

use App\Models\Publicacion;
use Illuminate\Database\Seeder;

class PublicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Publicacion::factory(50)->create();
    }
}
