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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamp('order_date');
            $table->string('prefix');
            $table->integer('order_number');
            $table->string("seller");
            $table
                ->foreignId('provider_id')
                ->references('id')
                ->on('providers')
                ->nullable();
            $table
                ->foreignId('department_id')
                ->references('id')
                ->on('departments')
                ->nullable();
            $table
                ->foreignId('city_id')
                ->references('id')
                ->on('cities')
                ->nullable();
            $table
                ->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
