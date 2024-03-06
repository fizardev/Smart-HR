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
        Schema::table('day_off_requests', function (Blueprint $table) {
            $table->bigInteger('approved_line_child')->unsigned()->nullable()->change();
            $table->bigInteger('approved_line_parent')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('day_off_requests', function (Blueprint $table) {
            //
        });
    }
};
