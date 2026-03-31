@extends('layouts.app')

@section('content')
<div class="p-6 text-white">

    <h2 class="text-2xl font-bold mb-4">Tasks / Follow-ups</h2>

    <div class="mb-4">
        <a href="{{ route('tasks.create') }}"
           class="bg-gradient-to-r from-indigo-600 to-cyan-500 px-4 py-2 rounded-lg text-white hover:opacity-90 transition">
            Add Task
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-500/20 text-green-400 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-indigo-900/60 backdrop-blur-md shadow-lg rounded-xl overflow-x-auto">
        <table class="w-full text-sm">

            <thead>
                <tr class="bg-indigo-800 text-left text-gray-300">
                    <th class="p-4">ID</th>
                    <th class="p-4">Title</th>
                    <th class="p-4">Related Type</th>
                    <th class="p-4">Related Name</th>
                    <th class="p-4">Assigned User</th>
                    <th class="p-4">Due Date</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Tags</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tasks as $task)

                <tr class="border-b border-indigo-800 hover:bg-indigo-800/40 transition">

                    <td class="p-4">{{ $task->id }}</td>

                    <td class="p-4 font-medium">{{ $task->title }}</td>

                    <td class="p-4">{{ class_basename($task->related_type) }}</td>

                    <td class="p-4">{{ $task->related_name }}</td>

                    <td class="p-4">{{ optional($task->assignedUser)->name ?? 'N/A' }}</td>

                    <td class="p-4 text-gray-300">{{ $task->due_date }}</td>

                    <td class="p-4">
                        <span class="px-2 py-1 text-xs rounded
                            {{ $task->status === 'Completed' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                            {{ $task->status }}
                        </span>
                    </td>

                    {{-- TAGS --}}
                    <td class="p-4">
                        @foreach($task->tags as $tag)
                            <span class="bg-cyan-500/20 text-cyan-300 px-2 py-1 rounded text-xs mr-1">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </td>

                    <td class="p-4 text-center space-x-2">
                        @php
                            $canEdit = auth()->user()->role === 'admin' || $task->assigned_user_id === auth()->id();
                        @endphp

                        @if($canEdit)

                            <a href="{{ route('tasks.edit', $task->id) }}"
                               class="text-yellow-400 hover:text-yellow-200">
                                Edit
                            </a>

                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-400 hover:text-red-200">
                                    Delete
                                </button>
                            </form>

                            @if($task->status !== 'Completed')
                                <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="text-green-400 hover:text-green-200">
                                        Complete
                                    </button>
                                </form>
                            @endif

                        @else
                            <span class="text-gray-500">No Actions</span>
                        @endif
                    </td>

                </tr>

                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection