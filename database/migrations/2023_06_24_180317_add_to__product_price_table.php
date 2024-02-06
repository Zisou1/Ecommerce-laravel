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
        Schema::table('product_prices', function (Blueprint $table) {
            $table->integer('250g_quantity')->nullable();
            $table->integer('500g_quantity')->nullable();
            $table->integer('750g_quantity')->nullable();
            $table->integer('1kg_quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('_product_price', function (Blueprint $table) {
            //
        });
    }
};
