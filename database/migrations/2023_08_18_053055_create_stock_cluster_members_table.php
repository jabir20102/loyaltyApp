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
        Schema::create('stock_cluster_members', function (Blueprint $table) {
            $table->id();
            $table->integer('stock_cluster_id')->nullable();
            $table->string('stock_code')->nullable();
            $table->boolean('is_included')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_cluster_members');
    }
};
