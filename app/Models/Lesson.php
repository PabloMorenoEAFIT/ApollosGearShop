<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    /**
     * INSTRUMENT ATTRIBUTES

     * $this->attributes['id'] - int - contains the instrument primary key (id)

     * $this->attributes['name'] - string - contains the instrument name

     * $this->attributes['price'] - int - contains the instrument price
     *
     * Completar con el resto de atributos
     */
    protected $table = 'lessons';

    protected $fillable = ['name', 'description', 'difficulty', 'schedule', 'totalHours', 'location', 'price', 'teacher'];

    //  ID
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId($id): void
    {
        $this->attributes['id'] = $id;
    }

    // name
    public function getName(): string
    {

        return $this->attributes['name'];
    }

    public function setName($name): void
    {

        $this->attributes['name'] = $name;
    }

    // description
    public function getDescription(): string
    {

        return $this->attributes['description'];
    }

    public function setDescription($description): void
    {

        $this->attributes['description'] = $description;
    }

    // difficulty
    public function getDifficulty(): string
    {

        return $this->attributes['difficulty'];
    }

    public function setDifficulty($difficulty): void
    {

        $this->attributes['difficulty'] = $difficulty;
    }

    // schedule
    public function getSchedule(): string
    {

        return $this->attributes['schedule'];
    }

    public function setSchedule($schedule): void
    {

        $this->attributes['schedule'] = $schedule;
    }

    // totalHours - int
    public function getTotalHours(): int
    {

        return $this->attributes['totalHours'];
    }

    public function setTotalHours($totalHours): void
    {

        $this->attributes['totalHours'] = $totalHours;
    }

    // location
    public function getLocation(): string
    {

        return $this->attributes['location'];
    }

    public function setLocation($location): void
    {

        $this->attributes['location'] = $location;
    }

    // price - int
    public function getPrice(): int
    {

        return $this->attributes['price'];
    }

    public function setPrice($price): void
    {

        $this->attributes['price'] = $price;
    }

    // teacher
    public function getTeacher(): string
    {

        return $this->attributes['teacher'];
    }

    public function setTeacher($teacher): void
    {

        $this->attributes['teacher'] = $teacher;
    }
}
