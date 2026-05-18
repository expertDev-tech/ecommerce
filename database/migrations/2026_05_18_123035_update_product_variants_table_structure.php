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
        Schema::table('product_variants', function (Blueprint $table) {

            $table->decimal(
                'cost_price',
                10,
                2
            )->nullable()
                ->after('sale_price');


            $table->string('barcode')
                ->nullable()
                ->after('sku');

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {

            $table->dropColumn([
                'barcode',
                'cost_price',
            ]);

            $table->dropSoftDeletes();
        });
    }
};