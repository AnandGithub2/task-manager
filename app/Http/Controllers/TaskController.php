<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Task::create($request->all());

        return redirect()->back()->with('success', 'Task added successfully!');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully!');
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update(['is_completed' => !$task->is_completed]);

        return redirect()->back()->with('success', 'Task status updated!');
    }
}
