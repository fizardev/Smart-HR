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
        Schema::create('day_off_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attendance_code_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('photo')->nullable();
            $table->text('description');
            $table->string('is_approved')->default('Pending');
            $table->boolean('approved_line_child')->default(false);
            $table->boolean('approved_line_parent')->default(false);
            $table->timestamps();
            $table->foreign('attendance_code_id')->references('id')->on('attendance_codes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('day_off_requests');
    }
};
