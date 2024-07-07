<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_create_user(): void
    {
        $response = $this->postJson('/api/v1/user/register', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'avatar' => 'uuid',
            'address' => '123 Street',
            'phone_number' => '1234567890',
            'is_marketing' => 0,
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'first_name',
                'last_name',
                'email',
                'avatar',
                'address',
                'phone_number',
                'is_marketing',
                'uuid',
                'created_at',
                'updated_at',
            ],
        ]);
    }

    public function test_create_user_with_existing_email(): void
    {
        $this->postJson('/api/v1/user/register', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'avatar' => 'uuid',
            'address' => '123 Street',
            'phone_number' => '1234567890',
            'is_marketing' => 0,
        ])->assertStatus(201);

        $response = $this->postJson('/api/v1/user/register', [
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'john.doe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'avatar' => 'uuid',
            'address' => '456 Avenue',
            'phone_number' => '0987654321',
            'is_marketing' => 1,
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'errors' => [
                'email',
            ],
        ]);
    }

    public function testLoginUser(): void
    {
        User::factory()->create([
            'email' => 'john.doe@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/v1/user/login', [
            'email' => 'john.doe@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'access_token',
                'user' => [
                    'uuid',
                    'first_name',
                    'last_name',
                    'is_admin',
                    'email',
                    'email_verified_at',
                    'avatar',
                    'address',
                    'phone_number',
                    'is_marketing',
                    'created_at',
                    'updated_at',
                    'last_login_at',
                ],
            ],
        ]);
    }
}
