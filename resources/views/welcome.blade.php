<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center p-10 bg-white shadow-lg rounded-lg">
        <h1 class="text-4xl font-bold text-blue-500">Welcome to Task Manager</h1>
        <p class="text-gray-700 text-lg mt-4">Your personal to-do list made simple.</p>

        <div class="mt-6">
            <a href="/tasks" class="px-6 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">View Tasks</a>
            <a href="/tasks/create" class="px-6 py-3 bg-purple-500 text-white rounded-md hover:bg-purple-600 transition ml-4">Add Task</a>
        </div>
    </div>
</body>
</html>