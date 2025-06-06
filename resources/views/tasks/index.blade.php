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
            <h1 class="text-5xl font-black bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent mb-2">
                Your Tasks
            </h1>
            <p class="text-zinc-400 text-lg">Stay organized, stay productive</p>
        </div>

        <!-- Stats Bar -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-zinc-800/50 backdrop-blur-sm border border-zinc-700 rounded-xl p-6 text-center">
                <div class="text-3xl font-bold text-zinc-200 mb-1">{{ $tasks->count() }}</div>
                <div class="text-zinc-400 text-sm">Total Tasks</div>
            </div>
            <div class="bg-zinc-800/50 backdrop-blur-sm border border-zinc-700 rounded-xl p-6 text-center">
                <div class="text-3xl font-bold text-green-400 mb-1">{{ $tasks->where('completed', true)->count() }}</div>
                <div class="text-zinc-400 text-sm">Completed</div>
            </div>
            <div class="bg-zinc-800/50 backdrop-blur-sm border border-zinc-700 rounded-xl p-6 text-center">
                <div class="text-3xl font-bold text-red-400 mb-1">{{ $tasks->where('completed', false)->count() }}</div>
                <div class="text-zinc-400 text-sm">Pending</div>
            </div>
        </div>

        <!-- Create Task Bar -->
        <div class="bg-zinc-800/70 backdrop-blur-sm border border-zinc-700 rounded-xl p-6 mb-8 shadow-xl">
            <form action="/tasks" method="POST" class="space-y-4">
                @csrf
                <div class="flex gap-4 flex-col md:flex-row md:items-center">

                    <div class="flex-1">
                        <label class="sr-only" for="title">Title:</label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               placeholder="What needs to be done?" 
                               class="w-full px-4 py-3 bg-zinc-700/50 border border-zinc-600 rounded-xl text-zinc-100 placeholder-zinc-400 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500" 
                               required>
                    </div>
                    
                    <div class="flex-2">
                        <label class="sr-only" for="description">Description:</label>
                        <textarea 
                            name="description" 
                            id="description" 
                            placeholder="Add more details (optional)" 
                            rows="1" 
                            class="w-full px-4 py-3 bg-zinc-700/50 border border-zinc-600 rounded-xl text-zinc-100 placeholder-zinc-400 transition-all duration-200 resize-none focus:outline-none focus:ring-2 focus:ring-orange-500"
                        ></textarea>
                    </div>
                
                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="group inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-xl shadow-lg transition-all duration-300 transform hover:scale-101 hover:from-orange-600 hover:to-orange-700 hover:cursor-pointer"
                    >
                        <svg class="w-4 h-4 group-hover:rotate-90 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        <span class="hidden sm:inline">Add Task</span>
                        <span class="sm:hidden">Add</span>
                    </button>
                    
                </div>
            </form>
        </div>

        <!-- Task Cards -->
        @if($tasks->count() > 0)
            <div class="grid gap-6">
                @foreach($tasks as $index => $task)
                    <div 
                        x-data="{
                            isEditing: false,
                            loading: false,

                            async updateTask() {
                                this.loading = true;
                                try {
                                    // Get the form element using Alpine root property
                                    const form = $el.querySelector('form');
                                    const formData = new FormData(form);

                                    // Send an AJAX request to update the task
                                    const response = await fetch(form.action, {
                                        method: 'POST',
                                        body: formData,
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest',       // Tell Laravel this is an AJAX request
                                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                                        }
                                    });

                                    const data = await response.json();         // Parse the JSON response
                                    if (data.success) {
                                        // Success! Update the display
                                        this.isEditing = false;
                                        // UI UPDATE LOGIC HERE
                                        console.log('Task updated successfully:', data.task);
                                    } else {
                                        alert('Oops! Something went wrong while updating the task.');
                                    }
                                } catch (error) {
                                    console.error('Error updating task:', error);
                                    alert('An error occurred while updating the task. Please try again.');
                                } finally {
                                    this.loading = false;
                                }
                            }
                        }" 
                        class="group relative bg-zinc-800/70 backdrop-blur-sm border border-zinc-700 rounded-xl p-6 hover:border-orange-500/50 transition-all duration-500 transform hover:scale-[1.01] hover:shadow-2xl hover:shadow-orange-500/10"
                        style="animation: slideInUp 0.6s ease-out {{ $index * 0.1 }}s both;"
                    >
                        <!-- Task Status Indicator -->
                        <div class="absolute -left-2 top-6 w-4 h-4 rounded-full {{ $task->completed ? 'bg-green-500' : 'bg-orange-500' }} shadow-lg"></div>
                        
                        <!-- Task Display Mode -->
                        <div x-show="!isEditing" class="flex items-start justify-between">
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
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center gap-3 ml-6">

                                <!-- Edit Task -->
                                <button 
                                    @click="isEditing = !isEditing" 
                                    class="group/btn p-2 bg-zinc-700/50 rounded-lg hover:bg-orange-500/20 border border-zinc-600 hover:border-orange-500/50 transition-all duration-300"
                                >
                                    <svg class="w-5 h-5 text-zinc-400 group-hover/btn:text-orange-400 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                    </svg>
                                </button>

                                <!-- Toggle Task Status -->
                                <form action="/tasks/{{ $task->id }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="group/btn p-2 bg-zinc-700/50 rounded-lg border border-zinc-600 {{ $task->completed ? 'hover:bg-red-500/20 hover:border-red-500/50' : 'hover:bg-green-500/20 hover:border-green-500/50' }} transition-all duration-300">
                                        <svg class="w-5 h-5 text-zinc-400 {{ $task->completed ? 'group-hover/btn:text-red-400' : 'group-hover/btn:text-green-500' }} transition-colors" fill="currentColor" viewBox="0 0 20 20">
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

                        <!-- Task Edit Mode -->
                        <div x-show="isEditing">
                            <form @submit.prevent="updateTask()" action="/tasks/{{ $task->id }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')
                                
                                <!-- Edit Header -->
                                <div class="flex items-center justify-between mb-4 pb-3 border-b border-zinc-700/50">

                                    <span class="font-medium text-orange-400">Editing Task</span>
                            
                                    <button type="button" @click="isEditing = !isEditing" 
                                            class="text-zinc-400 hover:text-zinc-300 p-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Title Input -->
                                <div>
                                    <label for="edit-title-{{ $task->id }}" class="block text-sm font-medium text-zinc-300 mb-2">Title</label>
                                    <input 
                                        type="text" 
                                        name="title"
                                        id="edit-title-{{ $task->id }}" 
                                        value="{{ $task->title }}"
                                        class="w-full px-4 py-3 bg-zinc-700/50 border border-zinc-600 rounded-xl text-zinc-100 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500" 
                                        required
                                    >
                                </div>

                                <!-- Description Input -->
                                <div>
                                    <label for="edit-description-{{ $task->id }}" class="block text-sm font-medium text-zinc-300 mb-2">Description</label>
                                    <textarea 
                                        name="description" 
                                        id="edit-description-{{ $task->id }}"
                                        rows="3"
                                        class="w-full px-4 py-3 bg-zinc-700/50 border border-zinc-600 rounded-xl text-zinc-100 transition-all duration-200 resize-none focus:outline-none focus:ring-2 focus:ring-orange-500"
                                    >{{ $task->description }}</textarea>
                                </div>

                                <!-- This Row will eventually contain other fields such as Due Date, Priority etc -->
                                <div class="gap-4"> 
                                    <div class="flex items-end">
                                        <label class="flex items-center gap-3 px-4 py-3 bg-zinc-700/30 border border-zinc-600 rounded-xl cursor-pointer hover:bg-zinc-700/50 transition-colors">
                                            <input type="checkbox" 
                                                   name="completed" 
                                                   value="completed" 
                                                   {{ $task->completed ? 'checked' : '' }}
                                                   class="w-4 h-4 text-orange-600 bg-zinc-700 border-zinc-600 rounded focus:ring-orange-500">
                                            <span class="text-sm text-zinc-300">Mark as completed</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex justify-end gap-3 pt-1">
                                    <button type="button" @click="isEditing = !isEditing" 
                                            class="px-4 py-2 text-zinc-400 hover:text-zinc-300 transition-colors">
                                        Cancel
                                    </button>
                                    <button type="submit" 
                                            class="px-6 py-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-lg hover:from-orange-600 hover:to-orange-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
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