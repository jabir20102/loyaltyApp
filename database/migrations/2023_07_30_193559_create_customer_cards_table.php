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
        Schema::create('customer_cards', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('customer_id'); // Foreign key column
            $table->string('cc_card_no')->unique();
            $table->boolean('cc_isValid')->default(true);
            $table->date('cc_validFrom')->nullable();
            $table->date('cc_validTo')->nullable();
            $table->decimal('cc_total_earn', 10, 2)->nullable();
            $table->decimal('cc_total_spent', 10, 2)->nullable();
            $table->string('cc_type')->nullable();
            $table->string('cc_status')->nullable();
            $table->dateTime('cc_createdate')->nullable();
            $table->dateTime('cc_update')->nullable();
            $table->timestamps();
            
            $table->foreign('customer_id') // Foreign key constraint
                ->references('id')
                ->on('Customers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_cards');
    }
};
