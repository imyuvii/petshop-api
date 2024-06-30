<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function register(array $data): Model
    {
        return $this->userRepository->createRecord($data);
    }

    /**
     * @param  array<string, mixed>  $credentials
     * @return array<string, mixed>
     *
     * @throws AuthenticationException
     */
    public function authenticate(array $credentials): array
    {
        if (! $token = auth()->attempt($credentials)) {
            throw new AuthenticationException('Login failed');
        }

        $user = auth()->user();
        if (! $user) {
            throw new AuthenticationException('User not found');
        }

        $this->userRepository->updateRecordById(['last_login_at' => now()], (int) $user->id);

        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => $this->userRepository->findRecordById((int) $user->id),
        ];
    }
}
