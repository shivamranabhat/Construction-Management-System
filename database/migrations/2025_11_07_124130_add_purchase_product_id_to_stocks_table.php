<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            // Add the column: nullable, unsignedBigInteger
            $table->foreignId('purchase_product_id')
                  ->nullable()
                  ->after('company_id') // or after any column you prefer
                  ->constrained('purchase_products')
                  ->onDelete('Cascade');
        });
    }

    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['purchase_product_id']);
            // Then drop the column
            $table->dropColumn('purchase_product_id');
        });
    }
};