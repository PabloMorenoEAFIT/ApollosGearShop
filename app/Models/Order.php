<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * ORDER ATTRIBUTES

     * $this->attributes['id'] - int - contains the order primary key (id)

     * $this->attributes['creationDate'] - date - contains the creation date of the order

     * $this->attributes['deliveryDate'] - date - contains the delivery date of the order

     * $this->attributes['totalPrice'] - int - contains the order total price
     */
    protected $table = 'orders';

    protected $fillable = ['creationDate', 'deliveryDate', 'totalPrice'];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getCreationDate(): date
    {
        return $this->attributes['creationDate'];
    }

    public function setCreationDate(date $creationDate): void
    {
        $this->attributes['creationDate'] = $creationDate;
    }

    public function getDeliveryDate(): date
    {
        return $this->attributes['deliveryDate'];
    }

    public function setDeliveryDate(date $deliveryDate): void
    {
        $this->attributes['deliveryDate'] = $deliveryDate;
    }

    public function getTotalPrice(): int
    {
        return $this->attributes['totalPrice'];
    }

    public function setTotalPrice(int $totalPrice): void
    {
        $this->attributes['totalPrice'] = $totalPrice;
    }
}
