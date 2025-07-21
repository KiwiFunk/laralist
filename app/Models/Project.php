<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        // Check the value of the generated slug against existing slugs in the database
    }
}