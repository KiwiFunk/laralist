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
    public function update(Request $request, Task $task) {

        // Using route model binding, the $task parameter will automatically be resolved to the Task model instance

        // Update the task with request data
        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'completed' => $request->input('completed', false), // Default to false if not provided
        ]);

        // If it's an AJAX request, return JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'task' => $task->fresh(), // Get updated task data
                'message' => 'Task updated successfully!'
            ]);
        }

        // Otherwise, redirect to tasks list to reflect changes
        return redirect('/tasks'); 
    }

    // Toggle task completion status
    public function toggleStatus($id) {
        $task = Task::findOrFail($id); // Find the task by ID or fail if not found
        $task->completed = !$task->completed; // Toggle the completed status
        $task->save(); // Save the updated task
        return redirect('/tasks'); // Redirect to tasks list
    }

    // Delete a task 
    public function delete($id) {
        $task = Task::findOrFail($id); // Find the task
        $task->delete(); // Delete the task

        return redirect('/tasks'); // Redirect back to the task list
    }

}
