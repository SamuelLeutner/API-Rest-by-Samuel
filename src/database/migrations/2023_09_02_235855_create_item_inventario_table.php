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
        Schema::create('item_inventarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable(false);
            $table->integer('valor')->nullable(false);
            $table->decimal('latitude', 10, 6)->nullable(false);
            $table->decimal('longitude', 10, 6)->nullable(false);
            $table->unsignedBigInteger('explorador_id');
            $table->foreign('explorador_id')->references('id')->on('exploradores')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_inventario');
    }
};
