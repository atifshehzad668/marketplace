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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->date('lead_date');
            $table->integer('lead_number');
            $table->string('lead_vehicle');
            $table->string('lead_source');
            $table->string('lead_status')->default(0);
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('saleman_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();

            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('saleman_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};