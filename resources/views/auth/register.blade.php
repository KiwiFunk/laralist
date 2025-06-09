@extends('layouts.app')

@section('title', 'Register | LaraList')

@section('content')
<!-- Page Container -->
    <div class="min-h-screen flex items-center justify-center px-6">
        <!-- Content Container -->    
        <div class="w-full max-w-md bg-zinc-800/70 backdrop-blur-sm border border-zinc-700 rounded-xl p-8 shadow-xl">
            <h1 class="text-3xl font-bold text-center mb-8 bg-gradient-to-r from-orange-400 to-orange-600 bg-clip-text text-transparent">
                Create an Account
            </h1>
            
            <form method="POST" action="/register" class="space-y-6">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-medium text-zinc-300 mb-2">Name</label>
                    <input type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        class="w-full px-4 py-3 bg-zinc-700/50 border border-zinc-600 rounded-xl text-zinc-100 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        required>
                    @error('name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-zinc-300 mb-2">Email</label>
                    <input type="email" 
                        id="email" 
                        name="email" 
                            value="{{ old('email') }}"
                        class="w-full px-4 py-3 bg-zinc-700/50 border border-zinc-600 rounded-xl text-zinc-100 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        required>
                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-zinc-300 mb-2">Password</label>
                    <input type="password" 
                        id="password" 
                        name="password"
                        class="w-full px-4 py-3 bg-zinc-700/50 border border-zinc-600 rounded-xl text-zinc-100 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        required>
                    @error('password')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-zinc-300 mb-2">Confirm Password</label>
                    <input type="password" 
                        id="password_confirmation" 
                        name="password_confirmation"
                        class="w-full px-4 py-3 bg-zinc-700/50 border border-zinc-600 rounded-xl text-zinc-100 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        required>
                </div>
                
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold py-3 rounded-xl hover:from-orange-600 hover:to-orange-700 transition-all duration-300 transform hover:scale-[1.01]">
                    Create Account
                </button>
            </form>
            
            <p class="text-center text-zinc-400 mt-6">
                Already have an account? 
                <a href="/login" class="text-orange-400 hover:text-orange-300 transition-colors">Sign in</a>
            </p>
        </div>
    </div>
@endsection