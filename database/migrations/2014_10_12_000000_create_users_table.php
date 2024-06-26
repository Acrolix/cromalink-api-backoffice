<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // 'email' => 'sofiapetrova@example.com',
            //     'first_name' => 'Sofia',
            //     'last_name' => 'Petrova',
            //     'biography' => 'Me apasiona la cultura rusa, el ballet clásico, la literatura y la música folclórica.',
            //     'phone' => '555-012-3456',
            //     'date_of_birth' => '1990-06-27',
            //     'country' => 'Rusia',
            //     'picture' => 'https://picsum.photos/200/200?random=20',
            //     'password' => 'randomPass321',
            
            $table->id();
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->date('date_of_birth');
            $table->text('biography');
            $table->string('phone');
            $table->string('country');
            $table->string('picture');
            $table->timestamp('last_login')->nullable();
            $table->string('password');
            $table->boolean('staff')->default(false);
            $table->boolean('active')->default(true);
            $table->dateTime('created_at')->timestamps();
            
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
