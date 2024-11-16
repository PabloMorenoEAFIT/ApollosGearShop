<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemInOrder extends Model
{
    /**
     * ITEM IN ORDER ATTRIBUTES
     *
     * $this->attributes['id'] - int - contains the unique identifier for the item in order
     * $this->attributes['type] - string - contains the type of the item in order
     * $this->attributes['quantity'] - int - contains the quantity of the item in order
     * $this->attributes['price'] - int - contains the price of the item in order
     *
     * RELATIONSHIPS
     *
     * Order - belongsTo
     * Instrument - belongsTo
     * Lesson - belongsTo
     */
    protected $fillable = ['type', 'quantity', 'price', 'instrument_id', 'lesson_id', 'order_id'];

    public function instrument()
    {
        return $this->belongsTo(Instrument::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getInstrument(): Instrument
    {
        return $this->instrument;
    }

    public function getLesson(): Lesson
    {
        return $this->lesson;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getType(): string
    {
        return $this->attributes['type'];
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function getCustomPrice(int $price): string
    {
        return number_format($price, 2);
    }

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }
}
