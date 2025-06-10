@extends('layouts.app')

@section('title', 'LaraList')

@section('navbar')
    <x-navbar />
@endsection

@section('content')
    <!-- Page Container -->
    <div class="min-h-screen flex items-center justify-center px-6">
        <!-- Content Container -->
        <div class="text-center max-w-4xl pt-20 pb-12">
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
                @auth
                    <a href="/tasks" class="group px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-orange-500/25 transition-all duration-300 transform hover:scale-105 hover:from-orange-600 hover:to-orange-700">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            View Your Tasks
                        </span>
                    </a>
                @else
                    <a href="/login" class="group px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-orange-500/25 transition-all duration-300 transform hover:scale-105 hover:from-orange-600 hover:to-orange-700">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Log In
                        </span>
                    </a>
                        
                    <a href="/register" class="group px-8 py-4 bg-zinc-800 text-zinc-100 font-semibold rounded-xl border-2 border-zinc-700 hover:border-orange-500 transition-all duration-300 transform hover:scale-105 hover:bg-gray-750">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                            Register
                        </span>
                    </a>
                @endauth
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

            <!-- GitHub Badge Section -->
            <div class="flex flex-wrap justify-center gap-3 mt-8">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-500/20 text-orange-400 border border-orange-500/30">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Live Demo
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-zinc-700/50 text-zinc-300 border border-zinc-600">
                    Laravel 12
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-zinc-700/50 text-zinc-300 border border-zinc-600">
                    Alpine.js 3.x
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-zinc-700/50 text-zinc-300 border border-zinc-600">
                    Tailwind CSS
                </span>
                <a href="https://github.com/KiwiFunk/laralist" target="_blank" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-zinc-800 text-zinc-300 border border-zinc-600 hover:border-orange-500 transition-colors">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 25 25">
                        <path fill-rule="evenodd" d="M12.017 1.2C5.5 1.2.983 5.718.983 12.236c0 4.86 3.152 8.983 7.523 10.437.55.101.75-.238.75-.53 0-.262-.01-.952-.015-1.87-3.06.665-3.706-1.475-3.706-1.475-.5-1.27-1.222-1.608-1.222-1.608-.999-.683.075-.669.075-.669 1.105.078 1.685 1.134 1.685 1.134.981 1.68 2.575 1.195 3.202.914.1-.71.384-1.195.698-1.47-2.442-.278-5.01-1.222-5.01-5.437 0-1.2.428-2.183 1.132-2.952-.113-.278-.49-1.397.108-2.91 0 0 .923-.295 3.025 1.127A10.536 10.536 0 0112.017 6.52c.924.004 1.856.125 2.728.368 2.1-1.422 3.022-1.127 3.022-1.127.6 1.513.222 2.632.11 2.91.705.769 1.131 1.751 1.131 2.952 0 4.226-2.572 5.156-5.022 5.428.395.34.747 1.01.747 2.037 0 1.47-.013 2.658-.013 3.017 0 .295.199.636.756.528 4.367-1.456 7.515-5.579 7.515-10.434C23.051 5.718 18.535 1.2 12.017 1.2z" clip-rule="evenodd"/>
                    </svg>
                    View on GitHub
                </a>
            </div>

            <div class="mt-6 text-zinc-500 text-sm">
                Built with ❤️ by 
                <a href="https://kiwifunk.com" target="_blank" class="text-orange-400 hover:text-orange-300 transition-colors">
                    @KiwiFunk
                </a>
            </div>
        </div>
    </div>
@endsection