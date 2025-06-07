<div class="flex items-center gap-3 ml-6">
    <!-- Edit Task -->
    <button @click="isEditing = !isEditing" 
        class="group/btn p-2 bg-zinc-700/50 rounded-lg hover:bg-orange-500/20 border border-zinc-600 hover:border-orange-500/50 transition-all duration-300">
        <svg class="w-5 h-5 text-zinc-400 group-hover/btn:text-orange-400 transition-colors" fill="currentColor" viewBox="0 0 20 20">
            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
        </svg>
    </button>

    <!-- Toggle Task Status -->
    <button @click="toggleTaskStatus()" 
        class="group/btn p-2 bg-zinc-700/50 rounded-lg border border-zinc-600 transition-all duration-300"
        :class="task?.completed ? 'hover:bg-red-500/20 hover:border-red-500/50' : 'hover:bg-green-500/20 hover:border-green-500/50'">
        <svg class="w-5 h-5 text-zinc-400 transition-colors" fill="currentColor" viewBox="0 0 20 20"
            :class="task?.completed ? 'group-hover/btn:text-red-400' : 'group-hover/btn:text-green-500'">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
    </button>
    
    <!-- Delete Task -->
    <button @click="deleteTask()" 
        class="group/btn p-2 bg-zinc-700/50 rounded-lg hover:bg-red-500/20 border border-zinc-600 hover:border-red-500/50 transition-all duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-zinc-400 group-hover/btn:text-red-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7L5 7M10 11V17M14 11V17M5 7L6 19C6 20.105 6.895 21 8 21H16C17.105 21 18 20.105 18 19L19 7M9 7V4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V7" />
        </svg>
    </button>
</div>