<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Customer;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // List all tasks
    public function index()
{
    if (auth()->user()->role == 'sales') {
        // Sales → only their pending tasks
        $tasks = Task::where('assigned_user_id', auth()->id())
                     ->where('status', 'pending')
                     ->get();
    } else {
        // Admin → all pending tasks
        $tasks = Task::where('status', 'pending')->get();
    }

    return view('tasks.index', compact('tasks'));
}

    // Show create task form
    public function create()
    {
        $customers = Customer::all();
        $leads = Lead::all();

        // Filter users based on logged-in role
        if (auth()->user()->role == 'sales') {
            $users = User::where('role', 'sales')->get();
        } else {
            $users = User::all();
        }

        return view('tasks.create', compact('customers', 'leads', 'users'));
    }

    // Store a new task
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'related_type' => 'required|in:lead,customer',
        'related_id' => 'required',
        'assigned_user_id' => 'required|exists:users,id',
        'due_date' => 'required|date'
    ]);

    // Sales can only assign to themselves
    if (auth()->user()->role == 'sales') {
        $validated['assigned_user_id'] = auth()->id();
    }

    $task = Task::create([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'related_type' => $validated['related_type'],
        'related_id' => $validated['related_id'],
        'assigned_user_id' => $validated['assigned_user_id'],
        'due_date' => $validated['due_date'],
        'status' => 'pending',
    ]);

    logActivity(
        'Task Created',
        'Task: ' . $task->title,
        'Task',
        $task->id
    );

    return redirect()->route('tasks.index');
}

    // Show edit form
    public function edit(Task $task)
    {
        $customers = Customer::all();
        $leads = Lead::all();

        // Filter users based on role
        if (auth()->user()->role == 'sales') {
            $users = User::where('role', 'sales')->get();
        } else {
            $users = User::all();
        }

        return view('tasks.edit', compact('task', 'customers', 'leads', 'users'));
    }

    // Update task
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'assigned_user_id' => 'required|integer|exists:users,id',
            'related_type' => 'required|string|in:Customer,Lead',
            'related_id' => 'required|integer',
            'status' => 'nullable|string|in:Pending,Completed',
            'due_date' => 'required|date',
        ]);

        // Enforce assignment rules for sales users
        if (auth()->user()->role == 'sales') {
            $request->assigned_user_id = auth()->id();
        }

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'related_type' => $request->related_type,
            'related_id' => $request->related_id,
            'assigned_user_id' => $request->assigned_user_id,
            'due_date' => $request->due_date,
            'status' => $request->status ?? 'Pending',
        ]);

        $this->logActivity("Updated Task: {$task->title}");

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    // Delete task
    public function destroy(Task $task)
    {
        $task->delete();

        $this->logActivity("Deleted Task: {$task->title}");

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    // Mark completed
    public function markCompleted(Task $task)
    {
        $task->update([
            'status' => 'Completed',
        ]);

        $this->logActivity("Marked Task as Completed: {$task->title}");

        return redirect()->route('tasks.index')->with('success', 'Task marked as completed.');
    }

    // Activity logging
    protected function logActivity($activity, $userId = null)
    {
        \DB::table('activity_logs')->insert([
            'user_id' => $userId ?? Auth::id(),
            'action' => $activity,
            'related_type' => 'Task',
            'related_id' => null,
            'description' => $activity,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}