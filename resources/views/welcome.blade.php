<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laralist</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-900 text-gray-100 overflow-hidden">

    <!-- Animated Wave Background -->
    <div class="fixed inset-0 z-0">
        <!-- Set SVG container to cover the entire viewport -->
        <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1000 1000" preserveAspectRatio="none">
            <!-- Define SVG graphics to be used for the animated waves -->
            <defs>
                <linearGradient id="waveGradient1" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#f97316;stop-opacity:0.15" />
                    <stop offset="50%" style="stop-color:#ea580c;stop-opacity:0.25" />
                    <stop offset="100%" style="stop-color:#f97316;stop-opacity:0.15" />
                </linearGradient>
                <linearGradient id="waveGradient2" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#fb923c;stop-opacity:0.1" />
                    <stop offset="50%" style="stop-color:#f97316;stop-opacity:0.2" />
                    <stop offset="100%" style="stop-color:#fb923c;stop-opacity:0.1" />
                </linearGradient>
                <linearGradient id="waveGradient3" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#fed7aa;stop-opacity:0.08" />
                    <stop offset="50%" style="stop-color:#fb923c;stop-opacity:0.15" />
                    <stop offset="100%" style="stop-color:#fed7aa;stop-opacity:0.08" />
                </linearGradient>
            </defs>
            
            <!-- Wave 1 -->
            <path stroke="url(#waveGradient1)" stroke-width="2" fill="none">
                <animate attributeName="d" 
                    values="M0,150 Q250,120 500,150 T1000,150;
                            M0,160 Q250,110 500,160 T1000,160;
                            M0,140 Q250,130 500,140 T1000,140;
                            M0,150 Q250,120 500,150 T1000,150" 
                    dur="8s" repeatCount="indefinite"/>
            </path>
            
            <!-- Wave 2 -->
            <path stroke="url(#waveGradient2)" stroke-width="1.5" fill="none">
                <animate attributeName="d" 
                    values="M0,300 Q200,280 400,300 T800,300 T1200,300;
                            M0,310 Q200,270 400,310 T800,310 T1200,310;
                            M0,290 Q200,290 400,290 T800,290 T1200,290;
                            M0,300 Q200,280 400,300 T800,300 T1200,300" 
                    dur="12s" repeatCount="indefinite"/>
            </path>
            
            <!-- Wave 3 -->
            <path stroke="url(#waveGradient1)" stroke-width="2" fill="none">
                <animate attributeName="d" 
                    values="M0,450 Q300,420 600,450 T1200,450;
                            M0,440 Q300,430 600,440 T1200,440;
                            M0,460 Q300,410 600,460 T1200,460;
                            M0,450 Q300,420 600,450 T1200,450" 
                    dur="10s" repeatCount="indefinite"/>
            </path>
            
            <!-- Wave 4 -->
            <path stroke="url(#waveGradient3)" stroke-width="1" fill="none">
                <animate attributeName="d" 
                    values="M0,600 Q150,580 300,600 T600,600 T900,600 T1200,600;
                            M0,590 Q150,590 300,590 T600,590 T900,590 T1200,590;
                            M0,610 Q150,570 300,610 T600,610 T900,610 T1200,610;
                            M0,600 Q150,580 300,600 T600,600 T900,600 T1200,600" 
                    dur="15s" repeatCount="indefinite"/>
            </path>
            
            <!-- Wave 5 -->
            <path stroke="url(#waveGradient2)" stroke-width="1.5" fill="none">
                <animate attributeName="d" 
                    values="M0,750 Q400,720 800,750 T1600,750;
                            M0,760 Q400,710 800,760 T1600,760;
                            M0,740 Q400,730 800,740 T1600,740;
                            M0,750 Q400,720 800,750 T1600,750" 
                    dur="18s" repeatCount="indefinite"/>
            </path>
            
            <!-- Wave 6 -->
            <path stroke="url(#waveGradient3)" stroke-width="1" fill="none">
                <animate attributeName="d" 
                    values="M0,900 Q250,880 500,900 T1000,900 T1500,900;
                            M0,890 Q250,890 500,890 T1000,890 T1500,890;
                            M0,910 Q250,870 500,910 T1000,910 T1500,910;
                            M0,900 Q250,880 500,900 T1000,900 T1500,900" 
                    dur="20s" repeatCount="indefinite"/>
            </path>
        </svg>
    </div>

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