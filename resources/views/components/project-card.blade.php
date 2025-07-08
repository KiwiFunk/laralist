<div 
    x-data="projectCard({{ $project->id }})"
    class="group relative bg-zinc-800/70 backdrop-blur-sm border border-zinc-700 rounded-xl p-6 hover:border-orange-500/50 transition-all duration-500 transform hover:scale-[1.01] hover:shadow-2xl hover:shadow-orange-500/10"
    style="animation: slideInUp 0.6s ease-out {{ $index * 0.1 }}s both;"
>
    <h2 x-text="project.name"></h2>

</div>