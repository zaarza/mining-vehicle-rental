<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_vehicles()
    {
        // SETUP
        $user = User::factory()->create(['role_id' => 1]);
        $vehicle = Vehicle::factory()->create();

        // ACTION
        Sanctum::actingAs($user);
        $response = $this->get('/api/vehicles', [
            'accept' => 'application/json'
        ]);

        // ASSERTION
        $response->assertStatus(200);
        $this->assertDatabaseCount('vehicles', 1);

        // CLEANUP
        $user->delete();
        $vehicle->delete();
    }

    public function test_get_vehicles_with_query()
    {
        // SETUP
        $user = User::factory()->create(['role_id' => 1]);
        $vehicle = Vehicle::factory()->create([
            'category_id' => 0,
            'name' => "IDUNNO",
        ]);

        $vehiclesWithPeopleCategory = Vehicle::factory(3)->create(['category_id' => 1]);
        $vehiclesWithBrandQuery = Vehicle::factory(5)->create(['category_id' => 2, 'brand' => 'IDUNNO']);

        // ACTION
        Sanctum::actingAs($user);
        $withSearchQueryResponse = $this->get('/api/vehicles?search=' . $vehicle->name);
        $withPeopleCategoryQueryResponse = $this->get('/api/vehicles?category=' . 1);
        $withBrandQueryResponse = $this->get('/api/vehicles?brand=' . $vehiclesWithBrandQuery[0]->brand);

        // ASSERT
        $withSearchQueryResponse->assertStatus(200);
        $withSearchQueryResponse->assertJson([
            'data' => [
                [
                    'name' => $vehicle->name
                ],
            ]    
        ]);

        $withPeopleCategoryQueryResponse->assertStatus(200);
        $this->assertCount(count($vehiclesWithPeopleCategory), $withPeopleCategoryQueryResponse->decodeResponseJson()['data']);

        $withBrandQueryResponse->assertStatus(200);
        $this->assertCount(count($vehiclesWithBrandQuery), $withBrandQueryResponse->decodeResponseJson()['data']);

        // CLEANUP
        $user->delete();
        $vehicle->Delete();
        foreach ($vehiclesWithPeopleCategory as $vehicle) {
            $vehicle->delete();
        };
        foreach ($vehiclesWithBrandQuery as $vehicle) {
            $vehicle->delete();
        }
    }

    public function test_get_specific_vehicle()
    {
        // SETUP
        $user = User::factory()->create();
        $vehicle = Vehicle::factory()->create();

        // ACTION
        Sanctum::actingAs($user);
        $response = $this->get('/api/vehicles/' . $vehicle->id);

        // ASSERT
        $response->assertStatus(200);
        $response->assertJson([
            'id' => $vehicle->id,
            'name' => $vehicle->name
        ]);

        // CLEANUP
        $vehicle->delete();
    }

    public function test_get_specific_vehicle_invalid()
    {
        // SETUP
        $user = User::factory()->create();

        // ACTION
        Sanctum::actingAs($user);
        $response = $this->get('/api/vehicles/' . 'random');

        // ASSERT
        $response->assertStatus(404);
        
        // CLEANUP
        $user->delete();
    }

    public function test_add_new_vehicle()
    {
        // SETUP
        $user = User::factory()->create();
        $vehicle = [
            'name' => "RandomName",
            'brand' => "RandomBrand",
            'company' => "RandomCompany",
            'fuel_usage_per_hour' => 25,
            'category_id' => 2
        ];

        // ACTION
        Sanctum::actingAs($user);
        $response = $this->post('/api/vehicles', $vehicle);

        // ASSERT
        $response->assertStatus(201);
        $vehicle = Vehicle::where($vehicle)->first();
        $this->assertDatabaseHas('vehicles', ['id' => $vehicle->id]);

        // CLEANUP
        $user->delete();
        $vehicle->delete();
    }

    public function test_delete_vehicle()
    {
        // SETUP
        $user = User::factory()->create(['role_id' => 2]);
        $vehicle = Vehicle::factory()->create();

        // ACTION
        Sanctum::actingAs($user);
        $response = $this->delete('/api/vehicles/' . $vehicle->id);

        // ASSERT
        $response->assertStatus(204);
        $this->assertDatabaseMissing('vehicles', ['id' => $vehicle->id]);

        // CLEANUP
        $user->delete();
    }

    public function test_update_vehicle()
    {
        // SETUP
        $user = User::factory()->create(['role_id' => 2]);
        $vehicle = Vehicle::factory()->create(['name' => "Foo"]);

        // ACTION
        Sanctum::actingAs($user);
        $response = $this->put('/api/vehicles/' . $vehicle->id, [
           'name' => "Foo updated",
           'brand' => 'Brand updated',
           'fuel_usage_per_hour' => 0,
           'category_id' => 1,
           'company' => 'Company updated'
        ], [
            'content-type' => "x-www-form-urlencoded"
        ]);
        
        // ASSERT
        $response->assertStatus(200);
        $vehicle = $vehicle->fresh();
        $this->assertEquals('Foo updated', $vehicle->name);

        // CLEANUP
        $user->delete();
        $vehicle->delete();
    }
}
