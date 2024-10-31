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
        Schema::create('listing_bump_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('listing_id');
            $table->timestamp('last_dump')->useCurrent();

            $table->timestamps();
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_bump_schedules');
    }
};