@extends('layouts.app')

@section('content')

<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">Activity Logs</h2>

    <div class="mb-4">
        <a href="{{ route('dashboard') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
            Back to Dashboard
        </a>
    </div>

    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="p-3">ID</th>
                    <th class="p-3">User</th>
                    <th class="p-3">Activity</th>
                    <th class="p-3">Related Type</th>
                    <th class="p-3">Related Name</th>
                    <th class="p-3">Date</th>
                </tr>
            </thead>

            <tbody>
                @foreach($logs as $log)
                <tr class="border-t">
                    <td class="p-3">{{ $log->id }}</td>
                    <td class="p-3">{{ $log->user->name ?? 'System' }}</td>
                    <td class="p-3">{{ $log->action }}</td>
                    <td class="p-3">{{ $log->related_type }}</td>
                    <td class="p-3">
                        @if($log->related)
                            @if($log->related_type == 'App\Models\Lead')
                                {{ $log->related->lead_name }}
                            @elseif($log->related_type == 'App\Models\Customer')
                                {{ $log->related->name }}
                            @elseif($log->related_type == 'App\Models\Task')
                                {{ $log->related->title }}
                            @else
                                N/A
                            @endif
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="p-3">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection