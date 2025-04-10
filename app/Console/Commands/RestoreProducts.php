<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RestoreProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:restore';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restore the default products to the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // Insert the products
            $products = [
                [
                    'name' => 'iPhone 16',
                    'description' => 'Latest iPhone with advanced features and improved camera',
                    'price' => 1299.99,
                    'image' => 'iphone16.jpg',
                    'quantity' => 40,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Laptop',
                    'description' => 'High-performance laptop for work and entertainment',
                    'price' => 1199.99,
                    'image' => 'laptop.jpg',
                    'quantity' => 25,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Watch 5',
                    'description' => 'Smart watch with health monitoring and fitness tracking',
                    'price' => 349.99,
                    'image' => 'watch5.jpg',
                    'quantity' => 60,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];

            // Delete existing products with these names
            $productNames = array_column($products, 'name');
            DB::table('products')->whereIn('name', $productNames)->delete();

            // Insert new products
            foreach ($products as $product) {
                DB::table('products')->insert($product);
            }

            $this->info('Products have been restored successfully!');
            
        } catch (\Exception $e) {
            $this->error('Error restoring products: ' . $e->getMessage());
        }
    }
}
