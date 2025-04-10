<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migration is now handled by the UserSeeder
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to remove users in down migration
    }
};
