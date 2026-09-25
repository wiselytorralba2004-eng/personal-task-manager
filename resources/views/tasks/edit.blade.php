@extends('layouts.app')

@section('title', 'Edit Task | Personal Task Manager')

@section('content')
<div class="card form-card">
    <div class="page-header">
        <div>
            <h1>Edit Task</h1>
            <p class="subtitle">Update the task information below.</p>
        </div>
    </div>

    @if($errors->any())
        <div class="validation-summary">
            <strong>Please fix the following:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="field">
            <label for="task_name">Task Name</label>
            <input id="task_name" type="text" name="task_name"
                   value="{{ old('task_name', $task->task_name) }}" required>
            @error('task_name')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description', $task->description) }}</textarea>
            @error('description')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="Pending" @selected(old('status', $task->status) === 'Pending')>Pending</option>
                <option value="Completed" @selected(old('status', $task->status) === 'Completed')>Completed</option>
            </select>
            @error('status')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
            <label for="due_date">Due Date</label>
            <input id="due_date" type="date" name="due_date"
                   value="{{ old('due_date', $task->due_date->format('Y-m-d')) }}" required>
            @error('due_date')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Task</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-ghost">Cancel</a>
        </div>
    </form>
</div>
@endsection
