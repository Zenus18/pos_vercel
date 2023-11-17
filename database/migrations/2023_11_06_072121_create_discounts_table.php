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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_discount_active')->default(false);
            $table->boolean('is_discount_percentage')->default(false);
            $table->integer('discount')->default(0);
            $table->boolean('is_discount_expired')->default(false);
            $table->boolean('is_discount_of_amount')->default(false);
            $table->integer('amount_discount')->default(0);
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
