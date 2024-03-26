<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        try {
            if (!Auth::user()->isSuperAdmin()) {
                $tasks = Task::where('assigned_to', Auth::id())->get();
            } else {
                $tasks = Task::all();
            }
            return response()->json(['tasks' => $tasks], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $task = Task::findOrFail($id);
            if (!$this->userHasPermission($task)) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            return response()->json(['task' => $task], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            if (!Auth::user()->isSuperAdmin()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $this->validate($request, [
                'title' => 'required|string|max:150',
                'description' => 'nullable|string',
                'assigned_to' => 'required|exists:users,id'
            ]);
            $task = new Task();
            $task->title = $request->title;
            $task->description = $request->description;
            $task->assigned_to = $request->assigned_to;
            $task->created_by = Auth::id();
            $task->save();

            return response()->json(['task' => $task], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function destroy($id)
    {
        try {
            if (!Auth::user()->isSuperAdmin()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $task = Task::findOrFail($id);
            $task->delete();

            return response()->json(['message' => 'Task deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    private function userHasPermission($task)
    {
        if (Auth::user()->isSuperAdmin()) {
            return true;
        }
        if ($task->assigned_to == Auth::id()) {
            return true;
        }
        return false;
    }
}