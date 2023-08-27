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
        Schema::create('customer_group_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_group_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('customer_code')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('source')->nullable();
            $table->timestamps();
    
            $table->foreign('customer_group_id')->references('id')->on('customer_groups');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_group_members');
    }
};
