<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;        // Import the Task model

class TaskController extends Controller
{
    // Fetch all tasks
    public function index() {
        $tasks = Task::all(); // Task inherits from Model, so we can use Eloquent methods
        return view('tasks.index', ['tasks' => $tasks]); // Pass the data into the view
    }

    // Show task creation form
    public function create() {
        return view('tasks.create');    // Return the view for creating a new task
    }

    // Show task edit form
    public function edit($id) {
        $task = Task::findOrFail($id);  // Find the task by ID or fail if not found
        return view('tasks.edit', ['task' => $task]); // Pass the task data to the edit view
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
