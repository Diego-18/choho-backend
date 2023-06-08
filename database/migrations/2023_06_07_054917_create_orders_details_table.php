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
        Schema::create('orders_details', function (Blueprint $table) {
            $table->id();
            $table->string('prefix');
            $table->string('profile');
            $table->string('family');
            $table->string('group');
            $table->string('subgroup');
            $table->string('description');
            $table->string('subtotal');
            $table->string('iva');
            $table->string('total');
            $table
                ->foreignId('order_id')
                ->references('id')
                ->on('orders')
                ->nullable();
            $table
                ->foreignId('product_id')
                ->references('id')
                ->on('products')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_details');
    }
};
