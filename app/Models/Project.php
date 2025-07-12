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
        'updated_at' => 'datetime',
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

    // Helper methods for project stats (Use these to fetch data on the projects page)
    public function getCompletedTasksCountAttribute()
    {
        return $this->tasks()->where('completed', true)->count();
    }

    public function getPendingTasksCountAttribute()
    {
        return $this->tasks()->where('completed', false)->count();
    }

    public function getTotalTasksCountAttribute()
    {
        return $this->tasks()->count();
    }
}