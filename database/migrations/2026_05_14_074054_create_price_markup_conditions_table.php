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
        Schema::create('price_markup_conditions', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('price_markup_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('condition_type', [
                'role',
                'brand',
                'category',
                'collection',
                'product',
            ]);

            $table->unsignedBigInteger('reference_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_markup_conditions');
    }
};
