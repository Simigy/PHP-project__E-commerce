<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'iPhone 16',
                'desc' => 'Latest iPhone with advanced features and improved camera',
                'price' => 1299.99,
                'image' => 'iphone16.jpg',
                'quantity' => 40,
            ],
            [
                'name' => 'Laptop',
                'desc' => 'High-performance laptop for work and entertainment',
                'price' => 1199.99,
                'image' => 'laptop.jpg',
                'quantity' => 25,
            ],
            [
                'name' => 'Watch 5',
                'desc' => 'Smart watch with health monitoring and fitness tracking',
                'price' => 349.99,
                'image' => 'watch5.jpg',
                'quantity' => 60,
            ],
            [
                'name' => 'Wireless Headphones',
                'description' => 'Premium noise-cancelling headphones',
                'price' => 299.99,
                'image' => 'headphones.jpg',
                'category' => 'Audio',
                'stock' => 100,
            ],
            [
                'name' => 'Wireless Earbuds',
                'description' => 'True wireless earbuds with charging case',
                'price' => 149.99,
                'image' => 'earbuds.jpg',
                'category' => 'Audio',
                'stock' => 120,
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert(array_merge($product, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }
    }
}
