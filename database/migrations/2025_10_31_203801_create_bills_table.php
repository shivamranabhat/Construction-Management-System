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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->date('bill_date')->default(now());
            $table->string('bill_number');
            $table->unsignedBigInteger('entered_by');
            $table->foreign('entered_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('project_id'); 
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');  
            $table->unsignedBigInteger('company_id'); 
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');  
            $table->unsignedBigInteger('vendor_id')->nullable(); 
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');  
            $table->string('status')->default('UNPAID'); // UNPAID, APPROVED, REJECTED
            $table->decimal('total_price', 15, 2)->default(0);
            $table->text('notes')->nullable();
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
