<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;

    /**
     * INSTRUMENT ATTRIBUTES

     * $this->attributes['id'] - int - contains the instrument primary key (id)

     * $this->attributes['name'] - string - contains the instrument name

     * $this->attributes['price'] - int - contains the instrument price
     */
    protected $table = 'instrument';

    protected $fillable = ['name', 'price'];

    public function getId(): int
    {

        return $this->attributes['id'];
    }

    public function setId($id): void
    {

        $this->attributes['id'] = $id;
    }

    public function getName(): string
    {

        return $this->attributes['name'];
    }

    public function setName($name): void
    {

        $this->attributes['name'] = $name;
    }

    public function getPrice(): int
    {

        return $this->attributes['price'];
    }

    public function setPrice($price): void
    {

        $this->attributes['price'] = $price;
    }
}
