<?php               //PHP opening tag

// Import Controllers
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Public routes
Route::get('/', function () {
    return view('welcome'); // Show the welcome page
});

// Guest-only routes (already logged in users redirected)
Route::middleware(['guest', 'throttle:10,1'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm']);
    Route::post('/register', [RegisterController::class, 'register']);
});

// Logout (authenticated users only)
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// Routes for task management (Protected routes)
Route::middleware(['auth', 'throttle:100,1'])->group(function () {
    Route::get('/tasks', [TaskController::class, 'index']);                         // Show all tasks
    Route::post('/tasks', [TaskController::class, 'store']);                        // Handle new task submission
    Route::put('/tasks/{task}', [TaskController::class, 'update']);                 // Update an existing task
    Route::post('/tasks/{task}/toggle', [TaskController::class, 'toggleStatus']);   // Toggle task status
    Route::delete('/tasks/{id}', [TaskController::class, 'delete']);                // Delete a task
});
