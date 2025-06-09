<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [     // $fillable allows mass assignment for ONLY these fields
        'user_id',              // Foreign key to the user who owns the task
        'title',                // Task name (e.g., "Buy groceries")
        'description',          // Optional task details
        'completed',            // Whether the task is done
    ];

    // Relationship: Task belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
