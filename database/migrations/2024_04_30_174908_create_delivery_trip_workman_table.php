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
        Schema::create('delivery_trip_workman', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();

            $table->unsignedBigInteger('workman_id');
            $table->unsignedBigInteger('delivery_trip_id');

            $table->foreign('workman_id')->references('id')->on('workmen')->onDelete('cascade');
            $table->foreign('delivery_trip_id')->references('id')->on('delivery_trips')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_trips_workmen');
    }
};
