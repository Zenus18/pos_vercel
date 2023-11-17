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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->string('barcode')->nullable();
            $table->string('sku')->nullable();
            $table->string('name');
            $table->text('image')->nullable();
            $table->text('description')->nullable();
            $table->integer('capital_price')->default(0)->nullable();
            $table->integer('selling_price')->default(0);
            $table->boolean('is_qty_active')->default(true);
            $table->integer('qty_available')->default(0);
            $table->integer('qty_minimum')->default(10);
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('discount_id')->references('id')->on('discounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
