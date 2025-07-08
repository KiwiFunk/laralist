<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'user_id',          // Foreign key to the user who owns the project
        'name',             // Project name (e.g., "Home Renovation")
        'description',      // Optional project details
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Database relationships
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}