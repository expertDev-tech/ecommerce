<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    public function up(): void
    {

        DB::table('products')
            ->where('status', 1)
            ->update([
                'status' => 'active',
            ]);

        DB::table('products')
            ->where('status', 0)
            ->update([
                'status' => 'draft',
            ]);

        Schema::table(
            'products',
            function (Blueprint $table) {

                $table->enum('status', [

                    'draft',
                    'active',
                    'inactive',
                    'archived',

                ])->default('draft')
                    ->change();
            }
        );
    }

    public function down(): void
    {

        DB::table('products')
            ->where('status', 'active')
            ->update([
                'status' => 1,
            ]);

        DB::table('products')
            ->whereIn('status', [
                'draft',
                'inactive',
                'archived',
            ])
            ->update([
                'status' => 0,
            ]);

        Schema::table(
            'products',
            function (Blueprint $table) {

                $table->boolean('status')
                    ->default(false)
                    ->change();
            }
        );
    }
};