<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" x-data="{}">
    <div class="bg-zinc-800/50 backdrop-blur-sm border border-zinc-700 rounded-xl p-5 text-center">
        <div class="text-3xl font-bold text-zinc-200 mb-1" x-text="$store.taskManager.stats.total"></div>
        <div class="text-zinc-400 text-sm">Total Tasks</div>
    </div>
    <div class="bg-zinc-800/50 backdrop-blur-sm border border-zinc-700 rounded-xl p-5 text-center">
        <div class="text-3xl font-bold text-green-400 mb-1" x-text="$store.taskManager.stats.completed"></div>
        <div class="text-zinc-400 text-sm">Completed</div>
    </div>
    <div class="bg-zinc-800/50 backdrop-blur-sm border border-zinc-700 rounded-xl p-5 text-center">
        <div class="text-3xl font-bold text-red-400 mb-1" x-text="$store.taskManager.stats.pending"></div>
        <div class="text-zinc-400 text-sm">Pending</div>
    </div>
</div>