<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Tasks | LaraList</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta name="csrf-token" content="{{ csrf_token() }}">   
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
            <div class="text-center py-16">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-zinc-800/50 flex items-center justify-center">
                    <svg class="w-12 h-12 text-zinc-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-zinc-400 mb-2">No tasks yet!</h3>
                <p class="text-zinc-500 mb-8">Create your first task to get started on your productivity journey.</p>
                <a href="/tasks/create" class="inline-flex items-center gap-2 px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Create Your First Task
                </a>
            </div>
        @endif
    </div>

    <style>
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .deleting {
                animation: slideOut 0.3s ease-out forwards !important;
            }
            
        @keyframes slideOut {
            to {     
                transform: translateX(100%);
                opacity: 0;
            }
        }
    </style>

    <!-- Alpine Store (TODO: Move to a separate file) -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('taskManager', {
                // Initialize with server data
                tasks: @json($tasks),
                
                // Computed stats (automatically reactive)
                get stats() {
                    return {
                        total: this.tasks.length,
                        completed: this.tasks.filter(task => task.completed).length,
                        pending: this.tasks.filter(task => !task.completed).length
                    };
                },
                
                // Actions to modify tasks
                updateTask(taskId, updatedTask) {
                    const index = this.tasks.findIndex(t => t.id === taskId);
                    if (index !== -1) {
                        this.tasks[index] = { ...this.tasks[index], ...updatedTask };
                    }
                },
                
                toggleTask(taskId) {
                    const task = this.tasks.find(t => t.id === taskId);
                    if (task) {
                        task.completed = !task.completed;
                    }
                },
                
                deleteTask(taskId) {
                    this.tasks = this.tasks.filter(t => t.id !== taskId);
                },
                
                addTask(newTask) {
                    this.tasks.push(newTask);
                }
            });
        });
    </script>
</body>
</html>