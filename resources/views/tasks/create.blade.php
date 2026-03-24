@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Add Task / Follow-up</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tasks.store') }}" class="space-y-4 bg-white p-6 rounded shadow-md">
        @csrf
        <div>
            <label>Title:</label>
            <input type="text" name="title" value="{{ old('title') }}" required class="w-full border px-3 py-2 rounded">
        </div>
        <div>
            <label>Description:</label>
            <textarea name="description" rows="3" class="w-full border px-3 py-2 rounded">{{ old('description') }}</textarea>
        </div>
        <div>
            <label>Related To:</label>
            <select name="related_type">
    <option value="lead">Lead</option>
    <option value="customer">Customer</option>
</select>
        </div>
        <div>
            <label>Select Related:</label>
            <select name="related_id" required class="w-full border px-3 py-2 rounded">
                <optgroup label="Customers">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </optgroup>
                <optgroup label="Leads">
                    @foreach($leads as $lead)
                        <option value="{{ $lead->id }}">{{ $lead->lead_name }}</option>
                    @endforeach
                </optgroup>
            </select>
        </div>
        <div>
            <label>Assign To User:</label>
            <select name="assigned_user_id" required class="w-full border px-3 py-2 rounded">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Due Date:</label>
            <input type="date" name="due_date" value="{{ old('due_date') }}" required class="w-full border px-3 py-2 rounded">
        </div>
        <div>
            <label>Status:</label>
            <select name="status" class="w-full border px-3 py-2 rounded">
                <option value="Pending" selected>Pending</option>
                <option value="Completed">Completed</option>
            </select>
        </div>
        <div class="flex space-x-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Task</button>
            <a href="{{ route('tasks.index') }}" class="bg-gray-300 px-4 py-2 rounded">Back to Tasks</a>
        </div>
    </form>
</div>
@endsection