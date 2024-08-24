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
        Schema::create('hall_seat', function (Blueprint $table) {
            $table->foreignId('hall_id')->constrained();
            $table->foreignId('seat_id')->constrained();
            $table->integer('seat_count');
            $table->bigInteger('unit_cost');

            $table->unique(['hall_id','seat_id'],'hall_seat_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hall_seats');
    }
};
