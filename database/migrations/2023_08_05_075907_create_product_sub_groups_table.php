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
        Schema::create('product_sub_groups', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBigInteger('product_group_id');
            $table->string('sub_group_name')->nullable();
            $table->timestamps();
            
            $table->foreign('product_group_id')->references('id')->on('product_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sub_groups');
    }
};
