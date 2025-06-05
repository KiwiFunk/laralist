<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Task</title>
</head>
<body>
    <h1>Create a New Task</h1>
    
    <form action="/tasks" method="POST">
        @csrf <!-- Protects against cross-site request forgery -->
        
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>
        
        <button type="submit">Add Task</button>
    </form>
</body>
</html>