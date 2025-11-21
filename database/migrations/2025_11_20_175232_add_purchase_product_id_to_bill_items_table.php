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
        Schema::table('bill_items', function (Blueprint $table) {
            // Add the column (nullable first for existing data)
            $table->unsignedBigInteger('purchase_product_id')->nullable()->after('item_id');

            // Add foreign key constraint
            $table->foreign('purchase_product_id')
                  ->references('id')
                  ->on('purchase_products')
                  ->onDelete('set null'); // If purchase product deleted, unlink
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bill_items', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['purchase_product_id']);
            
            // Then drop the column
            $table->dropColumn('purchase_product_id');
        });
    }
};
