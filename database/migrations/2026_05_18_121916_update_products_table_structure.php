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
        Schema::table('products', function (Blueprint $table) {

            $table->renameColumn(
                'featured',
                'is_featured'
            );

            $table->decimal(
                'cost_price',
                10,
                2
            )->nullable()
                ->after('sale_price');


            $table->string('meta_title')
                ->nullable()
                ->after('short_description');

            $table->text('meta_description')
                ->nullable()
                ->after('meta_title');

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->renameColumn(
                'is_featured',
                'featured'
            );

            $table->dropColumn([
                'cost_price',
                'meta_title',
                'meta_description',
            ]);

            $table->dropSoftDeletes();
        });
    }
};