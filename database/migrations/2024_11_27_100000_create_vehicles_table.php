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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle');
            $table->string('vehicle_brand');
            $table->string('model');
            $table->year('year');
            $table->string('mileage');
            $table->date('date_of_sale');
            $table->string('sale_rep');

            $table->unsignedBigInteger('saleman_id')->nullable();


            $table->timestamps();
            $table->foreign('saleman_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
