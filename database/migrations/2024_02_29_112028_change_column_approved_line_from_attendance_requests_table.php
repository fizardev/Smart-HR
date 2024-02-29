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
        Schema::table('attendance_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('approved_line_child')->change();
            $table->unsignedBigInteger('approved_line_parent')->change();

            // Tambahkan kunci asing setelah memastikan konsistensi data
            $table->foreign('approved_line_child')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');

            $table->foreign('approved_line_parent')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_requests', function (Blueprint $table) {
            //
        });
    }
};
