<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;        // Import the Task model

class TaskController extends Controller
{
    // Fetch all tasks
    public function index() {
        $tasks = Task::all(); // Task inherits from Model, so we can use Eloquent methods
        return response()->json($tasks); // Return tasks as JSON response
    }

    // Show task creation form
    public function create() {
        return "This is the create method, which shows the form to create a new task.";
    }

    // Store a new task 
    public function store(Request $request) {
        $task = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'completed' => false,
        ]);

        return redirect('/tasks'); // Redirect to tasks list
    }

    // Delete a task 
    public function delete($id) {
        return "This is the delete method, which deletes the task by ID: $id.";
    }
}
