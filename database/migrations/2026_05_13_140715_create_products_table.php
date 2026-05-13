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
            $table->foreignId('brand_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');

            $table->string('slug')->unique();

            $table->string('sku')->unique();

            $table->string('barcode')->nullable();

            $table->decimal('price', 10, 2);

            $table->decimal('sale_price', 10, 2)->nullable();

            $table->integer('stock')->default(0);

            $table->decimal('weight', 8, 2)->nullable();

            $table->string('thumbnail')->nullable();

            $table->longText('description')->nullable();

            $table->longText('short_description')->nullable();

            $table->integer('view_count')->default(0);

            $table->boolean('featured')->default(false);

            $table->boolean('manage_stock')->default(true);

            $table->boolean('in_stock')->default(true);

            $table->boolean('status')->default(true);

            $table->timestamp('published_at')->nullable();
            
            $table->timestamps();
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
