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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('fee_no');
            $table->date('fee_date');
            $table->unsignedBigInteger('fee_template_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('academic_session_id');
            $table->unsignedBigInteger('academic_class_id');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->decimal('paid_amount', 10, 2)->nullable();
            $table->decimal('balance_amount', 10, 2)->nullable();
            $table->string('payment_mode')->nullable();
            $table->foreign('fee_template_id')->references('id')->on('fee_templates');
            $table->foreign('student_id')->references('id')->on('users');
            $table->timestamps();
        });
        Schema::create('fee_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fee_id');
            $table->unsignedBigInteger('fee_head_id');
            $table->integer('no_of_months')->nullable();
            $table->integer('monthly_fee_amount')->nullable();
            $table->string('months')->nullable(); // comma separated months e.g., Jan-Feb-Mar
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
        Schema::create('fee_details_months', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fee_detail_id');
            $table->string('month');
            $table->decimal('amount', 10, 2);
            $table->foreign('fee_detail_id')->references('id')->on('fee_details');
            $table->timestamps();
        });
        Schema::create('fee_receipt', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paid_by_user_id');
            $table->date('receipt_date');
            $table->decimal('amount', 10, 2);
            $table->string('payment_mode')->nullable();
            $table->string('receipt_no')->nullable();
            $table->string('receipt_note')->nullable();
            $table->boolean('is_system_receipt')->default(true);
            $table->timestamp('system_receipt_date')->nullable();
            $table->foreign('paid_by_user_id')->references('id')->on('users');
            $table->timestamps();
        });
        //fee and fee receipts has many to many relationship
        Schema::create('fee_fee_receipt', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fee_id');
            $table->unsignedBigInteger('fee_receipt_id');
            $table->foreign('fee_id')->references('id')->on('fees');
            // $table->foreign('fee_receipt_id')->references('id')->on('fee_receipts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees_fees_receipt');
        Schema::dropIfExists('fee_receipts');
        Schema::dropIfExists('fee_details_months');
        Schema::dropIfExists('fee_details');
        Schema::dropIfExists('fees');
    }
};
