@extends('tasks.layout')

@section('title', 'My tasks')

@section('content')
  <h1>My tasks</h1>

  <form method="POST" action="{{ route('tasks.store') }}">
    @csrf
    <p>
      <label for="title">New task</label><br>
      <input id="title" name="title" value="{{ old('title') }}" maxlength="200" required>
      @error('title') <span class="error">{{ $message }}</span> @enderror
    </p>
    <p>
      <label for="notes">Notes (optional)</label><br>
      <textarea id="notes" name="notes" maxlength="2000">{{ old('notes') }}</textarea>
      @error('notes') <span class="error">{{ $message }}</span> @enderror
    </p>
    <button type="submit">Add task</button>
  </form>

  <ul>
    @forelse ($tasks as $task)
      <li>
        <span @class(['done' => $task->done_at])>{{ $task->title }}</span>
        <form class="inline" method="POST" action="{{ route('tasks.toggle', $task) }}">
          @csrf
          @method('PATCH')
          <button type="submit">{{ $task->done_at ? 'Mark as not done' : 'Mark as done' }}</button>
        </form>
        <a href="{{ route('tasks.edit', $task) }}">Edit</a>
        <form class="inline" method="POST" action="{{ route('tasks.destroy', $task) }}">
          @csrf
          @method('DELETE')
          <button type="submit">Delete</button>
        </form>
      </li>
    @empty
      <li>No tasks yet. Add your first one above.</li>
    @endforelse
  </ul>

  {{ $tasks->links() }}
@endsection
