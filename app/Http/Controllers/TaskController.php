<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;                    // Import the Task model
use App\Models\Project;                 // Import the Project model
use Illuminate\Support\Facades\Auth;    // Import the Auth facade for auth functionality

class TaskController extends Controller
{
    /**
     * Store a new task within an existing project.
     * Route: POST /projects/{project}/tasks
     */
    public function store(Request $request, Project $project) {

        // Ensure the authenticated user owns this project
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

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

        // Create task with both project_id and user_id for flexibility
        $task = $project->tasks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'completed' => false,
            'user_id' => Auth::id(), // Link directly to user
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
        return redirect()->route('projects.show', $project);
    }

    /**
     * Update an existing task
     * Route: PUT /tasks/{task}
     */
    public function update(Request $request, Task $task) {

        // Ensure the authenticated user owns this task (via project ownership)
        if ($task->project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Using route model binding, the $task parameter will automatically be resolved to the Task model instance

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

        // Otherwise, redirect to selected project to reflect changes
        return redirect()->route('projects.show', $task->project);
    }

    // Toggle task completion status
    public function toggleStatus(Task $task) {

        // Ensure the authenticated user owns this task
        if ($task->project->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $task->completed = !$task->completed; // Toggle the completed status
        $task->save(); // Save the updated task

        // If it's an AJAX request, return JSON
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'task' => $task,
                'message' => $task->completed ? 'Task completed!' : 'Task reopened!'
            ]);
        }

        // Otherwise, redirect to tasks list
        return redirect()->route('projects.show', $task->project);
    }

    // Delete a task 
    public function delete(Task $task) {

        // User scoped to ensure the task belongs to the authenticated user
        if ($task->project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }  

        $projectId = $task->project_id;     // Get the project ID for redirection after deletion
        $task->delete();                    // Delete the task

        // If AJAX, return JSON response
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Task deleted successfully!'
            ]);
        }
        // Otherwise, redirect to tasks list
        return redirect()->route('projects.show', $projectId); 
    }

}
