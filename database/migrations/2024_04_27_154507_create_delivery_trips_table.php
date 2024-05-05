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
        Schema::create('delivery_trips', function (Blueprint $table) {
            $table->id();
            $table->date('trip_date');
            $table->decimal('total_weight',10,2);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->unsignedBigInteger('lorry_id');
            // $table->foreign('lorry_id')->references('id')->on('delivery_trips_lorries')->onDelete('cascade');
            // $table->unsignedBigInteger('driver_id');
            // $table->foreign('driver_id')->references('id')->on('delivery_trips_drivers')->onDelete('cascade');
            // $table->unsignedBigInteger('workman_id');
            // $table->foreign('workman_id')->references('id')->on('delivery_trips_workmen')->onDelete('cascade');
            $table->json('details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_trips');
    }
};
