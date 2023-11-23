<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehiclePostRequest;
use App\Http\Requests\VehiclePutRequest;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VehicleController extends Controller
{
    /**
     * Get all vehicles or specific vehicle
     */
    public function get(Request $request, string $id = null): JsonResponse
    {
        // Return all vehicles if id not given
        if (!$id) {
            $category = $request->get('category');
            $company = $request->get('company');
            $brand = $request->get('brand');
            $search = $request->get('search');

            $result = DB::table('vehicles')
                ->when($search, function($query, string $search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                })
                ->when($category, function($query, string $category) {
                    $query->where('category_id', '=', $category);
                })
                ->when($company, function($query, string $company) {
                    $query->where('company', '=', $company);
                })
                ->when($brand, function($query, string $brand) {
                    $query->where('brand', '=', $brand);
                })
                ->paginate(10);

            Log::info('Get vehicles', [$request->user()->name]);
            return response()->json($result);
        } else {
            $result = Vehicle::where(['id' => $id])->first();

            if ($result === null) {
                Log::info("Get vehicle not found", [$request->user()->name, $id]);
                throw new HttpResponseException(response(null, 404));
            }

            return response()->json($result);
        }
    }

    /**
     * Add new vehicle
     */
    public function post(VehiclePostRequest $request): JsonResponse
    {
        $data = $request->validated();
        
        try {
            $vehicle = Vehicle::create($data);
            Log::info("Added new vehicle", [$request->user()->name, $vehicle]);
            return response()->json($vehicle, 201);
        } catch (Exception $exception) {
            Log::error("Failed adding vehicle", [$request->user()->name, $exception->getMessage()]);
            return response()->json([
                'message' => 'Failed adding vehicle',
            ]);
        }
    }

    /**
     * Delete vehicle by id
     */
    public function delete(string $id, Request $request): JsonResponse|Response
    {
        $vehicle = Vehicle::find($id);

        // Vehicle not found
        if ($vehicle === null) {
            Log::info("Deleting invalid vehicle", [$request->user()->name, $id]);
            return response(null, 404);
        } else {
            try {
                $vehicleName = $vehicle->name;
                $vehicle->delete();
                Log::info("Vehicle deleted", [$request->user()->name, $vehicleName]);
                return response(null, 204);
            } catch (Exception $exception) {
                Log::error("Failed deleting vehicle", [$request->user()->name, $exception->getMessage()]);
                throw new HttpResponseException(response()->json([
                    'message' => "Failed deleting vehicle",
                ], 500));
            };

            return response()->json($vehicle);
        }
    }

    /**
     * Update vehicle information
     */
    public function put(string $id, VehiclePutRequest $request): JsonResponse|Response
    {
        $data = $request->validated();
        $vehicle = Vehicle::find($id);

        if ($vehicle === null) {
            return response(null, 404);
        } else {
            try {
                $vehicle->fill($data);
                $vehicle->save();
                Log::info("Updated vehicle information", [$request->user()->name, $vehicle->name]);
                return response()->json($vehicle);

            } catch (Exception $exception) {
                Log::error("Update vehicle information failed", [$request->user()->name, $exception->getMessage()]);

                return response()->json([
                    'message' => "Update vehicle information failed",
                ], 500);
            }
        }
    }
}
