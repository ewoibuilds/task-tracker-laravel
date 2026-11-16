<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

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
        return view('tasks.edit', ['task' => $task]);
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $task->update($data);

        return redirect()->route('tasks.index')->with('status', 'Task saved.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('status', 'Task deleted.');
    }
}
