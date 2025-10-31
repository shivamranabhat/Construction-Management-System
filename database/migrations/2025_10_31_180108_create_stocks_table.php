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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->decimal('stock', 15, 2)->default(0);
            $table->unsignedBigInteger('project_id')->nullable(); 
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');  
            $table->unsignedBigInteger('company_id')->nullable(); 
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');  
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
