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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('membership_id')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('role');
            $table->string('full_name')->nullable();
            $table->string('mobile')->nullable();
            $table->text('address')->nullable();
            $table->text('avatar')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->timestamps();
            $table->foreign('membership_id')->references('id')->on('memberships');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
