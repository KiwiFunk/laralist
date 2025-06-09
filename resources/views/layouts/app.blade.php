<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LaraList')</title>
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Additional head content -->
    @stack('head')
</head>

<body class="bg-zinc-900 text-zinc-100 min-h-screen relative">

    <!-- Animated Wave Background -->
    @include('partials.waves-background')
    
    <!-- Conditional Navigation (only show on app pages, not auth pages) -->
    @hasSection('navbar')
        @yield('navbar')
    @endif

    <!-- Main Content -->
    <main class="relative z-10">
        @yield('content')
    </main>

    <!-- Additional scripts -->
    @stack('scripts')
</body>
</html>