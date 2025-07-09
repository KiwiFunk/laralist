<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // Fetch all Projects for user
    public function index()
    {
        $projects = Auth::user()->projects();
        return view('projects.index', ['projects' => $projects]);
    }

    // GET a specific project by ID
    public function show(Project $project)
    {
        // Ensure the authenticated user owns this project
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this project.');
        }

        // Load the project's tasks
        $tasks = $project->tasks()
            ->orderBy('completed', 'asc') // Show pending tasks first
            ->orderBy('created_at', 'desc')
            ->get();

        // Return a view and pass project/task data using compact
        return view('projects.display', compact('project', 'tasks'));
    }

    // Store a new Project
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $project = Auth::user()->projects()->create($validated);

        // If AJAX, return a JSON response
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'project' => $project,
                'message' => 'Project created successfully!'
            ]);
        }
        // Else redirect to index
        return redirect()->route('projects.index');
    }

    // Update a project
}