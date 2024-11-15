<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            Comment::factory(200)->create();
        } catch (\Exception $e) {
            $this->command->info($e->getMessage());
        }
    }
}
