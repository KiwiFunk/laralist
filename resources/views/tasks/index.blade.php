<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Tasks | LaraList</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta name="csrf-token" content="{{ csrf_token() }}">               // CSRF Token for AJAX requests
    <meta name="tasks-data" content="{{ json_encode($tasks) }}">        // Store task data in a meta tag for easy access in JavaScript(store.js)
</head>
<body class="bg-zinc-900 text-zinc-100 min-h-screen relative overflow-x-hidden">
 
    <div class="relative z-10 max-w-6xl mx-auto px-6 py-12">

        <!-- Header Section -->
        @include('partials.header')

        <!-- Stats Bar -->
        <x-stats-bar />

        <!-- Create Task Bar -->
        <x-create-task-form />

        <!-- Task Cards -->
        @if($tasks->count() > 0)
            <div class="grid gap-6">
                @foreach($tasks as $index => $task)
                    <x-task-card :task="$task" :index="$index" />
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            @include('partials.empty-tasks')
        @endif
    </div>

</body>
</html>