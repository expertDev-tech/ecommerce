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

            $table->enum('type', [

                'text',
                'textarea',
                'number',
                'select',
                'radio',
                'checkbox',
                'color',
                'date',

            ])->default('text')->change();

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('attributes', function (Blueprint $table) {

            $table->string('type')
                ->default('text')
                ->change();

            $table->dropSoftDeletes();
        });
    }
};