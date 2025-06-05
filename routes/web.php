<?php               //PHP opening tag

use App\Http\Controllers\TaskController;

// API Endpoints for Task Management
Route::get('/tasks', [TaskController::class, 'index']);             // Show all tasks
Route::get('/tasks/create', [TaskController::class, 'create']);     // Show task creation form
Route::post('/tasks', [TaskController::class, 'store']);            // Handle new task submission
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);   // Delete a task