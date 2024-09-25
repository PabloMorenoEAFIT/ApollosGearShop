<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instrument_id'); // Debe coincidir con el tipo de 'instruments.id'
            $table->integer('quantity');
            $table->string('comments')->nullable();
            $table->timestamps();

            // Clave foránea
            $table->foreign('instrument_id')->references('id')->on('instruments')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock');
    }
};


