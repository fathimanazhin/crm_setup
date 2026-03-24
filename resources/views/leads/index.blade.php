@extends('layouts.app')

@section('content')

<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">Leads</h2>

    <div class="mb-4">
        <a href="{{ route('leads.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            Add Lead
        </a>
    </div>

    @if(session('success'))
        <p class="text-green-600 mb-4">{{ session('success') }}</p>
    @endif

    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="p-3">ID</th>
                    <th class="p-3">Lead Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Phone</th>
                    <th class="p-3">Source</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Assigned User</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($leads as $lead)
                <tr class="border-t">
                    <td class="p-3">{{ $lead->id }}</td>
                    <td class="p-3">{{ $lead->lead_name }}</td>
                    <td class="p-3">{{ $lead->email }}</td>
                    <td class="p-3">{{ $lead->phone }}</td>
                    <td class="p-3">{{ $lead->source }}</td>
                    <td class="p-3">{{ $lead->status }}</td>
                   <td class="p-3">
    {{ optional($lead->assignedUser)->name ?: 'Not Assigned' }}
</td>
                    <td class="p-3">
    @php
        $canEdit = auth()->user()->role == 'admin' || $lead->assigned_user_id == auth()->id();
    @endphp

    @if($canEdit)
        <a href="{{ route('leads.edit', $lead->id) }}" class="text-yellow-500">Edit</a> |

        <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button class="text-red-500">Delete</button>
        </form>

        @if($lead->status != 'Converted')
            | <form action="{{ route('leads.convertToCustomer', $lead->id) }}" method="POST" class="inline">
    @csrf
    @method('PATCH')
    <button type="submit" class="text-blue-500">Convert</button>
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