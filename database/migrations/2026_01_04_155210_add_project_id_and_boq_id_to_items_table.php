<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id')->nullable()->after('category_id');
            $table->unsignedBigInteger('boq_id')->nullable()->after('project_id');

            $table->foreign('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $table->foreign('boq_id')->references('id')->on('boqs')->cascadeOnDelete();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            //
        });
    }
};
