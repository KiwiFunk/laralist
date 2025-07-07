<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Mass assignable attributes
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Hidden attributes for serialization
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Cast attributes
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Database relationships
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // All tasks across every project for this user
    public function tasks()
    {
        return $this->hasManyThrough(Task::class, Project::class);
    }
}
