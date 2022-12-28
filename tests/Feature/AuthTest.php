<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use WithFaker;

    private const BASE_API = '/api/users/auth';

    /**
     * Test auth login.
     *
     * @return void
     */
    public function test_auth_register()
    {
        $data = [
            'email' => 'myemail@email.com',
            'name' => 'Test Username',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson(self::BASE_API . '/register', $data);

        $response->assertStatus(200);
    }


    /**
     * Test auth login.
     *
     * @return void
     */
    public function test_auth_login()
    {
        $data = [
            'email' => 'myemail@email.com',
            'password' => 'password',
        ];

        $response = $this->postJson(self::BASE_API . '/login', $data);

        $response->assertStatus(200);
    }
}
