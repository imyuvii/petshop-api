<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'avatar' => fake()->name(),
            'address' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'is_marketing' => false,
            'is_admin' => false,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('userpassword'),
        ];
    }

    public function adminUser(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_admin' => true,
            'email' => 'admin@buckhill.co.uk',
            'password' => Hash::make('admin'),
        ]);
    }

    public function frontendUser(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_admin' => false,
            'email' => 'frontend@buckhill.co.uk',
            'password' => Hash::make('userpassword'),
        ]);
    }

    public function unverifiedUser(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function isMarketing(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_marketing' => true,
        ]);
    }
}
