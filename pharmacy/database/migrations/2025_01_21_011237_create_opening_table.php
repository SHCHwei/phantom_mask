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
        Schema::create('opening', function (Blueprint $table) {
            $table->id();
            $table->integer('pharmacyID');
            $table->enum('days',['Mon','Tue','Wed','Thur','Fri','Sat','Sun']);
            $table->time('timeStart');
            $table->time('timeEnd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opening');
    }
};
