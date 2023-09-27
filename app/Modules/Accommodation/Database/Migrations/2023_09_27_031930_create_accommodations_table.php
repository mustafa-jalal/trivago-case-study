<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));;
            $table->string('name', 255);
            $table->tinyInteger('rating');
            $table->enum('category', ['hotel', 'alternative', 'hostel', 'lodge', 'resort', 'guest-house']);
            $table->foreignUuid('location_id');
            $table->string('image', 255);
            $table->integer('reputation');
            $table->double('price', 10, 2);
            $table->integer('available_rooms');
            $table->timestamps();

            $table->foreign('location_id')->references('id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};
