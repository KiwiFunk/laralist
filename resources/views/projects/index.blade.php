@extends('layouts.app')

@section('title', 'Your Projects | LaraList')

@push('head')
    <!-- Store users project data in a meta tag for easy access in JavaScript -->
    <meta name="projects-data" content="{{ json_encode($projects) }}">
@endpush

@section('navbar')
    <!-- x-navbar />
@endsection

@section('content')

<!-- DEBUG: Remove this after testing -->
<div class="" style="background: red; color: white; padding: 10px;">
    <h3>DEBUG INFO:</h3>
    <p>Projects variable type: {{ gettype($projects ?? 'undefined') }}</p>
    <p>Projects count: {{ isset($projects) ? (method_exists($projects, 'count') ? $projects->count() : count($projects)) : 'N/A' }}</p>
    <p>Projects data: {{ isset($projects) ? json_encode($projects) : 'undefined' }}</p>
</div>
<!-- END DEBUG -->

<div x-data="createProjectForm()">
    @if($projects->count() > 0)
        <div class="max-w-6xl mx-auto px-8 py-12 pt-40">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-zinc-100 mb-2">Your Projects</h1>
                <p class="text-zinc-400">Organize your tasks by project</p>
            </div>

            <!-- Create Project Button -->
            <div class="mb-8">
                <button @click="openModal()" class="px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-200">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        New Project
                    </span>
                </button>
            </div>

            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $index => $project)
                    <x-project-card :project="$project" :index="$index" />
                @endforeach
            </div>

            @else
            <!-- Empty State -->
            <div class="text-center py-12 pt-40">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-zinc-800 rounded-full mb-4">
                    <svg class="w-8 h-8 text-zinc-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-zinc-100 mb-2">No projects yet</h3>
                <p class="text-zinc-400 mb-6">Create your first project to get started organizing your tasks.</p>
                <button @click="openModal()" class="px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-200">
                    Create Your First Project
                </button>
            </div>
        @endif

        <!-- Modal Component -->
        <div>
            <x-create-project-form />
        </div>

    </div>
</div>
@endsection