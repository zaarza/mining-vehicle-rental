<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleOrderPostRequest;
use App\Http\Requests\VehicleOrderPutRequest;
use App\Models\VehicleOrder;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VehicleOrderController extends Controller
{
    /**
     * Get orders
     */
    public function get(Request $request, string $id = null): JsonResponse|Response
    {
        if ($id === null) {
            $is_approved = $request->get('is_approved');
            $result = DB::table('vehicle_orders')
                ->when($is_approved, function ($query, $is_approved) {
                    $query->where('is_approved', '=', $is_approved);
                })
                ->paginate(10);

            return response()->json($result);
        } else {
            $order = VehicleOrder::find($id);

            if ($order === null) {
                return response(null, 404);
            } else {
                return response()->json($order);
            }
        }
    }

    /**
     * Post new order
     */
    public function post(VehicleOrderPostRequest $request): JsonResponse|Response
    {
        $data = $request->validated();

        try {
            $order = VehicleOrder::create($data);
            Log::info('Order created', [$request->user()->name, $order->id]);

            return response()->json($order, 201);
        } catch (Exception $exception) {
            Log::info('Failed to create order', [$request->user()->name, $exception->getMessage()]);

            return response()->json([
                'message' => 'Failed to create order'
            ], 500);
        }
    }

    /**
     * Update order information
     */
    public function put(VehicleOrderPutRequest $request, string $id): JsonResponse|Response
    {
        $data = $request->validated();

        $order = VehicleOrder::find($id);
        
        if ($order === null) {
            return response(null, 404);
        }

        try {
            $order->fill($data);
            $order->save();
            Log::info('Order updated', [$request->user()->name, $id]);    

            return response()->json($order);
        } catch (Exception $exception) {
            Log::error('Update order failed', [$request->user()->name, $exception->getMessage()]);

            return response()->json([
                'message' => 'Faied to update order'
            ], 500);
        }
    }
}
