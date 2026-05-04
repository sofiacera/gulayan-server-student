<?php

namespace Tests\Feature;

use App\Models\PlantModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlantApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_delete_plant_record(): void
    {
        $plant = PlantModel::factory()->create();

        $response = $this->deleteJson(route('plants.destroy', ['plant' => $plant->id]));

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Plant deleted successfully.']);
        $this->assertDatabaseMissing('plants', ['id' => $plant->id]);
    }

    public function test_delete_nonexistent_plant_returns_404(): void
    {
        $response = $this->deleteJson(route('plants.destroy', ['plant' => 999999]));

        $response->assertStatus(404);
    }
}
