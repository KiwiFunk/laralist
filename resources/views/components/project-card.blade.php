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
                        class="text-2xl font-bold"
                    ></h2>
                </div>
                
                <!-- Project Description -->
                <p
                    x-text="project?.description"
                    class="text-zinc-400 mb-4 leading-relaxed"
                ></p>
                
            </div>

            <!-- Action Buttons -->
            
        </div>
    </a>

</div>