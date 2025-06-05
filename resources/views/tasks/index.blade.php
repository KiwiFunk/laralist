<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Tasks | LaraList</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-900 text-zinc-100 flex justify-center py-12">
    <div class="max-w-4xl w-full px-6">
        <h1 class="text-4xl font-bold text-orange-500 mb-6">Your Task List</h1>

        <!-- Task Cards -->
        <div class="grid gap-6">
            @foreach($tasks as $task)
                <div class="px-6 py-4 bg-zinc-800 text-zinc-100 font-semibold rounded-xl border-2 border-zinc-700 hover:border-orange-500 transition-all duration-300 transform hover:scale-101 hover:bg-gray-750">
                    <h2 class="text-2xl font-semibold text-orange-400">{{ $task->title }}</h2>
                    <p class="text-zinc-400 text-sm mt-2 font-normal">{{ $task->description }}</p>

                    <!-- Task Footer -->
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-sm px-3 py-1 rounded-md font-medium {{ $task->completed ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                            {{ $task->completed ? 'Completed' : 'Pending' }}
                        </span>

                        <div class="flex space-x-3">
                            <a href="/tasks/{{ $task->id }}/edit" class="text-orange-400 hover:text-orange-500 transition">Edit</a>
                            <form action="/tasks/{{ $task->id }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-600 transition">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>