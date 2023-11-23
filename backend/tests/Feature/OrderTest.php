<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\VehicleOrder;
use Database\Factories\VehicleOrderFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_orders()
    {
        // SETUP
        $user = User::factory()->create();
        $approvedOrders = VehicleOrder::factory(1)->create(['is_approved' => true]);
        $pendingOrders = VehicleOrder::factory(2)->create(['is_approved' => null]);
        $rejectedOrders = VehicleOrder::factory(3)->create(['is_approved' => false]);

        // ACTION
        Sanctum::actingAs($user);
        $getAllOrdersResponse = $this->get('/api/orders');

        // ASSERT
        $getAllOrdersResponse->assertStatus(200);
        $this->assertCount((count($approvedOrders) + count($pendingOrders) + count($rejectedOrders)), $getAllOrdersResponse->decodeResponseJson()['data']);

        // CLEANUP
        $user->delete();
        foreach ($approvedOrders as $order) {
            $order->delete();
        }
        foreach ($pendingOrders as $order) {
            $order->delete();
        }
        foreach ($rejectedOrders as $order) {
            $order->delete();
        }
    }

    public function test_post_orders()
    {
        // SETUP
        $user = User::factory()->create(['role_id' => 1]);
        $credentials = [
            'driver' => "Ipsum",
            'admin_id' => $user->id,
            'company' => "COMPANY",
            'vehicle_id' => 1,
        ];

        // ACTION
        Sanctum::actingAs($user);
        $response = $this->post('/api/orders', $credentials);

        // ASSERT
        $response->assertStatus(201);
        $order = VehicleOrder::find($response->decodeResponseJson()['id']);
        $this->assertDatabaseHas('vehicle_orders', ['id' => $order->id]);

        // CLEANUP
        $user->delete();
        $order->delete();
    }

    public function test_put_order()
    {
        // SETUP
        $user = User::factory()->create(['role_id' => 1]);
        $order = VehicleOrder::factory()->create();
        $credentials = [
            'driver' => "Driver updated",
            'admin_id' => 1,
            'company' => "Company updated",
            'vehicle_id' => 2,
        ];

        // ACTION
        Sanctum::actingAs($user);
        $response = $this->put('/api/orders/' . $order->id, $credentials, [
            'content-type' => "x-www-form-urlencoded"
        ]);

        // ASSERT
        $response->assertStatus(200);
        $this->assertDatabaseHas('vehicle_orders', ['id' => $order->id, 'driver' => $credentials['driver']]);

        // CLEANUP
        $user->delete();
        $order->delete();                                                                   
    }
}
