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

    //  ID
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(): void
    {
        $this->attributes['id'] = $id;
    }

    // creationDate
    public function getCreationDate(): date
    {
        return $this->attributes['creationDate'];
    }

    public function setCreationDate(): void
    {
        $this->attributes['creationDate'] = $creationDate;
    }

    // deliveryDate
    public function getDeliveryDate(): date
    {
        return $this->attributes['deliveryDate'];
    }

    public function setDeliveryDate(): void
    {
        $this->attributes['deliveryDate'] = $deliveryDate;
    }

    // totalPrice
    public function getTotalPrice(): date
    {
        return $this->attributes['totalPrice'];
    }

    public function setTotalPrice(): void
    {
        $this->attributes['totalPrice'] = $totalPrice;
    }
}
