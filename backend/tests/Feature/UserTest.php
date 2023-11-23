<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Get XSRF-TOKEN
     */
    public function test_get_xsrf_token(): void
    {
        $response = $this->get('/sanctum/csrf-cookie');
    
        $response->assertStatus(204);
        $this->assertNotNull($response->getCookie('XSRF-TOKEN')->getValue());
    }

    /**
     * Login test sucess
     */
    public function test_login(): void
    {
        $user = User::create([
            'name' => "admin0",
            'username' => "admin0",
            'password' => "password",
            'role_id' => 1
        ]);

        $token = $this->get('/sanctum/csrf-cookie')->getCookie("XSRF-TOKEN")->getValue();
        $this->assertNotNull($token);

        $response = $this->post('/api/login', [
            'username' => $user->username,
            'password' => 'password'
        ], [
            'accept' => 'application/json',
            'X-XSRF-TOKEN' => $token,
        ]);

        $response->assertStatus(204);
        $user->delete();
    }

    /**
     * Login test failed with invalid credential
     */
    public function test_login_invalid(): void
    {
        $token = $this->get('/sanctum/csrf-cookie')->getCookie("XSRF-TOKEN")->getValue();
        $this->assertNotNull($token);

        $response = $this->post('/api/login', [
            'username' => 'admin01',
            'password' => 'admin011'
        ], [
            'accept' => 'application/json',
            'X-XSRF-TOKEN' => $token,
        ]);
        
        $response->assertStatus(401);        
    }
}
