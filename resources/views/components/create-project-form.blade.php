
<!-- Modal Box -->
<div class="fixed inset-0 flex items-center justify-center z-50 backdrop-blur-xs" 
    x-show="isOpen" 
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click.away="isOpen = false">
    <!-- Modal Content -->
    <div class="bg-zinc-800 rounded-lg shadow-lg p-6 w-full max-w-md border border-zinc-700">

        <!-- Modal Header -->
        <div class="flex items-center justify-between mb-4 select-none">
            <h2 class="text-xl font-semibold text-zinc-100">Create New Project</h2>
            <button @click="isOpen = false" 
                    class="text-zinc-400 hover:text-zinc-300 p-1">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>

        <!-- Modal Form -->
        <form @submit.prevent="createProject($event)" action="/projects" method="POST" class="space-y-4">
            @csrf
            <div class="flex gap-4 flex-col">
                <div>
                    <label class="sr-only" for="title">Title:</label>
                    <input type="text" 
                        name="title" 
                        id="title" 
                        placeholder="Project Title" 
                        class="w-full pl-4 pr-2 py-3 bg-zinc-700/50 border border-zinc-600 rounded-xl text-zinc-100 placeholder-zinc-400 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500" 
                        required>
                </div>
                
                <div>
                    <label class="sr-only" for="description">Description:</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        placeholder="Add a project description (optional)" 
                        rows="3" 
                        class="w-full pl-4 pr-2 py-3 bg-zinc-700/50 border border-zinc-600 rounded-xl text-zinc-100 placeholder-zinc-400 transition-all duration-200 resize-none focus:outline-none focus:ring-2 focus:ring-orange-500"
                    ></textarea>
                </div>
        
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end gap-3 pt-2">
                
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-200">
                    
                    <span x-show="!loading" class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        Create Project
                    </span>
                    
                </button>
            </div>

        </form>
    </div>
</div>