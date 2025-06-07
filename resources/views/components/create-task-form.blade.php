<div class="bg-zinc-800/70 backdrop-blur-sm border border-zinc-700 rounded-xl p-6 mb-8 shadow-xl"
     x-data="createTaskForm()">
    <form @submit.prevent="createTask($event)" action="/tasks" method="POST" class="space-y-4">
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
        
            @include('partials.submit-button')
        </div>
    </form>
</div>