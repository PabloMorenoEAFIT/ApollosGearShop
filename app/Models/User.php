<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /*USER ATTRIBUTES

    $this->attributes['name'] - string - contains the user name
    $this->attributes['email'] - string - contains the user email
    $this->attributes['password'] - string - contains the user password
    */

    protected $fillable = [
        'name',
        'email',
        'password',
        'group',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getIsAdmin(): bool
    {
        return $this->attributes['is_admin'];
    }
}
