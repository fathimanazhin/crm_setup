@extends('layouts.app')

@section('content')

<div class="p-6 text-white">

    <h2 class="text-2xl font-bold mb-4">Leads</h2>

    <div class="mb-4">
        <a href="{{ route('leads.create') }}"
           class="bg-gradient-to-r from-indigo-600 to-cyan-500 px-4 py-2 rounded-lg text-white hover:opacity-90 transition">
            Add Lead
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
                    <th class="p-4">Lead Name</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Phone</th>
                    <th class="p-4">Source</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Assigned User</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach($leads as $lead)

                <tr class="border-b border-indigo-800 hover:bg-indigo-800/40 transition">

                    <td class="p-4">{{ $lead->id }}</td>

                    <td class="p-4 font-medium">{{ $lead->lead_name }}</td>

                    <td class="p-4 text-gray-300">{{ $lead->email }}</td>

                    <td class="p-4">{{ $lead->phone }}</td>

                    <td class="p-4">{{ $lead->source }}</td>

                    <td class="p-4">
                        <span class="px-2 py-1 text-xs rounded
                            {{ $lead->status == 'Converted' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                            {{ $lead->status }}
                        </span>
                    </td>

                    <td class="p-4">
                        {{ optional($lead->assignedUser)->name ?: 'Not Assigned' }}
                    </td>

                    <td class="p-4 text-center space-x-2">

                        @php
                            $canEdit = auth()->user()->role == 'admin' || $lead->assigned_user_id == auth()->id();
                        @endphp

                        @if($canEdit)

                            <a href="{{ route('leads.edit', $lead->id) }}"
                               class="text-yellow-400 hover:text-yellow-200">
                                Edit
                            </a>

                            <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-400 hover:text-red-200">
                                    Delete
                                </button>
                            </form>

                            @if($lead->status != 'Converted')
                                <form action="{{ route('leads.convertToCustomer', $lead->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-cyan-400 hover:text-cyan-200">
                                        Convert
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