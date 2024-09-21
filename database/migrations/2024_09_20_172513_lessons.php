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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('difficulty');
            $table->string('schedule');
            $table->integer('totalHours');
            $table->string('location');
            $table->integer('price');
<<<<<<< HEAD:database/migrations/2024_09_20_172513_lessons.php
            $table->string('teacher');
=======
            $table->float('reviewSum');
            $table->integer('numberOfReviews');
            //Esto en realidad es stock
            $table->integer('quantity');
            $table->string('image');
>>>>>>> sintax-refactoring:database/migrations/2024_09_10_193224_modify_instruments_table.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
