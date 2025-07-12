
<!-- Modal Box -->
<div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" x-show="isOpen" @click.away="isOpen = false">
    <!-- Modal Content -->
    <div class="bg-zinc-800 rounded-lg shadow-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-semibold text-zinc-100 mb-4">Create New Project</h2>
        <form @submit.prevent="createProject($event)" action="/projects" method="POST" class="space-y-4">
            @csrf
            <div class="flex gap-4 flex-col md:flex-row md:items-center">
                <div class="flex-1">
                    <label class="sr-only" for="title">Title:</label>
                    <input type="text" 
                        name="title" 
                        id="title" 
                        placeholder="Project Title" 
                        class="w-full pl-4 pr-2 py-3 bg-zinc-700/50 border border-zinc-600 rounded-xl text-zinc-100 placeholder-zinc-400 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500" 
                        required>
                </div>
                
                <div class="flex-2">
                    <label class="sr-only" for="description">Description:</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        placeholder="Add more details (optional)" 
                        rows="1" 
                        class="w-full pl-4 pr-2 py-3 bg-zinc-700/50 border border-zinc-600 rounded-xl text-zinc-100 placeholder-zinc-400 transition-all duration-200 resize-none focus:outline-none focus:ring-2 focus:ring-orange-500"
                    ></textarea>
                </div>
            
                @include('partials.submit-button')
            </div>
        </form>
    </div>
</div>