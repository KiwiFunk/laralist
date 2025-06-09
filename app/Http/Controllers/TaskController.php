<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;                    // Import the Task model
use Illuminate\Support\Facades\Auth;    // Import the Auth facade for auth functionality

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

        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',           // Title is required, must be a string, and max length of 255 characters
            'description' => 'nullable|string|max:1000',    // Description is optional, must be a string, and max length of 1000 characters
        ], [
            // Custom validation error messages
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 1000 characters.',
        ]);

        $task = Auth::user()->tasks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null, // Use null if description is not provided
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

        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255|min:1',
            'description' => 'nullable|string|max:1000',
            'completed' => 'sometimes|boolean',
        ]);

        // Update the task with validated data
        $task->update($validated);

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
       $task = Auth::user()->tasks()->findOrFail($id);  // Find the task by ID, only searching within the authenticated user's tasks
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
