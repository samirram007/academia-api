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
        Schema::create('transport_pickup_drops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('pickup_drop_points_id')->nullable();
            $table->unsignedBigInteger('pickup_drop_datetime')->nullable();
            $table->unsignedBigInteger('transport_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_pickup_drops');
    }
};
