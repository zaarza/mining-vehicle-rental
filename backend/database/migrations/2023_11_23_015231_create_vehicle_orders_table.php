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
        Schema::create('vehicle_orders', function (Blueprint $table) {
            $table->ulid('id');
            $table->string('driver');
            $table->string('company');
            $table->string('admin_id');
            $table->string('vehicle_id');
            $table->boolean('is_approved')->nullable();
            $table->integer('created_at');
            $table->integer('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_orders');
    }
};
