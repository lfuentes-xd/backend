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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('IdUserFK');
            $table->foreign('IdUserFK')->references('id')->on('users');

            $table->unsignedBigInteger('IdFoodFK');
            $table->foreign('IdFoodFK')->references('id')->on('food');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
