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
        Schema::table('rooms', function (Blueprint $table) {
            $table->decimal('price', 12, 2)->change();
            $table->decimal('price_6_months', 12, 2)->nullable()->after('price');
            $table->decimal('price_yearly', 12, 2)->nullable()->after('price_6_months');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['price_6_months', 'price_yearly']);
            $table->integer('price')->change();
        });
    }
};
