<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [     // $fillable allows mass assignment for ONLY these fields
        'user_id',              // Foreign key to the user who created the task
        'project_id',           // Foreign key to the project the task belongs to
        'title',                // Task name (e.g., "Buy groceries")
        'description',          // Optional task details
        'completed',            // Whether the task is done
    ];

    protected $casts = [
        'completed' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship: Task belongs to a Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Access the user through the parent project
    public function user()
    {
        return $this->hasOneThrough(User::class, Project::class, 'id', 'id', 'project_id', 'user_id');
    }
}
