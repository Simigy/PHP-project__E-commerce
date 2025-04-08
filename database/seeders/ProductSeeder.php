<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Sample Product 1',
                'price' => 99.99,
                'desc' => 'This is a sample product description 1',
                'quantity' => 10,
                'image' => 'products/sample1.jpg',
            ],
            [
                'name' => 'Sample Product 2',
                'price' => 149.99,
                'desc' => 'This is a sample product description 2',
                'quantity' => 15,
                'image' => 'products/sample2.jpg',
            ],
            [
                'name' => 'Sample Product 3',
                'price' => 199.99,
                'desc' => 'This is a sample product description 3',
                'quantity' => 20,
                'image' => 'products/sample3.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
