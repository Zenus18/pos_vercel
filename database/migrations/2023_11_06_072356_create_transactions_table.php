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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cashier_id')->nullable();
            $table->unsignedBigInteger('member_id')->nullable();
            $table->unsignedBigInteger('payment_id');
            $table->string('transaction_number');
            $table->date('date');
            $table->string('transaction_report')->nullable();
            $table->text('notes')->nullable();
            $table->integer('sub_total')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('total')->default(0);
            $table->integer('return')->default(0);
            $table->timestamps();
            $table->foreign('cashier_id')->references('id')->on('users');
            $table->foreign('member_id')->references('id')->on('users');
            $table->foreign('payment_id')->references('id')->on('payment_methods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
