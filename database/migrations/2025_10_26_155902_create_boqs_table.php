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
        Schema::create('boqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('serial_number')->nullable();
            $table->text('item_description')-nullable();
            $table->string('unit')->nullable();
            $table->decimal('quantity', 10, 2)->nullable();
            $table->decimal('unit_rate', 10, 2)->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->unsignedBigInteger('parent_id')->nullable(); // for subcategory
            $table->text('remarks')->nullable();
            $table->foreign('parent_id')->references('id')->on('boqs')->onDelete('cascade');
            $table->unsignedBigInteger('company_id')->nullable(); 
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boqs');
    }
};
