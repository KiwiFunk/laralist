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

    // Update an existing task
    public function update(Request $request, $id) {
        $task = Task::findOrFail($id); // Find the task by ID or fail if not found
        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'completed' => $request->input('completed', false), // Default to false if not provided
        ]);

        return redirect('/tasks'); // Redirect to tasks list
    }

    // Toggle task completion status
    public function toggleStatus($id) {
        $task = Task::findOrFail($id); // Find the task by ID or fail if not found
        $task->completed = !$task->completed; // Toggle the completed status
        $task->save(); // Save the updated task
    }

    // Delete a task 
    public function delete($id) {
        $task = Task::findOrFail($id); // Find the task
        $task->delete(); // Delete the task

        return redirect('/tasks'); // Redirect back to the task list
    }

}
