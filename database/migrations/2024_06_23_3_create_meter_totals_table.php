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
        Schema::create('meter_totals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meter_id');
            $table->float('total_reading')->default(0);
            $table->timestamps();

            $table->foreign('meter_id')->references('id')->on('meter_readings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meter_totals');
    }
};
