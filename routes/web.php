<?php               //PHP opening tag

use App\Http\Controllers\TaskController;

// API Endpoints for Task Management
Route::get('/', function () {
    return view('welcome'); // Show the welcome page
});
Route::get('/tasks', [TaskController::class, 'index']);                         // Show all tasks
Route::post('/tasks', [TaskController::class, 'store']);                        // Handle new task submission
Route::put('/tasks/{task}', [TaskController::class, 'update']);                 // Update an existing task
Route::post('/tasks/{task}/toggle', [TaskController::class, 'toggleStatus']);   // Toggle task status
Route::delete('/tasks/{id}', [TaskController::class, 'delete']);                // Delete a task