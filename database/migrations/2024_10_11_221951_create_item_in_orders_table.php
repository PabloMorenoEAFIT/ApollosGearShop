<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemInOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('item_in_orders', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Foreign key for Order
            $table->foreignId('instrument_id')->nullable()->constrained()->onDelete('cascade'); // Foreign key for Instrument
            $table->foreignId('lesson_id')->nullable()->constrained()->onDelete('cascade'); // Foreign key for Lesson
            $table->unsignedInteger('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_in_orders');
    }
}
