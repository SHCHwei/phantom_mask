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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('pharmacyName');
            $table->string('maskName');
            $table->string('transactionAmount');
            $table->string('transactionDate');
            $table->integer('userID')->index();
            $table->integer('maskID')->index();
            $table->integer('pharmacyID')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
