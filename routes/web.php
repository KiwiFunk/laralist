<?php               //PHP opening tag

use App\Http\Controllers\TaskController;

// API Endpoints for Task Management
Route::get('/', function () {
    return view('welcome'); // Show the welcome page
});
Route::get('/tasks', [TaskController::class, 'index']);                 // Show all tasks
Route::get('/tasks/create', [TaskController::class, 'create']);         // Show task creation form
Route::get('/tasks/{id}/edit', [TaskController::class, 'edit']);        // Show task edit form
Route::post('/tasks', [TaskController::class, 'store']);                // Handle new task submission
Route::put('/tasks/{id}', [TaskController::class, 'update']);           // Update an existing task
Route::patch('/tasks/{id}', [TaskController::class, 'toggleStatus']);   // Partial update to toggle task status
Route::delete('/tasks/{id}', [TaskController::class, 'delete']);        // Delete a task