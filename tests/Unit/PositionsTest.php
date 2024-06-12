<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Positions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PositionsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        Storage::fake('public_uploads');
    }

    public function test_create_position_requires_authentication()
    {
        $response = $this->postJson('/api/dashboard/positions/create', []);
        $response->assertStatus(401);
    }

    public function test_create_position()
    {
        $user = User::factory()->create();
        $token = auth()->login($user);

        $data = [
            'name' => 'New Position',
            'price' => 100,
            'description' => 'A new position description',
            'weight' => 10,
            'discount' => 5,
            'image' => UploadedFile::fake()->image('position.webp'),
        ];

        $response = $this->actingAs($user, 'api')->postJson('/api/dashboard/positions/create', $data, [
            'Authorization' => "Bearer $token"
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('positions', [
            'name' => 'New Position',
            'price' => 100,
            'description' => 'A new position description',
            'weight' => 10,
            'discount' => 5,
        ]);

        Storage::disk('public_uploads')->assertExists('positions/1.webp');
    }

    public function test_update_position()
    {
        $user = User::factory()->create();
        $token = auth()->login($user);

        $position = Positions::factory()->create();

        $data = [
            'name' => 'Updated Position',
            'price' => 150,
            'description' => 'Updated description',
            'weight' => 20,
            'discount' => 10,
            'image' => UploadedFile::fake()->image('updated_position.webp'),
        ];

        $response = $this->actingAs($user, 'api')->postJson("/api/dashboard/positions/update/{$position->id}", $data, [
            'Authorization' => "Bearer $token"
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('positions', [
            'id' => $position->id,
            'name' => 'Updated Position',
            'price' => 150,
            'description' => 'Updated description',
            'weight' => 20,
            'discount' => 10,
        ]);

        Storage::disk('public_uploads')->assertExists("positions/{$position->id}.webp");
    }

    public function test_delete_position()
    {
        $user = User::factory()->create();
        $token = auth()->login($user);

        $position = Positions::factory()->create();

        $response = $this->actingAs($user, 'api')->deleteJson("/api/dashboard/positions/delete/{$position->id}", [], [
            'Authorization' => "Bearer $token"
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('positions', [
            'id' => $position->id
        ]);
    }

    public function test_render_positions()
    {
        $user = User::factory()->create();
        $token = auth()->login($user);

        Positions::factory()->count(15)->create();

        $response = $this->actingAs($user, 'api')->getJson('/api/dashboard/positions/render', [
            'Authorization' => "Bearer $token"
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'items' => [
                'data' => [
                    '*' => ['id', 'name', 'price', 'description', 'weight', 'discount']
                ]
            ],
        ]);
    }
}
