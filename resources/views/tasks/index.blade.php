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
            @include('partials.empty-tasks')
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