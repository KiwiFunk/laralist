<button 
    type="submit" 
    :disabled="loading"
    class="group inline-flex items-center justify-center gap-2 px-5 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-xl shadow-lg transition-all duration-300 transform hover:scale-101 hover:from-orange-600 hover:to-orange-700"
    :class="loading ? 'opacity-50 cursor-not-allowed' : ''"
>
    <!-- Loading spinner -->
    <svg x-show="loading" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>
                        
    <!-- Plus icon -->
    <svg x-show="!loading" class="w-4 h-4 group-hover:rotate-90 transition-transform" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
    </svg>
                        
    <span x-show="!loading" class="hidden sm:inline">Add Task</span>
    <span x-show="loading" class="hidden sm:inline">Creating...</span>
    <span x-show="!loading" class="sm:hidden">Add</span>
    <span x-show="loading" class="sm:hidden">...</span>
</button>