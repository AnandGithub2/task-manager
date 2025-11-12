<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
  <h1 class="text-center mb-4">📝 Task Manager</h1>

  <!-- Add Task Form -->
  <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
    @csrf
    <div class="input-group">
      <input type="text" name="title" class="form-control" placeholder="Enter task title..." required>
      <button class="btn btn-success">Add</button>
    </div>
  </form>

  <!-- Task List -->
  <ul class="list-group">
    @foreach($tasks as $task)
      <li class="list-group-item d-flex justify-content-between align-items-center {{ $task->is_completed ? 'bg-success text-light' : '' }}">
        <div>
          <strong>{{ $task->title }}</strong>
          <small class="d-block">{{ $task->description }}</small>
        </div>

        <div>
          <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="d-inline">
            @csrf
            @method('PUT')
            <button class="btn btn-sm btn-warning">{{ $task->is_completed ? 'Undo' : 'Done' }}</button>
          </form>

          <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger">Delete</button>
          </form>
        </div>
      </li>
    @endforeach
  </ul>
</div>

</body>
</html>
