<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task List</title>
</head>
<body>
    <h1>All Tasks</h1>

    <ul>
        @foreach($tasks as $task)
            <li>
                <strong>{{ $task->title }}</strong>: {{ $task->description }}
                @if($task->completed)
                    ✅ Completed
                @else
                    ❌ Not Done
                @endif
                | <a href="/tasks/{{ $task->id }}/edit">Edit</a>
            </li>
        @endforeach
    </ul>

    <a href="/tasks/create">Create New Task</a>
</body>
</html>