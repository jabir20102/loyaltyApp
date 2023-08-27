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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('name1')->nullable();
            $table->string('name2')->nullable();
            $table->string('name3')->nullable();
            $table->string('type_id')->nullable();
            $table->string('special_code1')->nullable();
            $table->string('special_code2')->nullable();
            $table->string('special_code3')->nullable();
            $table->string('category_id')->nullable();
            $table->string('product_group_id')->nullable();
            $table->string('product_subgroup_id')->nullable();              
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::dropIfExists('products');
    }
};
