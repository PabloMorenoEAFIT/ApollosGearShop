<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use Illuminate\Database\Eloquent\Relations\HasMany;


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
     */

    
    protected $table = 'instruments';

    protected $guarded = [];

    /* ---- RELATIONSHIPS ----*/

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class, 'instrument_id');
    }
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'instrument_id');
    }

    /* ---- GETTERS & SETTERS ----*/

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
        return $this->attributes['reviewSum']/($this->attributes['numberOfReviews'] ?? 1);
    }

    public function setReviewSum(float $review): void
    {
        if ($this->attributes['numberOfReviews'] == 0) {
            $this->attributes['reviewSum'] = $review;
            return;
        }
        $this->attributes['reviewSum'] += $review/$this->attributes['numberOfReviews'];
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
        return $this->stocks()->latest('created_at')->value('quantity') ?? 0;

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

    /* ---- CUSTOM METHODS ----*/

    public function getFormattedPrice(): string
    {
        return '$ ' . number_format($this->attributes['price'], 2);
    }

    public function applySorting($query, $order)
    {
        switch ($order) {
            case 'priceAsc':
                $query->orderBy('price', 'asc');
                break;
            case 'priceDesc':
                $query->orderBy('price', 'desc');
                break;
            case 'ratingAsc':
                $query->orderBy('reviewSum', 'asc');
                break;
            case 'ratingDesc':
                $query->orderBy('reviewSum', 'desc');
                break;
        }

        return $query;
    }

    public function applyFilters($query, $filters)
    {
        if (!empty($filters['searchByName'])) {
            $query->where('name', 'like', '%' . $filters['searchByName'] . '%');
        }

        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        if (!empty($filters['rating'])) {
            $query->where('reviewSum', '>=', $filters['rating']);
        }

        if (!empty($filters['filterOrder'])) {
            $this->applySorting($query, $filters['filterOrder']);
        }

        return $query;
    }

    public function scopeFilterInstruments($query, $filters)
    {
        return $this->applyFilters($query, $filters);
    }


    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'brand' => 'required|string',
            'price' => 'required|numeric|min:0',
            'reviewSum' => 'nullable|numeric',
            'numberOfReviews' => 'nullable|integer|min:0',
            'quantity' => 'nullable|integer|min:1',
            'image' => 'file|image|max:10240', //Max 10MB
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

  
}
