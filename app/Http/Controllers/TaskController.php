<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Fetch all tasks
    public function index() {
        return "This is the index method, which retrieves all tasks.";
    }

    // Show task creation form
    public function create() {
        return "This is the create method, which shows the form to create a new task.";
    }

    // Store a new task 
    public function store(Request $request) {
        return "This is the store method, which saves a new task.";
    }

    // Delete a task 
    public function delete($id) {
        return "This is the delete method, which deletes the task by ID: $id.";
    }
}
