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
        Schema::create('included_subgroups', function (Blueprint $table) {
            $table->id();
            $table->string('subgroup_name')->nullable();
            $table->string('created_by')->nullable();
            
            $table->string('cluster_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('included_subgroups');
    }
};
