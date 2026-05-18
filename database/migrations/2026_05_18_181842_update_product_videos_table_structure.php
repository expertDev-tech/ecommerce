<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table(
            'product_videos',
            function (Blueprint $table) {

                $table->string('title')
                    ->nullable()
                    ->after('product_id');

                $table->string('duration')
                    ->nullable()
                    ->after('thumbnail');

                $table->softDeletes();
            }
        );
    }

    public function down(): void
    {
        Schema::table(
            'product_videos',
            function (Blueprint $table) {

                $table->dropColumn([
                    'title',
                    'duration',
                ]);

                $table->dropSoftDeletes();
            }
        );
    }
};