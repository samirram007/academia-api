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
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('registration_no')->nullable();
            $table->date('registration_date')->nullable();
            $table->date('registration_valid_date')->nullable();
            $table->string('chasis_no')->nullable();
            $table->string('engine_no')->nullable();
            $table->string('color')->nullable();
            $table->integer('capacity')->default(50);
            $table->string('insurance_no')->nullable();
            $table->date('insurance_date')->nullable();
            $table->date('insurance_valid_date')->nullable();
            $table->integer('insured_value')->default(50);
            $table->integer('purchase_cost')->default(50);
            $table->unsignedBigInteger('transport_type_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transports');
    }
};
