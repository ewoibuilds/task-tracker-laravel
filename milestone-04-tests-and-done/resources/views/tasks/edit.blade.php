@extends('tasks.layout')

@section('title', 'Edit task')

@section('content')
  <h1>Edit task</h1>

  <form method="POST" action="{{ route('tasks.update', $task) }}">
    @csrf
    @method('PUT')
    <p>
      <label for="title">Title</label><br>
      <input id="title" name="title" value="{{ old('title', $task->title) }}" maxlength="200" required>
      @error('title') <span class="error">{{ $message }}</span> @enderror
    </p>
    <p>
      <label for="notes">Notes (optional)</label><br>
      <textarea id="notes" name="notes" maxlength="2000">{{ old('notes', $task->notes) }}</textarea>
      @error('notes') <span class="error">{{ $message }}</span> @enderror
    </p>
    <button type="submit">Save</button>
    <a href="{{ route('tasks.index') }}">Cancel</a>
  </form>
@endsection
