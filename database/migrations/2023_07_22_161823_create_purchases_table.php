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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id(); // This will automatically create an auto-incrementing primary key (similar to INT PRIMARY KEY).
            $table->date('purchase_date');
            $table->string('customer_code', 50);
            $table->string('branch_id', 50);
            $table->string('device_id', 50);
            $table->decimal('total_amount', 10, 2);
            $table->decimal('total_vatamount', 10, 2);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
