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
        Schema::create('add_the_validity_of_the_items_in_the_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id')->uniqid();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');

            $table->unsignedBigInteger('standar_in_room_minibar_id')->uniqid();
            $table->foreign('standar_in_room_minibar_id', 'fk2_validity_minibar')
            ->references('id')
            ->on('standar_in_room_minibars')
            ->onDelete('cascade');
            $table->date("date_of_manufacture");
            $table->timestamps();
                    $table->softDeletes(); // enables soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_the_validity_of_the_items_in_the_rooms');
    }
};
