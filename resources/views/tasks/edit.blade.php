@extends('layouts.app')

@section('content')
<div class="p-6 text-white">
    <h2 class="text-2xl font-bold mb-4">Edit Task / Follow-up</h2>

    @if ($errors->any())
        <div class="bg-red-500/20 border border-red-500 text-red-400 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tasks.update', $task->id) }}"
          class="space-y-4 bg-indigo-900/60 backdrop-blur-md p-6 rounded-xl shadow-lg">
        @csrf
        @method('PUT')

        <div>
            <label class="text-gray-300">Title:</label>
            <input type="text" name="title" value="{{ old('title', $task->title) }}" required
                   class="w-full bg-indigo-950 border border-indigo-700 px-3 py-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
        </div>

        <div>
            <label class="text-gray-300">Description:</label>
            <textarea name="description" rows="3"
                      class="w-full bg-indigo-950 border border-indigo-700 px-3 py-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">{{ old('description', $task->description) }}</textarea>
        </div>

        <div>
            <label class="text-gray-300">Related To:</label>
            <select name="related_type"
                    class="w-full bg-indigo-950 border border-indigo-700 px-3 py-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
                <option value="lead" {{ $task->related_type == 'lead' ? 'selected' : '' }}>Lead</option>
                <option value="customer" {{ $task->related_type == 'customer' ? 'selected' : '' }}>Customer</option>
            </select>
        </div>

        <div>
            <label class="text-gray-300">Select Related:</label>
            <select name="related_id" required
                    class="w-full bg-indigo-950 border border-indigo-700 px-3 py-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
                <optgroup label="Customers">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $task->related_type == 'customer' && $task->related_id == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </optgroup>
                <optgroup label="Leads">
                    @foreach($leads as $lead)
                        <option value="{{ $lead->id }}" {{ $task->related_type == 'lead' && $task->related_id == $lead->id ? 'selected' : '' }}>
                            {{ $lead->lead_name }}
                        </option>
                    @endforeach
                </optgroup>
            </select>
        </div>

        <div>
            <label class="block mb-2 text-gray-300">Tags</label>

            @foreach($tags as $tag)
                <label class="inline-flex items-center mr-4 text-gray-300">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="mr-1 accent-cyan-500">
                    {{ $tag->name }}
                </label>
            @endforeach
        </div>

        <div>
            <label class="text-gray-300">Assign To User:</label>
            <select name="assigned_user_id" required
                    class="w-full bg-indigo-950 border border-indigo-700 px-3 py-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $task->assigned_user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="text-gray-300">Due Date:</label>
            <input type="date" name="due_date" value="{{ old('due_date', $task->due_date) }}" required
                   class="w-full bg-indigo-950 border border-indigo-700 px-3 py-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
        </div>

        <div>
            <label class="text-gray-300">Status:</label>
            <select name="status"
                    class="w-full bg-indigo-950 border border-indigo-700 px-3 py-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
                <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="flex space-x-4">
            <button type="submit"
                    class="bg-gradient-to-r from-indigo-600 to-cyan-500 px-4 py-2 rounded-lg text-white hover:opacity-90 transition">
                Update Task
            </button>

            <a href="{{ route('tasks.index') }}"
               class="bg-indigo-700 px-4 py-2 rounded-lg text-white hover:bg-indigo-600 transition">
                Back to Tasks
            </a>
        </div>
    </form>
</div>
@endsection