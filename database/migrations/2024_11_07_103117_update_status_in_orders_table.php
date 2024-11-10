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
        Schema::table('orders', function (Blueprint $table) {
            // Alter the 'status' column to include 'Shipping'
            $table->enum('status', ['Pending', 'Delivered', 'Shipping'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Revert the 'status' column to its original values
            $table->enum('status', ['Pending', 'Delivered'])->change();
        });
    }
};
