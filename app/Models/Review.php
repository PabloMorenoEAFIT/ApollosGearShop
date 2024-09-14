<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Review extends Model
{
    /**
     * REVIEW ATTRIBUTES
     *
     * $this->attributes['id'] - int - contains the unique identifier for the review
     *
     * $this->attributes['score'] - int - contains the score or rating given in the review
     *
     * $this->attributes['description'] - string - contains the description of the review
     *
     * $this->attributes['user_id'] - int - contains the id of the user who wrote the review
     *
     * $this->attributes['instrument_id'] - int - contains the id of the instrument being reviewed
     *
     * $this->attributes['created_at'] - string - contains the creation timestamp of the review record
     *
     * $this->attributes['updated_at'] - string - contains the last update timestamp of the review record
     */

    protected $table = 'reviews';
    
    protected $fillable = ['score', 'description'];

    // public function validate(Request $request): void
    // {
    //     $request->validate([
    //         'score' => 'required',
    //         'description' => 'required',
    //     ]);
    // }
    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function instrument(): BelongsTo
    {
        return $this->belongsTo(Instrument::class);
    }


    // Getters & Setters
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getScore(): int
    {
        return $this->attributes['score'];
    }

    public function setScore(int $score): void
    {
        $this->attributes['score'] = $score;
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function setUserId(int $user_id): void
    {
        $this->attributes['user_id'] = $user_id;
    }

    public function getInstrumentId(): int
    {
        return $this->attributes['instrument_id'];
    }

    public function setInstrumentId(int $instrument_id): void
    {
        $this->attributes['instrument_id'] = $instrument_id;
    }

}
