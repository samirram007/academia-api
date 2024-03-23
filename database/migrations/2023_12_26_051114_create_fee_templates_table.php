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
        Schema::create('fee_heads', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
        Schema::create('fee_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('academic_session_id');
            $table->unsignedBigInteger('campus_id');
            $table->unsignedBigInteger('academic_class_id');
            $table->foreign('campus_id')->references('id')->on('campuses');
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions');
            $table->foreign('academic_class_id')->references('id')->on('academic_classes');
            $table->timestamps();
        });
        Schema::create('fee_template_details', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_index')->default(1);
            $table->unsignedBigInteger('fee_template_id');
            $table->unsignedBigInteger('fee_head_id');
            $table->decimal('amount', 10, 2);
            $table->boolean('is_customizable')->default(true);
            $table->boolean('keep_periodic_details')->default(false);
            $table->foreign('fee_template_id')->references('id')->on('fee_templates');
            $table->foreign('fee_head_id')->references('id')->on('fee_heads');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_template_details');
        Schema::dropIfExists('fee_templates');
        Schema::dropIfExists('fee_heads');
    }
};
