<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Validator;

class Review extends Model
{
    /**
     * REVIEW ATTRIBUTES
     *
     * $this->attributes['id'] - int - contains the unique identifier for the review
     * $this->attributes['score'] - int - contains the score or rating given in the review
     * $this->attributes['description'] - string - contains the description of the review
     * $this->attributes['user_id'] - int - contains the id of the user who wrote the review
     * $this->attributes['instrument_id'] - int - contains the id of the instrument being reviewed
     * $this->attributes['created_at'] - string - contains the creation timestamp of the review record
     * $this->attributes['updated_at'] - string - contains the last update timestamp of the review record
     *
     * RELATIONSHIPS
     *
     * user - belongsTo
     * instrument - belongsTo
     */
    protected $fillable = ['score', 'description', 'user_id', 'instrument_id'];

    public function instrument(): BelongsTo
    {
        return $this->belongsTo(Instrument::class, 'instrument_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Getters & Setters

    public function getUser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getInstrument(): BelongsTo
    {
        return $this->belongsTo(Instrument::class);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getScore(): int
    {
        return $this->attributes['score'];
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function getInstrumentId(): int
    {
        return $this->attributes['instrument_id'];
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function setScore(int $score): void
    {
        $this->attributes['score'] = $score;
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function setUserId(int $user_id): void
    {
        $this->attributes['user_id'] = $user_id;
    }

    public function setInstrumentId(int $instrument_id): void
    {
        $this->attributes['instrument_id'] = $instrument_id;
    }

    public function validate(array $data): array
    {

        $validator = Validator::make($data, [
            'description' => 'required|max:255',
            'score' => 'required|integer|min:1|max:5',
        ]);

        return $validator->validated();
    }

    public static function createReview(array $data, int $instrumentId): self
    {
        $validatedData = (new self)->validate($data);
        $validatedData['instrument_id'] = $instrumentId;

        $review = auth()->user()->getReviews()->create($validatedData);

        $instrument = Instrument::findOrFail($instrumentId);
        $instrument->setNumberOfReviews();
        $instrument->setReviewSum($validatedData['score']);
        $instrument->save();

        return $review;
    }
}
