<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('item_in_orders', function (Blueprint $table) {
            $table->string('type'); // Aquí agregamos la columna 'type' de tipo string
        });
    }

    public function down()
    {
        Schema::table('item_in_orders', function (Blueprint $table) {
            $table->dropColumn('type'); // Esto eliminará la columna si hacemos rollback
        });
    }
};
