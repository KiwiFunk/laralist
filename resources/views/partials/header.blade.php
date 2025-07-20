<div class="text-left mb-12"
    x-data="{ project: $store.taskManager.project }"
>

    <h1 class="text-5xl font-black bg-gradient-to-r from-orange-500 to-orange-700 bg-clip-text text-transparent pb-2 tracking-tight"
        x-text="project?.title"
    >
    </h1>
    
    <p class="text-zinc-400 text-lg"
        x-text="project?.description"
    ></p>
    
</div>