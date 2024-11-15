<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrantOAuthPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Llama al procedimiento almacenado para otorgar los permisos
        DB::statement('CALL GrantOAuthPermissions()');
    }
}