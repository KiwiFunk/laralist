<?php               //PHP opening tag

// Import Controllers
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
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

// Protected routes for authenticated users
Route::middleware(['auth', 'throttle:100,1'])->group(function () {
    
    // Project routes
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');                   // Get all projects
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');                  // Handle project creation
    Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');      // Get specified project
    Route::put('/projects/{project:slug}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project:slug}', [ProjectController::class, 'delete'])->name('projects.destroy');
    // Note: Deleting a project will also delete all associated tasks due to cascade delete in the model
    
    // Task routes (nested under projects)
    Route::post('/projects/{project:slug}/tasks', [TaskController::class, 'store'])->name('tasks.store');   // Handle new task submission
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');                   // Update an existing task
    Route::post('/tasks/{task}/toggle', [TaskController::class, 'toggleStatus'])->name('tasks.toggle');     // Toggle task status
    Route::delete('/tasks/{task}', [TaskController::class, 'delete']);                                      // Delete a task
    
});