<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'iPhone 16',
                'description' => 'Latest iPhone model with advanced features and cutting-edge technology.',
                'price' => 1299.99,
                'image' => 'products/dXcShnt6ZvDrQ6hEh318AeZJygGOZlQBzNBgCoe1.png',
                'quantity' => 50,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Premium Laptop',
                'description' => 'High-performance laptop with powerful specifications for professional use.',
                'price' => 1599.99,
                'image' => 'products/eAidRC2CqiZDTAxgHYWIids5h6fnekT7OkJFdmiG.png',
                'quantity' => 30,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Watch 5',
                'description' => 'Smart watch with health monitoring and fitness tracking features.',
                'price' => 399.99,
                'image' => 'products/Watch 5.png',
                'quantity' => 100,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('products')->insert($products);
    }
}
