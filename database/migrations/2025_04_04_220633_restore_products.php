<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $products = [
            [
                'name' => 'iPhone 16',
                'price' => 999.99,
                'desc' => 'The latest iPhone with advanced features and powerful performance',
                'quantity' => 15,
                'image' => 'products/iphone16.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laptop',
                'price' => 1299.99,
                'desc' => 'High-performance laptop with long battery life and stunning display',
                'quantity' => 10,
                'image' => 'products/laptop.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Watch 5',
                'price' => 299.99,
                'desc' => 'Smartwatch with health tracking and notifications',
                'quantity' => 20,
                'image' => 'products/watch5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Product::whereIn('name', ['iPhone 16', 'Laptop', 'Watch 5'])->delete();
    }
};
