<?php

namespace Tests\Unit;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Tymon\JWTAuth\JWTAuth;

class UserServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function test_register(): void
    {
        $userRepo = $this->createMock(UserRepository::class);
        $userRepo->method('createRecord')->willReturn(new User(['email' => 'user@test.com']));

        $userService = new UserService($userRepo);
        $user = $userService->register(['email' => 'user@test.com']);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('user@test.com', $user->email);
    }

    public function test_authentication(): void
    {
        $user = User::factory()->create([
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
        ]);
        $credentials = ['email' => 'user@test.com', 'password' => 'password'];

        $userRepo = $this->createMock(UserRepository::class);
        $userRepo->method('findRecordById')->willReturn($user);

        $userService = new UserService($userRepo);
        $authData = $userService->authenticate($credentials);

        $this->assertArrayHasKey('access_token', $authData);
        $this->assertArrayHasKey('user', $authData);
    }

    public function test_logout(): void
    {
        $user = User::factory()->create(['email' => 'admin@example.com', 'password' => bcrypt('password')]);

        $userRepo = $this->createMock(UserRepository::class);
        $userRepo->method('findRecordById')->willReturn($user);

        $jwtAuth = $this->createMock(JWTAuth::class);
        $jwtAuth->method('parseToken')->willReturn($jwtAuth);
        $jwtAuth->method('authenticate')->willReturn($user);
        $jwtAuth->method('invalidate')->willReturn(true);
        $jwtAuth->method('check')->willReturn(false);

        $userService = new UserService($userRepo);

        Auth::shouldReceive('guard')->andReturn($jwtAuth);
        Auth::shouldReceive('logout')->andReturn(true);

        $userService->logout();

        $this->assertGuest();
    }
}
