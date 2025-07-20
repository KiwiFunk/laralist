@extends('layouts.app')

@section('title', 'Your Projects | LaraList')

@push('head')
    <!-- Store users project data in a meta tag for easy access in JavaScript -->
    <meta name="projects-data" content="{{ json_encode($projects) }}">
@endpush

@section('navbar')
    <x-navbar />
@endsection

@section('content')
<div x-data="createProjectForm()">
    @if($projects->count() > 0)
        <div class="max-w-6xl mx-auto px-8 py-12 pt-40">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-zinc-100 mb-2">Your Projects</h1>
                @Auth
                    <p 
                        x-data="{ 
                            prefix: '',
                            greeting: '',
                            init() {
                                this.prefix = this.getPrefix();
                                this.greeting = this.getGreeting();
                            },
                            getPrefix() {
                                const hours = new Date().getHours();
                                if (hours < 12) return 'Good morning';
                                if (hours < 18) return 'Good afternoon';
                                return 'Good evening';
                            },
                            getGreeting() {
                                const randomGreetings = [
                                    'What are we doing today?',
                                    'What can I help you with?',
                                    'What do you need to get done today?',
                                    'What tasks are on your mind?'
                                ];
                                return randomGreetings[Math.floor(Math.random() * randomGreetings.length)];
                            }
                        }"
                        class="text-zinc-400 text-lg"
                    >
                        <span x-text="prefix"></span>, {{ Auth::user()->name }}. <span x-text="greeting"></span>
                    </p>
                @else
                    <p class="text-zinc-400 text-lg">Hey! You shouldn't be here! How did you get here without logging in?!</p>
                @endAuth
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
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