<!-- Page Container -->
<div class="w-full px-6">
    <!-- Centered Content with Max Width -->
    <div class="max-w-7xl mx-auto">
        <!-- Navbar -->
        <div class="z-10 my-4 p-4 bg-zinc-800/70 backdrop-blur-sm border border-zinc-700 rounded-xl shadow-xl flex items-center justify-between">    
            <!-- Left: Logo and Title -->
            <div class="flex items-center gap-2">
                <!-- Logo -->
                <div class="w-8 h-8 flex items-center justify-center bg-gradient-to-br from-orange-500 to-orange-600 rounded-full shadow-lg">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                <!-- Title -->
                <h1 class="hidden md:inline text-3xl font-extrabold tracking-tight">
                    <span class="bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent">
                        Lara<span class="text-zinc-100">list</span>
                    </span>
                </h1>
            </div>

            <!-- Right: Auth Buttons -->
            <div class="flex gap-3">
                <!-- Conditionally display auth buttons depending on authentication status -->
                @auth
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button 
                            type="submit" 
                            class="px-5 py-2 bg-zinc-800 text-zinc-100 font-semibold rounded-xl border-2 border-zinc-700 hover:border-red-500 hover:text-red-400 transition-all duration-300 hover:cursor-pointer"
                        >
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ url('register') }}" class="px-5 py-2 flex items-center justify-center bg-zinc-800 text-zinc-100 font-semibold rounded-xl border-2 border-zinc-700 hover:border-orange-500 transition-all duration-300 hover:cursor-pointer">
                        Register
                    </a>
                    <a href="{{ url('/login') }}" class="px-5 py-2 flex items-center justify-center bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-xl hover:cursor-pointer">
                        Log In
                    </a>
                @endauth
            </div>

            <!-- Future Enhancement: User Profile Dropdown -->
            <!-- Display user icon with first letter of username -->
        </div>
    </div>
</div

