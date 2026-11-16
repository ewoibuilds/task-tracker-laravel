<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $request->user()->tasks()->latest()->paginate(20),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $request->user()->tasks()->create($data);

        return redirect()->route('tasks.index')->with('status', 'Task added.');
    }

    public function edit(Task $task)
    {
        Gate::authorize('update', $task);

        return view('tasks.edit', ['task' => $task]);
    }

    public function update(Request $request, Task $task)
    {
        Gate::authorize('update', $task);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $task->update($data);

        return redirect()->route('tasks.index')->with('status', 'Task saved.');
    }

    public function toggle(Task $task)
    {
        Gate::authorize('update', $task);

        $task->update(['done_at' => $task->done_at ? null : now()]);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        Gate::authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('status', 'Task deleted.');
    }
}
