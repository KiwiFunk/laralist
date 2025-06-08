<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laralist</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-900 text-gray-100 overflow-hidden">

    <!-- Animated Wave Background -->
    @include('partials.waves-background')

    <!-- Navigation Bar -->
    <x-navbar />

    <!-- Main Content -->
    <div class="relative z-10 flex items-center justify-center min-h-screen">
        <div class="text-center max-w-4xl px-6 py-12">
            <!-- Logo/Brand Section -->
            <div class="mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full mb-6 shadow-2xl">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h1 class="text-6xl md:text-7xl font-black tracking-tight mb-4">
                    <span class="bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent">Lara<span class="text-zinc-100">list</span></span>
                    
                </h1>
            </div>

            <!-- Tagline -->
            <p class="text-xl md:text-2xl text-zinc-300 mb-8 font-light leading-relaxed">
                Transform chaos into clarity with your
                <span class="text-orange-500 font-medium">personal task manager</span>
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row justify-center gap-4 mb-8">
                <a href="/tasks" class="group px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-orange-500/25 transition-all duration-300 transform hover:scale-105 hover:from-orange-600 hover:to-orange-700">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        View Your Tasks
                    </span>
                </a>
                
                <a href="/tasks/create" class="group px-8 py-4 bg-zinc-800 text-zinc-100 font-semibold rounded-xl border-2 border-zinc-700 hover:border-orange-500 transition-all duration-300 transform hover:scale-105 hover:bg-gray-750">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 group-hover:rotate-90 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        Add New Task
                    </span>
                </a>
            </div>

            <!-- About Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-2xl mx-auto">
                <div class="bg-zinc-800/50 backdrop-blur-sm border border-zinc-700 rounded-lg p-6 text-center">
                    <div class="text-2xl font-bold text-orange-400 mb-2">Simple</div>
                    <div class="text-zinc-400 text-sm">No clutter, just tasks</div>
                </div>
                <div class="bg-zinc-800/50 backdrop-blur-sm border border-zinc-700 rounded-lg p-6 text-center">
                    <div class="text-2xl font-bold text-orange-400 mb-2">Fast</div>
                    <div class="text-zinc-400 text-sm">Built with Laravel</div>
                </div>
                <div class="bg-zinc-800/50 backdrop-blur-sm border border-zinc-700 rounded-lg p-6 text-center">
                    <div class="text-2xl font-bold text-orange-400 mb-2">Modern</div>
                    <div class="text-zinc-400 text-sm">Styled with Tailwind</div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>