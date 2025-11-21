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
       Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->string('requisition_number')->unique();
            $table->foreignId('project_id')->constrained();
            $table->foreignId('requested_by')->constrained('users');
            $table->date('required_date');
            $table->text('purpose')->nullable();
            $table->enum('status', [
                'draft', 'pending_pm', 'pm_approved', 'pending_procurement',
                'procurement_approved', 'pending_owner', 'owner_approved',
                'po_created', 'delivered', 'rejected'
            ])->default('draft');
            $table->text('rejection_reason')->nullable();
            $table->timestamps();

            $table->index(['company_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitions');
    }
};
