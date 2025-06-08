<?php               //PHP opening tag

// Import Controllers
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Public routes
Route::get('/', function () {
    return view('welcome'); // Show the welcome page
});

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm']);                    // Show the login form
Route::post('/login', [LoginController::class, 'login']);                           // Send login request to LoginController

Route::get('/register', [RegisterController::class, 'showRegistrationForm']);       // Show the registration form
Route::post('/register', [RegisterController::class, 'register']);                  // Send registration request

Route::post('/logout', [LoginController::class, 'logout']);                         // Handle logout request

// Routes for task management (Protected routes)
Route::middleware('auth')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index']);                         // Show all tasks
    Route::post('/tasks', [TaskController::class, 'store']);                        // Handle new task submission
    Route::put('/tasks/{task}', [TaskController::class, 'update']);                 // Update an existing task
    Route::post('/tasks/{task}/toggle', [TaskController::class, 'toggleStatus']);   // Toggle task status
    Route::delete('/tasks/{id}', [TaskController::class, 'delete']);                // Delete a task
});
