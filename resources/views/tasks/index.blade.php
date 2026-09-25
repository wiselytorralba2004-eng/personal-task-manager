@extends('layouts.app')

@section('title', 'My Tasks | Personal Task Manager')

@section('content')
<div class="page-header">
    <div>
        <h1>My Tasks</h1>
        <p class="subtitle">Keep track of what you need to do and when it is due.</p>
    </div>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ Add Task</a>
</div>

<div class="stats">
    <div class="stat">
        <div class="stat-label">Total Tasks</div>
        <div class="stat-value">{{ $tasks->count() }}</div>
    </div>
    <div class="stat">
        <div class="stat-label">Pending</div>
        <div class="stat-value">{{ $pendingCount }}</div>
    </div>
    <div class="stat">
        <div class="stat-label">Completed</div>
        <div class="stat-value">{{ $completedCount }}</div>
    </div>
</div>

@if($tasks->isEmpty())
    <div class="empty-state">
        <div class="empty-icon">📝</div>
        <h2>No tasks yet</h2>
        <p class="subtitle">Create your first task to start organizing your work.</p>
        <br>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create First Task</a>
    </div>
@else
    <div class="task-grid">
        @foreach($tasks as $task)
            <article class="card">
                <div class="task-top">
                    <div>
                        <h2 class="task-title">{{ $task->task_name }}</h2>
                        <div class="description">{{ $task->description ?: 'No description provided.' }}</div>
                    </div>

                    <span class="badge {{ $task->status === 'Completed' ? 'completed' : 'pending' }}">
                        {{ $task->status }}
                    </span>
                </div>

                <div class="meta">
                    <span><strong>Due:</strong> {{ $task->due_date->format('M d, Y') }}</span>
                    <span><strong>Created:</strong> {{ $task->created_at->format('M d, Y') }}</span>
                </div>

                <div class="actions">
                    <form action="{{ route('tasks.status', $task) }}" method="POST" class="status-form">
                        @csrf
                        @method('PATCH')

                        <select name="status" aria-label="Task status">
                            <option value="Pending" @selected($task->status === 'Pending')>Pending</option>
                            <option value="Completed" @selected($task->status === 'Completed')>Completed</option>
                        </select>

                        <button type="submit" class="btn btn-success">Update Status</button>
                    </form>

                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-secondary">Edit</a>

                    <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                          onsubmit="return confirm('Delete this task?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </article>
        @endforeach
    </div>
@endif
@endsection
