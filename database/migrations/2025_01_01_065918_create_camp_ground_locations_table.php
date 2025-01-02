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
        Schema::create('camp_ground_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('camp_ground_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('location_id')
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camp_ground_locations');
    }
};