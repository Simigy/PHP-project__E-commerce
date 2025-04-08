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
            'iPhone 16' => 'products/Iphone 16.png',
            'Laptop' => 'products/Laptop.png',
            'Watch 5' => 'products/Watch 5.png'
        ];

        foreach ($products as $name => $image) {
            Product::where('name', $name)->update(['image' => $image]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $products = [
            'iPhone 16' => 'products/iphone16.jpg',
            'Laptop' => 'products/laptop.jpg',
            'Watch 5' => 'products/watch5.jpg'
        ];

        foreach ($products as $name => $image) {
            Product::where('name', $name)->update(['image' => $image]);
        }
    }
};
