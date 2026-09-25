@extends('layouts.app')

@section('title', 'Add Task | Personal Task Manager')

@section('content')
<div class="card form-card">
    <div class="page-header">
        <div>
            <h1>Add Task</h1>
            <p class="subtitle">Create a new personal task.</p>
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

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <div class="field">
            <label for="task_name">Task Name</label>
            <input id="task_name" type="text" name="task_name" value="{{ old('task_name') }}"
                   placeholder="Example: Finish Laravel project" required>
            @error('task_name')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
            <label for="description">Description</label>
            <textarea id="description" name="description"
                      placeholder="Write a short description of the task...">{{ old('description') }}</textarea>
            @error('description')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
            <label for="due_date">Due Date</label>
            <input id="due_date" type="date" name="due_date" value="{{ old('due_date') }}" required>
            @error('due_date')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Task</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-ghost">Cancel</a>
        </div>
    </form>
</div>
@endsection
