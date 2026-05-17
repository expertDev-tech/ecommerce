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
        Schema::table('attributes', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Remove Old Slug Unique
            |--------------------------------------------------------------------------
            */

            $table->dropUnique('attributes_slug_unique');

            /*
            |--------------------------------------------------------------------------
            | Add Composite Unique
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'category_id',
                'slug'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attributes', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Remove Composite Unique
            |--------------------------------------------------------------------------
            */

            $table->dropUnique([
                'category_id',
                'slug'
            ]);

            /*
            |--------------------------------------------------------------------------
            | Restore Old Unique
            |--------------------------------------------------------------------------
            */

            $table->unique('slug');
        });
    }
};