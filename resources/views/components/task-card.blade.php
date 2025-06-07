<div 
    x-data="taskCard({{ $task->id }})"
    class="group relative bg-zinc-800/70 backdrop-blur-sm border border-zinc-700 rounded-xl p-6 hover:border-orange-500/50 transition-all duration-500 transform hover:scale-[1.01] hover:shadow-2xl hover:shadow-orange-500/10"
    style="animation: slideInUp 0.6s ease-out {{ $index * 0.1 }}s both;"
>
    <!-- Task Status Indicator -->
    <div class="absolute -left-2 top-6 w-4 h-4 rounded-full shadow-lg"
        :class="task?.completed ? 'bg-green-500' : 'bg-orange-500'">
    </div>
    
    <!-- Task Display Mode -->
    <div x-show="!isEditing" class="flex items-start justify-between">
        <div class="flex-1">
            <div class="flex items-center gap-3 mb-3">
                <!-- Task Title -->
                <h2 x-text="task?.title" 
                    class="text-2xl font-bold"
                    :class="task?.completed ? 'line-through opacity-75' : ''">
                </h2>
                <!-- Checkmark Icon -->
                <svg x-show="task?.completed" 
                    class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            
            <!-- Task Description -->
            <p x-show="task?.description" 
                x-text="task?.description"
                class="text-zinc-400 mb-4 leading-relaxed"
                :class="task?.completed ? 'line-through opacity-75' : ''">
            </p>

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
        @include('partials.task-actions')
    </div>

    <!-- Task Edit Mode -->
    @include('partials.task-edit-form')
</div>