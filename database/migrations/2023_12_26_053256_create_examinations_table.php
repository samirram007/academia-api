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
        Schema::create('examinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'examination_type_id')->constrained(table: 'examination_types')->onDelete(action: 'cascade');
            $table->foreignId(column: 'academic_session_id')->constrained(table: 'academic_sessions')->onDelete(action: 'cascade');
            $table->foreignId(column: 'academic_standard_id')->constrained(table: 'academic_standards')->onDelete(action: 'cascade');
            $table->foreignId(column: 'student_id')->constrained(table: 'users')->onDelete(action: 'cascade');
            $table->foreignId(column: 'subject_id')->constrained(table: 'subjects')->onDelete(action: 'cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examinations');
    }
};
