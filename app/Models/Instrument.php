<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Instrument extends Model
{
    use HasFactory;

    /**
     * INSTRUMENT ATTRIBUTES
     *
     * $this->attributes['id'] - int - contains the unique identifier for the instrument
     *
     * $this->attributes['name'] - string - contains the instrument name
     *
     * $this->attributes['description'] - string - contains a description of the instrument
     *
     * $this->attributes['category'] - string - contains the category of the instrument
     *
     * $this->attributes['brand'] - string - contains the brand of the instrument
     *
     * $this->attributes['price'] - int - contains the instrument price
     *
     * $this->attributes['reviewSum'] - float - contains the total sum of reviews for the instrument
     *
     * $this->attributes['numberOfReviews'] - int - contains the number of reviews for the instrument
     *
     * $this->attributes['quantity'] - int - contains the quantity in stock for the instrument
     *
     * $this->attributes['image'] - string - contains the URL or path to the image of the instrument
     *
     * $this->attributes['created_at'] - string - contains the creation timestamp of the instrument record
     *
     * $this->attributes['updated_at'] - string - contains the last update timestamp of the instrument record
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     */
    protected $table = 'instruments';

    protected $guarded = [];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getCategory(): string
    {
        return $this->attributes['category'];
    }

    public function setCategory(string $category): void
    {
        $this->attributes['category'] = $category;
    }

    public function getBrand(): string
    {
        return $this->attributes['brand'];
    }

    public function setBrand(string $brand): void
    {
        $this->attributes['brand'] = $brand;
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getReviewSum(): float
    {
        return $this->attributes['reviewSum'];
    }

    public function setReviewSum(float $review): void
    {
        $this->attributes['reviewSum'] += $review;
    }

    public function getNumberOfReviews(): int
    {
        return $this->attributes['numberOfReviews'];
    }

    public function setNumberOfReviews(int $addReview): void
    {
        $this->attributes['numberOfReviews'] += $addReview;
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function getImage(): string
    {
        return $this->attributes['image'];
    }

    public function setImage(string $image): void
    {
        $this->attributes['image'] = $image;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    /*CUSTOM METHODS */

    public function searchByName(String $name): Instrument
    {
        return $this->where('name', $name)->first();
    }

    public function searchByCategory(string $category): Instrument
    {
        return $this->where('category', $category)->first();
    }

    public function searchByBrand(String $brand): Instrument
    {
        return $this->where('brand', $brand)->first();
    }

    
    


    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'brand' => 'required|string',
            'price' => 'required|integer|min:0',
            'reviewSum' => 'nullable|numeric',
            'numberOfReviews' => 'nullable|integer|min:0',
            'quantity' => 'required|integer|min:1',
            'image' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
