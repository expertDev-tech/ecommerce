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
        Schema::create('price_markups', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->enum('calculation_type', [
                'percentage',
                'fixed',
            ]);

            $table->decimal('amount', 10, 2);

            $table->integer('priority')->default(0);

            $table->boolean('stop_further_rules')->default(false);

            $table->boolean('status')->default(true);

            $table->timestamp('start_date')->nullable();

            $table->timestamp('end_date')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_markups');
    }
};
