<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->adminUser()->create();
        User::factory()->frontendUser()->create();
        User::factory(5)->create();
    }
}
