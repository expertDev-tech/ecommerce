<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table(
            'product_collections',
            function (Blueprint $table) {

                $table->renameColumn(
                    'featured',
                    'is_featured'
                );

                $table->string('image')
                    ->nullable()
                    ->after('slug');

                $table->string('meta_title')
                    ->nullable()
                    ->after('status');

                $table->text('meta_description')
                    ->nullable()
                    ->after('meta_title');

                $table->softDeletes();
            }
        );

        Schema::table(
            'collection_product',
            function (Blueprint $table) {

                $table->unique([
                    'product_collection_id',
                    'product_id',
                ], 'collection_product_unique');
            }
        );
    }

    public function down(): void
    {
        Schema::table(
            'product_collections',
            function (Blueprint $table) {

                $table->renameColumn(
                    'is_featured',
                    'featured'
                );

                $table->dropColumn([
                    'image',
                    'meta_title',
                    'meta_description',
                ]);

                $table->dropSoftDeletes();
            }
        );

        Schema::table(
            'collection_product',
            function (Blueprint $table) {

                $table->dropUnique(
                    'collection_product_unique'
                );
            }
        );
    }
};