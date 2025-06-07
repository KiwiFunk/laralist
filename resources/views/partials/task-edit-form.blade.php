<!-- Task Edit Mode -->
<div x-show="isEditing">
    <form @submit.prevent="updateTask()" action="/tasks/{{ $task->id }}" method="POST" class="space-y-4" x-ref="editForm">
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
                            value="1" 
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