<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Tasks | LaraList</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-900 text-zinc-100 min-h-screen relative overflow-x-hidden">
 
    <div class="relative z-10 max-w-6xl mx-auto px-6 py-12">

        <!-- Header Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-5xl font-black bg-gradient-to-r from-orange-400 to-orange-600 bg-clip-text text-transparent mb-2">
                Your Tasks
            </h1>
            <p class="text-zinc-400 text-lg">Stay organized, stay productive</p>
        </div>

        <!-- Add Task Button -->
        <div class="text-center mb-8">
            <a href="/tasks/create" class="group inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-orange-500/25 transition-all duration-300 transform hover:scale-105">
                <svg class="w-5 h-5 group-hover:rotate-90 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                Add New Task
            </a>
        </div>

        <!-- Task Cards -->
        @if($tasks->count() > 0)
            <div class="grid gap-6">
                @foreach($tasks as $index => $task)
                    <div class="group relative bg-zinc-800/70 backdrop-blur-sm border border-zinc-700 rounded-xl p-6 hover:border-orange-500/50 transition-all duration-500 transform hover:scale-[1.02] hover:shadow-2xl hover:shadow-orange-500/10"
                         style="animation: slideInUp 0.6s ease-out {{ $index * 0.1 }}s both;">
                        
                        <!-- Task Status Indicator -->
                        <div class="absolute -left-2 top-6 w-4 h-4 rounded-full {{ $task->completed ? 'bg-green-500' : 'bg-orange-500' }} shadow-lg"></div>
                        
                        <!-- Task Content -->
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-3">
                                    <h2 class="text-2xl font-bold text-zinc-100 group-hover:text-orange-400 transition-colors {{ $task->completed ? 'line-through opacity-75' : '' }}">
                                        {{ $task->title }}
                                    </h2>
                                    <!-- Checkmark Icon -->
                                    @if($task->completed)
                                        <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                </div>
                                
                                @if($task->description)
                                    <p class="text-zinc-400 mb-4 leading-relaxed {{ $task->completed ? 'line-through opacity-75' : '' }}">
                                        {{ $task->description }}
                                    </p>
                                @endif

                                <!-- Task Meta -->
                                <div class="flex items-center gap-4 text-sm text-zinc-500">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $task->created_at->format('M j, Y') }}
                                    </span>
                                    @if($task->due_date)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                            Due {{ \Carbon\Carbon::parse($task->due_date)->format('M j') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center gap-3 ml-6">
                                <a href="/tasks/{{ $task->id }}/edit" 
                                   class="group/btn p-2 bg-zinc-700/50 rounded-lg hover:bg-orange-500/20 border border-zinc-600 hover:border-orange-500/50 transition-all duration-300">
                                    <svg class="w-5 h-5 text-zinc-400 group-hover/btn:text-orange-400 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                    </svg>
                                </a>

                                <!-- Toggle Task Status -->
                                <form action="/tasks/{{ $task->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="group/btn p-2 bg-zinc-700/50 rounded-lg hover:bg-red-500/20 border border-zinc-600 hover:border-red-500/50 transition-all duration-300">
                                        <svg class="w-5 h-5 text-zinc-400 group-hover/btn:text-red-400 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </form>
                                
                                <!-- Delete Task -->
                                <form action="/tasks/{{ $task->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="group/btn p-2 bg-zinc-700/50 rounded-lg hover:bg-red-500/20 border border-zinc-600 hover:border-red-500/50 transition-all duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-zinc-400 group-hover/btn:text-red-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7L5 7M10 11V17M14 11V17M5 7L6 19C6 20.105 6.895 21 8 21H16C17.105 21 18 20.105 18 19L19 7M9 7V4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V7" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                    </div>
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
    </style>
</body>
</html>