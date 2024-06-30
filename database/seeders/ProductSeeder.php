<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categoryIds = Category::all()->pluck('id')->toArray();

        Product::factory(50)->create([
            'category_id' => function () use ($categoryIds) {
                return $categoryIds[array_rand($categoryIds)];
            },
        ]);
    }
}
