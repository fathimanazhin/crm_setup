<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Tag;
use App\Models\User;
use App\Models\Customer;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'sales') {
            $tasks = Task::with(['tags', 'assignedUser'])
                ->where('assigned_user_id', auth()->id())
                ->where('status', 'pending')
                ->get();
        } else {
            $tasks = Task::with(['tags', 'assignedUser'])
                ->where('status', 'pending')
                ->get();
        }

        // ✅ OPTIMIZED: remove duplicates
        $leadIds = $tasks->where('related_type', 'lead')
            ->pluck('related_id')
            ->unique();

        $customerIds = $tasks->where('related_type', 'customer')
            ->pluck('related_id')
            ->unique();

        // ✅ Bulk fetch (NO N+1)
        $leads = Lead::whereIn('id', $leadIds)->get()->keyBy('id');
        $customers = Customer::whereIn('id', $customerIds)->get()->keyBy('id');

        // ✅ Attach related name
        foreach ($tasks as $task) {
            if ($task->related_type == 'lead') {
                $task->related_name = $leads[$task->related_id]->lead_name ?? 'N/A';
            } elseif ($task->related_type == 'customer') {
                $task->related_name = $customers[$task->related_id]->name ?? 'N/A';
            } else {
                $task->related_name = 'N/A';
            }
        }

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $customers = Customer::all();
        $leads = Lead::all();

        if (auth()->user()->role == 'sales') {
            $users = User::where('role', 'sales')->get();
        } else {
            $users = User::all();
        }

        $tags = Tag::all();

        return view('tasks.create', compact('customers', 'leads', 'users', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'related_type' => 'required|string|in:lead,customer',
            'related_id' => 'required',
            'assigned_user_id' => 'required|exists:users,id',
            'due_date' => 'required|date'
        ]);

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

        if ($request->has('tags')) {
            $task->tags()->sync($request->tags);
        }

        // ✅ FIXED LOGGING
        $this->logActivity(
            'Task Created',
            'Task: ' . $task->title,
            'Task',
            $task->id
        );

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        $customers = Customer::all();
        $leads = Lead::all();

        if (auth()->user()->role == 'sales') {
            $users = User::where('role', 'sales')->get();
        } else {
            $users = User::all();
        }

        $tags = Tag::all();

        return view('tasks.edit', compact('task', 'customers', 'leads', 'users', 'tags'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'assigned_user_id' => 'required|integer|exists:users,id',
            'related_type' => 'required|string|in:lead,customer',
            'related_id' => 'required|integer',
            'status' => 'nullable|string|in:Pending,Completed',
            'due_date' => 'required|date',
        ]);

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

        if ($request->has('tags')) {
            $task->tags()->sync($request->tags);
        } else {
            $task->tags()->sync([]);
        }

        $this->logActivity(
            'Task Updated',
            'Task: ' . $task->title,
            'Task',
            $task->id
        );

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        $this->logActivity(
            'Task Deleted',
            'Task: ' . $task->title,
            'Task',
            $task->id
        );

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function markCompleted(Task $task)
    {
        $task->update([
            'status' => 'Completed',
        ]);

        $this->logActivity(
            'Task Completed',
            'Task: ' . $task->title,
            'Task',
            $task->id
        );

        return redirect()->route('tasks.index')->with('success', 'Task marked as completed.');
    }

    // ✅ FIXED FUNCTION (MAIN BUG)
    protected function logActivity($action, $description = null, $relatedType = null, $relatedId = null)
    {
        \DB::table('activity_logs')->insert([
            'user_id' => Auth::id(),
            'action' => $action,
            'related_type' => $relatedType,
            'related_id' => $relatedId,
            'description' => $description ?? $action,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}