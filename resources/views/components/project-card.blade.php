<div 
    x-data="projectCard({{ $project->id }})"
    class="group relative bg-zinc-800/70 backdrop-blur-sm border border-zinc-700 rounded-xl p-6 hover:border-orange-500/50 transition-all duration-500 transform hover:scale-[1.01] hover:shadow-2xl hover:shadow-orange-500/10"
    style="animation: slideInUp 0.6s ease-out {{ $index * 0.1 }}s both;"
>
    <a href="{{ route('projects.show', $project) }}" class="absolute inset-0 z-10"></a>
        
    <div class="flex items-start justify-between">
        <div class="flex-1">
            <div class="flex items-center gap-3 mb-3">
                <!-- Project Title -->
                <h2 x-text="project?.title" 
                    class="text-2xl font-bold text-white">
                    {{ $project->title }}
                </h2>
            </div>
            
            <!-- Project Description -->
            <p x-text="project?.description"
               class="text-zinc-400 mb-4 leading-relaxed">
                {{ $project->description }}
            </p>

            <!-- Project Stats -->
            <div class="flex items-center gap-6 text-sm text-zinc-500 mb-4">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-zinc-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ $project->total_tasks_count }} {{ Str::plural('task', $project->total_tasks_count) }}</span>
                </div>
                
                @if($project->total_tasks_count > 0)
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $project->completed_tasks_count }} completed</span>
                    </div>
                    
                    @if($project->pending_tasks_count > 0)
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ $project->pending_tasks_count }} pending</span>
                        </div>
                    @endif
                @endif
            </div>

            <!-- Created Date -->
            <div class="flex items-center gap-2 text-xs text-zinc-500 mt-4">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                <span>Created {{ $project->created_at->format('M j, Y') }}</span>
            </div>
        </div>

        <!-- Action Buttons -->
       
    </div>
</div>