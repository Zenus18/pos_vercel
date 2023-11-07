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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_membership_active')->default(false);
            $table->boolean('is_discount_percentage')->default(false);
            $table->integer('discount')->default(0);
            $table->boolean('is_minimum_purchase_active')->default(false);
            $table->integer('minimum_purchase')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
