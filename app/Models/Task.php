<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [     // $fillable allows mass assignment for ONLY these fields
        'project_id',           // Foreign key to the project the task belongs to
        'title',                // Task name (e.g., "Buy groceries")
        'description',          // Optional task details
        'completed',            // Whether the task is done
    ];

    // Relationship: Task belongs to a Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
