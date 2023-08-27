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
        Schema::create('purchased_items', function (Blueprint $table) {
            $table->id(); // This will automatically create an auto-incrementing primary key (similar to INT PRIMARY KEY).
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('item_barcode', 50)->nullable();
            $table->unsignedBigInteger('purchases_id');
            $table->string('item_name', 100);
            $table->integer('quantity');
            $table->decimal('price_per_unit', 10, 2);
            $table->decimal('total_pricewithvat', 10, 2);
            $table->timestamps(); // This will automatically add created_at and updated_at columns.

            // Define foreign key constraint for purchases_id referencing Purchases table
            $table->foreign('purchases_id')->references('id')->on('purchases');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchased_items');
    }
};
