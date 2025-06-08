<div class="text-left mb-12">

    <!--
    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full mb-4 shadow-lg">
        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
    </div>
    -->

    <h1 class="text-5xl font-black bg-gradient-to-r from-orange-500 to-orange-700 bg-clip-text text-transparent mb-2 tracking-tight">
        Your Tasks
    </h1>
    @Auth
        <p class="text-zinc-400 text-lg ">Hi, {{ Auth::user()->name }}. What are we doing today?</p>
    @else
        <p class="text-zinc-400 text-lg">Hey! You shouldn't be here! How did you get here without logging in?!</p>
    @endAuth
</div>