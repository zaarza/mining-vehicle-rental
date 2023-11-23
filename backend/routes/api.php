<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(UserController::class)->group(function () {
  Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->group(function() {
  Route::controller(VehicleController::class)->group(function () {
      Route::get('/vehicles/{id?}', 'get');
      Route::post('/vehicles', 'post');
      Route::delete('/vehicles/{id}', 'delete');
      Route::put('/vehicles/{id}', 'put');
  });
});