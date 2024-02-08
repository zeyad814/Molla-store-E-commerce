<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Admin::factory(30)->create();
        \App\Models\User::factory(30)->create();
        // \App\Models\Category::factory(10)->create();
        // \App\Models\Brand::factory(10)->create();
        // \App\Models\Product::factory(1000)->create();
        // \App\Models\Banner::factory(4)->create();
        // \App\Models\ProductImage::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
