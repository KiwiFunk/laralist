<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [     // $fillable allows mass assignment for ONLY these fields
        'title',                // Task name (e.g., "Buy groceries")
        'description',          // Optional task details
        'completed',            // Whether the task is done
    ];
}
