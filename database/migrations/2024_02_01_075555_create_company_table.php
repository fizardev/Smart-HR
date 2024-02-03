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
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('name',40);
            $table->string('phone_number', 18);
            $table->string('email', 30);
            $table->longText('address');
            $table->string('province', 20);
            $table->string('city', 20);
            $table->string('logo', 50);
            $table->string('category', 30);
            $table->string('class', 10);
            $table->string('operating_permit_number', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
