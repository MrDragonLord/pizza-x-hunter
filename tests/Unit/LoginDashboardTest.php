<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class LoginDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }

    public function test_login_success()
    {
        $password = 'password123';
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make($password),
        ]);

        $response = $this->postJson('/api/dashboard/login', [
            'email' => 'test@example.com',
            'password' => $password,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'token',
        ]);
    }

    public function test_login_failure()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->postJson('/api/dashboard/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'errors' => ['email'],
        ]);
    }

    public function test_logout()
    {
        $password = 'password123';
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make($password),
        ]);

        $token = auth()->attempt(['email' => 'test@example.com', 'password' => $password]);

        $response = $this->actingAs($user, 'api')->postJson('/api/logout', [], [
            'Authorization' => "Bearer $token"
        ]);

        $response->assertStatus(200);
    }
}
