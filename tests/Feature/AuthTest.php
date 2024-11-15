<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;




class AuthTest extends TestCase
{
    use DatabaseTransactions;

    public function test_login_success()
    {
        $password = 'Password.123';
        $hashPassword = bcrypt($password);
        $user = User::create([
            'email' => 'test@acrolix.tech',
            'password'=> bcrypt($hashPassword),
            'last_login' => now(),
            'email_verified_at' => now(),
            'active' => 1,
            ]);
        UserProfile::create([
            'user_id' => $user->id,
            'first_name'=> 'test',
            'last_name'=> 'test',
            'username'=> 'test.test',
            'biography'=> 'test',
            'birth_date'=> '1990-01-01',
            'country_code'=> 'ES',
            'avatar'=> 'test',
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => 'test@acrolix.tech',
            'password' => $password,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'access_token',
            'refresh_token',
            'expires_in',
        ]);

    }

    public function test_register_success()
    {
        Notification::fake();

        $response = $this->postJson('/api/register', [
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    public function test_register_failure()
    {
        $user = UserProfile::factory()->create();

        $response = $this->postJson('/api/register', [
            'email' => $user->email,
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(400);
    }

    public function test_validate_token()
    {
        $user = UserProfile::factory()->create();
        $this->actingAs($user);

        $response = $this->getJson('/api/validate-token');

        $response->assertStatus(200);
    }

    public function test_logout()
    {
        $user = UserProfile::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('/api/logout');

        $response->assertStatus(200);
    }

    public function test_me()
    {
        $user = UserProfile::factory()->create();
        $this->actingAs($user);

        $response = $this->getJson('/api/me');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'last_login',
            'email',
            'first_name',
            'last_name',
            'role',
            'avatar'
        ]);
    }
}
