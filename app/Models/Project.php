<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'user_id',          // Foreign key to the user who owns the project
        'title',            // Project name (e.g., "Home Renovation")
        'slug',             // URL-friendly version of the title (e.g., "home-renovation")
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

    // Methods to handle slug generation
    public function generateSlug()
    {
        $baseSlug = Str::slug($this->title);
        $slug = $baseSlug;
        $count = 1;                             // Init a counter to handle duplicates

        while ($this->checkUniqueSlug($slug)) {
            $slug = $baseSlug . '-' . $count;   // Append a number to the slug if it already exists using concatenation
            $count++;                           // Increment the counter for the next iteration
        }

        return $slug;                           // Return the unique slug
    }

    private function checkUniqueSlug($slug)
    {
        return static::where('user_id', $this->user_id)
                     ->where('slug', $slug)
                     ->where('id', '!=', $this->id)     // Exclude the current project if updating
                     ->exists();                        // Check if the slug already exists for the user
    }

    /**
     * Create Boot method to auto-generate slug when creating or updating a project
     * boot() is part of Laravel's Eloquent model lifecycle
     * uses ::creating and ::updating to hook into the model's lifecycle
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = $project->generateSlug($project->title);
            }
        });

        static::updating(function ($project) {
            if ($project->isDirty('title')) {           // Check if the title has changed
                $project->slug = $project->generateSlug($project->title);
            }
        });
    }

    // Use the slug for route model binding instead of the default ID
    public function getRouteKeyName()
    {
        return 'slug';  
    }

    //Scope to filter projects by user
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}