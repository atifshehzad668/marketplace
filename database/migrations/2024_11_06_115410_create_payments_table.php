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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('trx_id');
            $table->decimal('amount', 15, 2);
            $table->enum('payment_method', ['credit_card', 'paypal', 'stripe', 'other']);
            $table->enum('status', ['pending', 'successful', 'failed'])->default('pending');
            $table->text('gateway_response');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};