<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * User Login
     */
    public function login(UserLoginRequest $request)
    {
        $data = $request->validated();

        if (!Auth::attempt($data)) {
            // Invalid credentials
            Log::notice("Invalid login detected", [$request->header('User-Agent'), $request->ip()]);
            throw new HttpResponseException(response()->json([
                'message' => 'Invalid credentials',
            ], 401));
        } else {
            // Valid credentials
            Log::info('Logged in : ' . $data['username'], [$request->header('User-Agent'), $request->ip()]);
            return response(null, 204);
        }
    }
}
