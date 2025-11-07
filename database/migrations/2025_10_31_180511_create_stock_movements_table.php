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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('IN'); // IN or OUT
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->decimal('quantity', 15, 2)->default(0);
            $table->decimal('unit_cost', 15, 2)->default(0);
            $table->date('date')->default(now());
            $table->unsignedBigInteger('entered_by');
            $table->foreign('entered_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('purchase_product_id');
            $table->foreign('purchase_product_id')->references('id')->on('purchase_products')->onDelete('cascade');
            $table->unsignedBigInteger('project_id'); 
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');  
            $table->unsignedBigInteger('company_id'); 
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');  
            $table->unsignedBigInteger('vendor_id')->nullable(); 
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');  
            $table->string('status')->default('PENDING'); // PENDING, APPROVED, REJECTED
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
