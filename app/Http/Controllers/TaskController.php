<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;        // Import the Task model

class TaskController extends Controller
{
    // Fetch all tasks
    public function index() {
        // Only show tasks for the authenticated user
        $tasks = Auth::user()->tasks; 
        return view('tasks.index', ['tasks' => $tasks]); // Pass the data into the view
    }

    // Store a new task 
    public function store(Request $request) {
        $task = Auth::user()->tasks()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'completed' => false,
        ]);

        // If AJAX, return JSON response
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'task' => $task, // Return the created task data
                'message' => 'Task created successfully!'
            ]);
        }
        // Otherwise, redirect to tasks list
        return redirect('/tasks'); 
    }

    // Update an existing task
    public function update(Request $request, Task $task) {

        // Using route model binding, the $task parameter will automatically be resolved to the Task model instance

        // Ensure the target task belongs to the authenticated user
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        
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
    public function toggleStatus(Task $task) {
        // Using route model binding, the $task parameter will automatically be resolved to the Task model instance
        $task->completed = !$task->completed; // Toggle the completed status
        $task->save(); // Save the updated task

        // If it's an AJAX request, return JSON
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Task status toggled successfully!'
            ]);
        }

        // Otherwise, redirect to tasks list
        return redirect('/tasks');
    }

    // Delete a task 
    public function delete($id) {
        $task = Task::findOrFail($id); // Find the task
        $task->delete(); // Delete the task

        // If AJAX, return JSON response
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Task deleted successfully!'
            ]);
        }
        // Otherwise, redirect to tasks list
        return redirect('/tasks'); 
    }

}
