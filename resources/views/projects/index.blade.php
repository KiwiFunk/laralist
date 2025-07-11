@extends('layouts.app')

@section('title', 'Your Projects | LaraList')

@section('navbar')
    <x-navbar />
@endsection

@section('content')
    <div class="max-w-6xl mx-auto px-8 py-12 pt-40">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-zinc-100 mb-2">Your Projects</h1>
            <p class="text-zinc-400">Organize your tasks by project</p>
        </div>

        <!-- Create Project Button -->
        <div class="mb-8">
            <button class="px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-200">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    New Project
                </span>
            </button>
        </div>

        <!-- Projects Grid -->
        @if($projects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $project)
                    <div class="bg-zinc-800/50 backdrop-blur-sm border border-zinc-700 rounded-xl p-6 hover:border-orange-500/50 transition-all duration-200">
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold text-zinc-100 mb-2">{{ $project->name }}</h3>
                            @if($project->description)
                                <p class="text-zinc-400 text-sm">{{ Str::limit($project->description, 100) }}</p>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2">
                            <a href="{{ route('projects.show', $project) }}" class="flex-1 bg-orange-500/10 border border-orange-500/30 text-orange-400 py-2 px-4 rounded-lg text-center text-sm font-medium hover:bg-orange-500/20 transition-colors">
                                View Project
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-zinc-800 rounded-full mb-4">
                    <svg class="w-8 h-8 text-zinc-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-zinc-100 mb-2">No projects yet</h3>
                <p class="text-zinc-400 mb-6">Create your first project to get started organizing your tasks.</p>
                <button class="px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-200">
                    Create Your First Project
                </button>
            </div>
        @endif
    </div>
@endsection