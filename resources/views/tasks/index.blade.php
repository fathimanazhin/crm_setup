@extends('layouts.app')

@section('content')
<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">Tasks / Follow-ups</h2>

    <div class="mb-4">
        <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Task</a>
    </div>

    @if(session('success'))
        <p class="text-green-600 mb-4">{{ session('success') }}</p>
    @endif

    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="p-3">ID</th>
                    <th class="p-3">Title</th>
                    <th class="p-3">Related Type</th>
                    <th class="p-3">Related Name</th>
                    <th class="p-3">Assigned User</th>
                    <th class="p-3">Due Date</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Tags</th> {{-- ADDED --}}
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr class="border-t">
                    <td class="p-3">{{ $task->id }}</td>
                    <td class="p-3">{{ $task->title }}</td>
                    <td class="p-3">{{ class_basename($task->related_type) }}</td>

                    <td class="p-3">
                        {{ $task->related_name }}
                    </td>

                    <td class="p-3">{{ optional($task->assignedUser)->name ?? 'N/A' }}</td>
                    <td class="p-3">{{ $task->due_date }}</td>
                    <td class="p-3">{{ $task->status }}</td>

                    {{-- TAGS COLUMN --}}
                    <td class="p-3">
                        @foreach($task->tags as $tag)
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs mr-1">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </td>

                    <td class="p-3">
                        @php
                            $canEdit = auth()->user()->role === 'admin' || $task->assigned_user_id === auth()->id();
                        @endphp
                        @if($canEdit)
                            <a href="{{ route('tasks.edit', $task->id) }}" class="text-yellow-500">Edit</a> |
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500">Delete</button>
                            </form>
                            @if($task->status !== 'Completed')
                                |
                                <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="text-green-500">Complete</button>
                                </form>
                            @endif
                        @else
                            <span class="text-gray-400">No Actions</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection