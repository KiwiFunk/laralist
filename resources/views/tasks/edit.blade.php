<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>

    <form action="/tasks/{{ $task->id }}" method="POST">
        @csrf
        @method('PUT') <!-- Tells Laravel this is an update request -->

        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ $task->title }}" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description">{{ $task->description }}</textarea>

        <label for="completed">Completed:</label>
        <input type="checkbox" name="completed" {{ $task->completed ? 'checked' : '' }}>

        <button type="submit">Update Task</button>
    </form>
</body>
</html>