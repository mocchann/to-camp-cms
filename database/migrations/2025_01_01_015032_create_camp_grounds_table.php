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
        Schema::create('camp_grounds', function (Blueprint $table) {
            $table->ulid();
            $table->string('name', 255)->comment('キャンプ場名');
            $table->string('address', 255)->comment('住所');
            $table->unsignedInteger('price')->comment('施設利用料');
            $table->text('image_url')->comment('キャンプ場Top画像');
            $table->integer('elevation')->comment('標高');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camp_grounds');
    }
};
