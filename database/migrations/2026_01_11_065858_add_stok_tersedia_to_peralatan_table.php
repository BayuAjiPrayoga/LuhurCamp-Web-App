<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('peralatan', function (Blueprint $table) {
            $table->integer('stok_tersedia')->after('stok_total')->nullable();
        });

        // Initialize stok_tersedia with existing stok_total
        DB::statement('UPDATE peralatan SET stok_tersedia = stok_total');

        // Make it non-nullable after population
        Schema::table('peralatan', function (Blueprint $table) {
            $table->integer('stok_tersedia')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peralatan', function (Blueprint $table) {
            $table->dropColumn('stok_tersedia');
        });
    }
};
