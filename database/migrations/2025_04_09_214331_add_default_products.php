<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // If we're trying to create a table, add the check
        if (strpos($this->getPathContent(), 'Schema::create') !== false) {
            // Modify the function to check if the table exists
            $matches = [];
            preg_match('/Schema::create\(\'([^\']+)\'/', $this->getPathContent(), $matches);
            if (isset($matches[1])) {
                $tableName = $matches[1];
                if (Schema::hasTable($tableName)) {
                    return; // Skip this migration if the table already exists
                }
            }
        }
        
        DB::table('products')->insert([
            [
                'name' => 'iPhone 16',
                'description' => 'Latest iPhone model with advanced features',
                'price' => 999.99,
                'image' => 'iphone16.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Laptop',
                'description' => 'High-performance laptop for work and gaming',
                'price' => 1299.99,
                'image' => 'laptop.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Watch 5',
                'description' => 'Smart watch with health monitoring features',
                'price' => 299.99,
                'image' => 'watch5.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('products')->whereIn('name', ['iPhone 16', 'Laptop', 'Watch 5'])->delete();
    }

    /**
     * Get the contents of the migration file
     */
    protected function getPathContent()
    {
        return file_get_contents(__FILE__);
    }
};
